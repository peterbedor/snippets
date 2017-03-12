<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('snippet_id')
				->index();
            $table->unsignedInteger('user_id')
				->index();
            $table->unsignedInteger('parent_id')
				->nullable()
				->index();
            $table->text('body');
            $table->timestamps();

            $table->foreign('snippet_id')
				->references('id')
				->on('snippets');
            $table->foreign('user_id')
				->references('id')
				->on('users');
            $table->foreign('parent_id')
				->references('id')
				->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
