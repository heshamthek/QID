<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('order_date')->default(DB::raw('CURRENT_DATE'));
            $table->string('order_status')->default('pending'); 
            $table->timestamps();
            $table->softDeletes();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

