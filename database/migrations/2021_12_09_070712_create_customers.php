<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_user_name')->nullable();
            $table->string('customer_email')->unique();
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->datetime('email_varified_at')->nullable();
            $table->string('password',255);
            $table->string('customer_phone')->nullable();
            $table->string('customer_mobile');
            $table->string('customer_country_code');
            $table->string('customer_profile_photo')->nullable();
            $table->string('customer_thumbnail')->nullable();
            $table->date('customer_dob')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
