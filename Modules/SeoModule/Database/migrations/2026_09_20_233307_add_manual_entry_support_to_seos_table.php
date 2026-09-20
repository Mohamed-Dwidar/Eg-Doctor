<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * Allows a "seos" row to exist on its own, not tied to any real
     * content record — used for manually-created slugs that just
     * redirect to a fixed path (e.g. "terms" => "pages/2"). This
     * means seo_capable_type/seo_capable_id have to become nullable,
     * and a target_path column is added to hold the redirect target
     * for that kind of row. doctrine/dbal isn't installed, so the
     * nullability change is done with a raw MODIFY instead of
     * Schema::change().
     *
     * @return void
     */
    public function up() {
        Schema::table('seos', function (Blueprint $table) {
            $table->string('target_path')->nullable()->after('footer_script');
        });

        DB::statement('ALTER TABLE seos MODIFY seo_capable_type VARCHAR(255) NULL');
        DB::statement('ALTER TABLE seos MODIFY seo_capable_id BIGINT UNSIGNED NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('ALTER TABLE seos MODIFY seo_capable_type VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE seos MODIFY seo_capable_id BIGINT UNSIGNED NOT NULL');

        Schema::table('seos', function (Blueprint $table) {
            $table->dropColumn('target_path');
        });
    }
};
