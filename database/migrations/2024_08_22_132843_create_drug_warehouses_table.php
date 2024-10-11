<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugWarehousesTable extends Migration
{
    public function up()
    {
        Schema::create('drug_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_name');
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();  // Soft delete column
        });
    }

    public function down()
    {
        Schema::dropIfExists('drug_warehouses');
    }
}
