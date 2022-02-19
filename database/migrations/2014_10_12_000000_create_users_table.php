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
            $table->string('user_name')->nullable();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->datetime('email_varified_at')->nullable();
            $table->string('password',255);
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->string('country_code');
            $table->string('country')->nullable();;
            $table->string('profile_photo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('user_by')->default(0);
            $table->date('dob')->nullable();
            $table->datetime('last_login')->nullable();
            $table->integer('status');
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
