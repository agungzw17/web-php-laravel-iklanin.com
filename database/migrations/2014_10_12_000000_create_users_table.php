<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('type');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->date('birth_date');
            $table->string('address');
            $table->string('instagram')->nullable();
            $table->string('instagram_followers')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitter_followers')->nullable();
            $table->string('facebook')->nullable();
            $table->string('facebook_followers')->nullable();
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
