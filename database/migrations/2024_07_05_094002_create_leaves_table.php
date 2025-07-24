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
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('leave_id');
            $table->unsignedBigInteger('regiuser_id');
            $table->foreign('regiuser_id')->references('regiuser_id')->on('registerusers')->onDelete('cascade')->onUpdate('cascade');
            $table->json('leave_dates');
            $table->string('reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
