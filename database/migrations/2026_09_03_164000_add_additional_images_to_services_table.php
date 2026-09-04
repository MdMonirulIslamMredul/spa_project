<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalImagesToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('services')) {
            Schema::table('services', function (Blueprint $table) {
                if (!Schema::hasColumn('services', 'service_image_2')) {
                    $table->string('service_image_2')->nullable()->after('service_image');
                }
                if (!Schema::hasColumn('services', 'service_image_3')) {
                    $table->string('service_image_3')->nullable()->after('service_image_2');
                }
                if (!Schema::hasColumn('services', 'service_image_4')) {
                    $table->string('service_image_4')->nullable()->after('service_image_3');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('services')) {
            Schema::table('services', function (Blueprint $table) {
                $columns = [];
                if (Schema::hasColumn('services', 'service_image_2')) {
                    $columns[] = 'service_image_2';
                }
                if (Schema::hasColumn('services', 'service_image_3')) {
                    $columns[] = 'service_image_3';
                }
                if (Schema::hasColumn('services', 'service_image_4')) {
                    $columns[] = 'service_image_4';
                }
                if (!empty($columns)) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
}
