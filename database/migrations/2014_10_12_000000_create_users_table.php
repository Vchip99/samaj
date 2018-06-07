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
            $table->string('gotra')->nullable();
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->tinyInteger('is_admin');
            $table->tinyInteger('is_super_admin')->default(0);
            $table->tinyInteger('is_member');
            $table->integer('family_id');
            $table->tinyInteger('is_contact_private');
            $table->string('land_line_no')->nullable();
            $table->string('fax')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('married_status')->nullable();
            $table->string('spouse')->nullable();
            $table->tinyInteger('is_marriage_candidate')->nullable();
            $table->string('bio_data')->nullable();
            $table->string('kundali')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('other_profession')->nullable();
            $table->string('designation')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pin')->nullable();
            $table->string('admin_relation')->nullable();
            $table->date('anniversary')->nullable();
            $table->string('group_1')->nullable();
            $table->string('group_2')->nullable();
            $table->string('group_3')->nullable();
            $table->string('group_4')->nullable();
            $table->string('group_5')->nullable();
            $table->string('group_6')->nullable();
            $table->string('facebook_profile')->nullable();
            $table->string('google_profile')->nullable();
            $table->string('linkedin_profile')->nullable();
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
