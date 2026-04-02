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
        Schema::table('moduls', function (Blueprint $blueprint) {
            $blueprint->integer('kkm')->nullable()->after('deskripsi');
            $blueprint->integer('max_retakes')->nullable()->after('kkm');
            $blueprint->integer('point_per_question')->nullable()->after('max_retakes');
            $blueprint->decimal('score_divisor', 8, 2)->nullable()->after('point_per_question');
            $blueprint->boolean('is_random')->default(false)->after('score_divisor');
            $blueprint->boolean('show_result')->default(true)->after('is_random');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moduls', function (Blueprint $blueprint) {
            $blueprint->dropColumn([
                'kkm',
                'max_retakes',
                'point_per_question',
                'score_divisor',
                'is_random',
                'show_result'
            ]);
        });
    }
};
