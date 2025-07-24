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
        Schema::create('registerusers', function (Blueprint $table) {
            $table->bigIncrements('regiuser_id');
            $table->unsignedBigInteger('usertype_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreign('usertype_id')->references('usertype_id')->on('usertypes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registerusers');
    }
};
