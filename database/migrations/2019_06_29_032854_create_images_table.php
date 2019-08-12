<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type_id')->unsigned();
            $table->integer('sort_order')->unsigned()->default(0);
            $table->string('path');
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail_path');
            $table->string('thumbnail_url')->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('image_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_type_id_foreign');
        });

        Schema::dropIfExists('images');
    }
}
