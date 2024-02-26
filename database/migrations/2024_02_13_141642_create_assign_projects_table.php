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
        Schema::create('assign_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            // $table->longText('form_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('assign_by');
            $table->timestamps();

            $table->foreign('assign_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_projects');
    }
};
