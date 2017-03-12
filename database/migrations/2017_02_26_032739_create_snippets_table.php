<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snippets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')
				->index();
            $table->unsignedInteger('forked_id')
				->nullable()
				->index();
            $table->string('name');
            $table->text('description')
				->nullable();
            $table->string('slug')
				->unique();
            $table->timestamps();

            $table->foreign('user_id')
				->references('id')
				->on('users');
            $table->foreign('forked_id')
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
        Schema::dropIfExists('snippets');
    }
}
