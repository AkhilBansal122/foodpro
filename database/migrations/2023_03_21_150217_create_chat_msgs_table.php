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
        Schema::create('chat_msgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_rooms_id');//Group Id
            $table->foreign('chat_rooms_id')->references('id')->on('chat_rooms')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');//User Id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('msg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_msgs');
    }
};
