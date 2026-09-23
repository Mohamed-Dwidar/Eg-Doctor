<?php

namespace Modules\DoctorModule\app\Services;


use App\Helpers\UploaderHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Modules\DoctorModule\app\Repositories\DoctorRepository;
use Modules\SeoModule\Repository\SeoRepository;

class DoctorService {
    use UploaderHelper;

    protected $doctorRepository;
    protected $seoRepository;

    /**
     * Doctor fields that come straight from the request with no
     * extra processing (file upload / relation sync are handled
     * separately in create()/update()).
     */
    private const FILLABLE_FIELDS = [
        'name', 'degree_id', 'city_id', 'zone_id', 'address',
        'address_latitude', 'address_longitude', 'address_map_zoom',
        'phone', 'mobile', 'email', 'website', 'working_time',
        'more_info', 'found_us',
    ];

    public function __construct(DoctorRepository $doctorRepository, SeoRepository $seoRepository) {
        $this->doctorRepository = $doctorRepository;
        $this->seoRepository = $seoRepository;
    }

    public function getAllDoctors() {
        return $this->doctorRepository->all();
    }
    public function findWhere($arr) {
        return $this->doctorRepository->findWhere($arr);
    }

    public function findOne($id) {
        return $this->doctorRepository->findWhere(['id' => $id])->first();
    }

    public function findOneWithRelations($id) {
        return $this->doctorRepository->findWithRelations($id);
    }

    public function getDoctorById($id) {
        return $this->doctorRepository->find($id);
    }

    public function create($data) {
        $doctorData = $this->extractFillableData($data);

        $doctor = $this->doctorRepository->create($doctorData);

        if (!empty($data['pic']) && $data['pic'] instanceof UploadedFile) {
            $picName = $this->uploadImage($data['pic'], 'doctors', 'Doctor');
            $this->doctorRepository->update(['pic' => $picName], $doctor->id);
        }

        $doctor->departments()->sync($data['departments'] ?? []);

        $this->seoRepository->create([
            'meta_title' => ($data['meta_title'] ?? null) ?: $data['name'],
            'meta_description' => ($data['meta_description'] ?? null) ?: $data['name'],
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $data['name']),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($doctor),
            'seo_capable_id' => $doctor->id
        ]);

        return $doctor->fresh();
    }

    public function update($data) {
        $id = $data['id'];
        $doctor = $this->doctorRepository->find($id);
        if (!$doctor) {
            return null; // Handle case where doctor is not found
        }

        // Update doctor data
        $doctorData = $this->extractFillableData($data);
        $this->doctorRepository->update($doctorData, $id);

        if (!empty($data['pic']) && $data['pic'] instanceof UploadedFile) {
            $oldPic = $doctor->pic;
            $picName = $this->uploadImage($data['pic'], 'doctors', 'Doctor');
            $this->doctorRepository->update(['pic' => $picName], $id);

            if ($oldPic) {
                File::delete(public_path('uploads/doctors/' . $oldPic));
            }
        }

        $doctor->departments()->sync($data['departments'] ?? []);

        // Update or create SEO data
        $seoData = [
            'slug' => ($data['slug'] ?? null) ?: $doctor->name,
            'meta_title' => ($data['meta_title'] ?? null) ?: $doctor->name,
            'meta_description' => ($data['meta_description'] ?? null) ?: $doctor->name,
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $doctor->name),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($doctor),
            'seo_capable_id' => $doctor->id
        ];
        if ($doctor->seo) {
            $this->seoRepository->update($seoData, $doctor->seo->id);
        } else {
            $this->seoRepository->create($seoData);
        }

        return $doctor->fresh();
    }

    /**
     * Pull the plain (non-file, non-relation) doctor fields out of
     * the request data, normalizing blank strings to null so
     * optional fields can be cleared out on update.
     */
    private function extractFillableData($data) {
        $result = [];

        foreach (self::FILLABLE_FIELDS as $field) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $result[$field] = $data[$field] === '' ? null : $data[$field];
        }

        return $result;
    }

    public function deleteDoctor($id) {
        return $this->doctorRepository->delete($id);
    }

    /**
     * List every saved doctor and back-fill a default SEO record
     * (meta title/description/tag = doctor name) for any of them
     * that don't already have one. Doctors that already have SEO
     * data are left untouched.
     */
    public function applySeoToAllDoctors() {
        $doctors = $this->doctorRepository->all();
        $updatedCount = 0;

        foreach ($doctors as $doctor) {
            if ($doctor->seo) {
                continue;
            }

            $arr_data['slug'] = $doctor->name;
            $arr_data['meta_title'] = $doctor->name;
            $arr_data['meta_description'] = $doctor->description;
            $arr_data['meta_tag'] = $this->toKeywords($doctor->description);
            $arr_data['seo_capable_type'] = get_class($doctor);
            $arr_data['seo_capable_id'] = $doctor->id;

            $this->seoRepository->create($arr_data);

            $updatedCount++;
        }

        return $updatedCount;
    }

    public function filter($data = []) {
        return $this->doctorRepository->filter($data);
    }

    /**
     * Turn free text into a comma-separated SEO keywords list
     * (splits on whitespace and/or existing commas, trims each
     * word, and drops empty pieces).
     */
    private function toKeywords($text) {
        if (!$text) {
            return $text;
        }

        $words = preg_split('/[\s,]+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        return implode(',', $words);
    }
}
