<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('drug_name');
            $table->text('drug_description')->nullable();
            $table->text('side_effects')->nullable();
            $table->decimal('drug_price', 10, 2);
            $table->integer('drug_quantity');
            $table->string('image_path')->nullable(); 
            $table->foreignId('category_id')->constrained('drug_categories')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('drug_warehouses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();  // Soft delete column
        });
    }

    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}
