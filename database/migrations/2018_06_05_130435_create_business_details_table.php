<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_category');
            $table->string('other_business')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('google')->nullable();
            $table->string('google_location')->nullable();
            $table->integer('family_id');
            $table->timestamps();
        });
        Schema::create('adds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
        Schema::create('register_users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('registration_id');
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
        Schema::dropIfExists('business_details');
        Schema::dropIfExists('adds');
        Schema::dropIfExists('register_users');
    }
}