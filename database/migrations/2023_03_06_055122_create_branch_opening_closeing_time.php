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
        Schema::create('branch_opening_closeing_time', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');//Restaurent Id
            $table->string('unique_id')->nullable();
           
            $table->unsignedBigInteger('branch_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branchs');
            $table->time('opening_time');
            $table->time('closeing_time');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_opening_closeing_time');
    }
};
