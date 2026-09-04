<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalImagesToBlogModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('blog_models')) {
            Schema::table('blog_models', function (Blueprint $table) {
                if (!Schema::hasColumn('blog_models', 'blog_img_2')) {
                    $table->string('blog_img_2')->nullable()->after('blog_img');
                }
                if (!Schema::hasColumn('blog_models', 'blog_img_3')) {
                    $table->string('blog_img_3')->nullable()->after('blog_img_2');
                }
                if (!Schema::hasColumn('blog_models', 'blog_img_4')) {
                    $table->string('blog_img_4')->nullable()->after('blog_img_3');
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
        if (Schema::hasTable('blog_models')) {
            Schema::table('blog_models', function (Blueprint $table) {
                $columns = [];
                if (Schema::hasColumn('blog_models', 'blog_img_2')) {
                    $columns[] = 'blog_img_2';
                }
                if (Schema::hasColumn('blog_models', 'blog_img_3')) {
                    $columns[] = 'blog_img_3';
                }
                if (Schema::hasColumn('blog_models', 'blog_img_4')) {
                    $columns[] = 'blog_img_4';
                }
                if (!empty($columns)) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
}
