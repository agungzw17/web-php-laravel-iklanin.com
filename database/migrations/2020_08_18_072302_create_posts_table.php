<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->nullable();
            $table->string('role')->nullable();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('description');
            $table->integer('limit');
            $table->double('price');
            $table->string('share_type');
            $table->string('content_title');
            $table->string('content_image');
            $table->string('content_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
