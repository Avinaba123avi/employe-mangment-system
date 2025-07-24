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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id');
            $table->primary(['role_id', 'id'], 'id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->foreign('role_id')->constrained()->references('id')->on('roles')->cascadeOnDelete();
            $table->timestamps();
            //DB::statement('ALTER TABLE users ADD CONSTRAINT role_id_range CHECK (role_id BETWEEN 1 AND 3)');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
