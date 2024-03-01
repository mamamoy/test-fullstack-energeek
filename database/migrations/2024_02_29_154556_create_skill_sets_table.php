<?php

use App\Models\Candidates;
use App\Models\Jobs;
use App\Models\Skill;
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
        Schema::create('skill_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Candidates::class, 'candidate_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Skill::class, 'skill_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_sets');
    }
};
