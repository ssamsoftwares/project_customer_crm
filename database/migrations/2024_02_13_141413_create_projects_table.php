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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assign_by');
            $table->string('form_name');
            $table->string('project_name');
            $table->longText('project_desc')->nullable();
            $table->string('project_status')->nullable();
            $table->enum('status', ['active', 'block'])->default('active')->nullable();
            $table->timestamps();

            $table->foreign('assign_by')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
