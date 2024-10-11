<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyInfosTable extends Migration
{
    public function up()
    {
        Schema::create('pharmacy_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('owner_name');
            $table->string('location');
            $table->string('pharmacy_name');
            $table->string('phone_number', 15);
            $table->string('license_image'); 
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    public function down()
{
    Schema::dropIfExists('pharmacy_infos');
}
}
