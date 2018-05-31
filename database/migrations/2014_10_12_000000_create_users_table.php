<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('f_name');
            $table->string('m_name');
            $table->string('l_name');
            $table->string('user_id')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('mobile');
            $table->tinyInteger('is_admin');
            $table->integer('family_id');
            $table->tinyInteger('is_contact_private');
            $table->string('password');
            $table->string('land_line_no')->nullable();
            $table->string('fax')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('married_status')->nullable();
            $table->string('spouse')->nullable();
            $table->tinyInteger('is_marriage_candidate')->nullable();
            $table->string('bio_data')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pin')->nullable();
            $table->string('admin_relation')->nullable();
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
