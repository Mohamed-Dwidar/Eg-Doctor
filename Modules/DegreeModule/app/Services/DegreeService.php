<?php

namespace Modules\DegreeModule\app\Services;


use Modules\DegreeModule\app\Repositories\DegreeRepository;

class DegreeService
{
    protected $degreeRepository;

    public function __construct(DegreeRepository $degreeRepository)
    {
        $this->degreeRepository = $degreeRepository;
    }

    public function getAllDegrees()
    {
        return $this->degreeRepository->all();
    }
    public function findWhere($arr)
    {
        return $this->degreeRepository->findWhere($arr);
    }

    public function findOne($id)
    {
        return $this->degreeRepository->findWhere(['id' => $id])->first();
    }

    public function getDegreeById($id)
    {
        return $this->degreeRepository->find($id);
    }

    public function create($data)
    {
        $degreeData = [
            'name' => $data['name']
        ];

        $degree = $this->degreeRepository->create($degreeData);
        return $degree;
    }

    public function update($data)
    {
        $id = $data['id'];
        $degree = $this->degreeRepository->find($id);
        if (!$degree) {
            return null; // Handle case where degree is not found
        }

        // Update degree data
        $degreeData = [
            'name' => $data['name'] ?? $degree->name
        ];

        $this->degreeRepository->update($degreeData, $id);

        return $degree;
    }

    public function deleteDegree($id)
    {
        return $this->degreeRepository->delete($id);
    }

    public function filter($data = [])
    {
        return $this->degreeRepository->filter($data);
    }
}
