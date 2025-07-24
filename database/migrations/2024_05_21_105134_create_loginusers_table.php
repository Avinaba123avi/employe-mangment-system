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
        Schema::create('loginusers', function (Blueprint $table) {
            $table->bigIncrements('login_id');   
            $table->unsignedInteger('regiuser_id');     
            $table->string('email')->unique();
            $table->string('password');
            $table->foreign('regiuser_id')->references('regiuser_id')->on('registerusers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loginusers');
    }
};
