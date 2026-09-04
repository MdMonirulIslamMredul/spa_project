<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceTitleToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('services')) {
            if (!Schema::hasColumn('services', 'service_title')) {
                Schema::table('services', function (Blueprint $table) {
                    $table->string('service_title')->nullable()->after('title');
                });
            }
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
            if (Schema::hasColumn('services', 'service_title')) {
                Schema::table('services', function (Blueprint $table) {
                    $table->dropColumn('service_title');
                });
            }
        }
    }
}
