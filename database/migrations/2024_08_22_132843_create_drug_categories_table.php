<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('drug_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->unique();
            $table->timestamps();
            $table->softDeletes();  // Soft delete column
        });
    }

    public function down()
    {
        Schema::dropIfExists('drug_categories');
    }
}
