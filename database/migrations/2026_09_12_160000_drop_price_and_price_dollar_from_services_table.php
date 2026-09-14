<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPriceAndPriceDollarFromServicesTable extends Migration
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
                if (Schema::hasColumn('services', 'price')) {
                    $table->dropColumn('price');
                }
                if (Schema::hasColumn('services', 'price_dollar')) {
                    $table->dropColumn('price_dollar');
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
                if (!Schema::hasColumn('services', 'price')) {
                    $table->string('price')->nullable()->after('title');
                }
                if (!Schema::hasColumn('services', 'price_dollar')) {
                    $table->string('price_dollar')->nullable()->after('price');
                }
            });
        }
    }
}
