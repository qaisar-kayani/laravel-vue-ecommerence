<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('shop_unique_name', 250);
            $table->string('shop_slug', 250);
            $table->string('shop_name', 150);
            $table->string('shop_logo', 250)->nullable();
            $table->string('shop_thumbnail', 150)->nullable();
            $table->string('shop_cover_photo', 150)->nullable();
            $table->string('cover_photo', 150)->nullable();
            $table->string('business_email');
            $table->string('office_phone')->nullable();
            $table->string('shop_addresss');
            $table->string('zip');
            $table->string('city');
            $table->string('country_code')->nullable();
            $table->string('country')->nullable();
            $table->string('lat')->nullable();;
            $table->string('long')->nullable();;
            $table->timestamps();
            // $table->id();
            // $table->integer('user_id')->nullable();;
            // $table->string('vendor_shop_unique_name',250);
            // $table->string('vendor_shop_name',150);
            // $table->string('vendor_logo',250)->nullable();
            // $table->string('vendor_thumbnail',150)->nullable();
            // $table->string('vendor_cover_photo',150)->nullable();
            // $table->string('vendor_first_name',150)->nullable();
            // $table->string('vendor_last_name',150)->nullable();
            // $table->string('vendor_business_email');
            // $table->string('vendor_email')->nullable();;
            // $table->string('password')->nullable();
            // $table->string('vendor_office_phone');
            // $table->string('vendor_mobile')->nullable();
            // $table->string('vendor_shop_addresss');
            // $table->string('vendor_zip');
            // $table->string('vendor_city');
            // $table->string('vendor_country');
            // $table->string('vendor_lat')->nullable();;
            // $table->string('vendor_long')->nullable();;
            // $table->integer('status')->comments('0=inactive,1=active');
            // $table->datetime('vendor_last_login')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
