<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliances', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('finder_id')->nullable();
            $table->BigInteger('giver_id')->nullable();
            $table->BigInteger('post_id')->nullable();
            $table->bigInteger('status')->nullable();
            $table->timestamps();
            $table->string('link')->nullable();
            $table->string('transfer_prove')->nullable();
            $table->double('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appliances');
    }
}
