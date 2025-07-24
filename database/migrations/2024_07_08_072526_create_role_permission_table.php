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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->bigIncrements('rolepermission_id');
            $table->unsignedBigInteger('usertype_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('usertype_id')->references('usertype_id')->on('usertypes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('permission_id')->references('permission_id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
