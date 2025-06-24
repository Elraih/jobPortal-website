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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('degree', ['high_school_diploma',
                'associates_degree',
                'bachelors_degree',
                'masters_degree',
                'doctoral_degree'
            ])->default('bachelors_degree');
            $table->string('major');
            $table->string('school_name');
            $table->date('start_date');
            $table->date('completion_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
