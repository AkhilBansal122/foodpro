<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
           
            $table->string('table_id');//Restaurent Id
          //  $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');//Restaurent Id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id')->default(0);
            $table->unsignedBigInteger('coupon_id')->default(0);
            $table->text('coupon_code')->nullable();
            $table->decimal("price",50,2)->default(0);
            $table->decimal("discount_amount",50,2)->default(0);
            $table->decimal("final_amount",50,2)->default(0);
            $table->decimal("shipping_price",50,2)->default(0);
            $table->unsignedBigInteger("order_in_process")->comment("0 pendding 1 accept 2 shipped 3 deliverd")->default(0);
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
