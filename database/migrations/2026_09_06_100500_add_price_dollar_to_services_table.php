<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceDollarToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('services')) {
            if (!Schema::hasColumn('services', 'price_dollar')) {
                Schema::table('services', function (Blueprint $table) {
                    $table->string('price_dollar')->nullable()->after('price');
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
            if (Schema::hasColumn('services', 'price_dollar')) {
                Schema::table('services', function (Blueprint $table) {
                    $table->dropColumn('price_dollar');
                });
            }
        }
    }
}
