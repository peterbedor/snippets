<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('language_id')
				->index();
            $table->unsignedInteger('snippet_id')
				->index();
            $table->string('name');
            $table->string('slug');
            $table->text('body');
            $table->timestamps();

            $table->foreign('language_id')
				->references('id')
				->on('languages');
            $table->foreign('snippet_id')
				->references('id')
				->on('snippets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
