<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  

    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()
            ->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained()
            ->onDelete('cascade');
            $table->string('vacancy');
            $table->string('salary')->nullable();
            $table->string('location');
            $table->string('description')->nullable();
            $table->string('benefits')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('keywords')->nullable();
            $table->string('experience')->nullable();
            $table->string('company_name');
            $table->string('company_location')->nullable();
            $table->string('company_website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
