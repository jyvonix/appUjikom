<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExamScoreTest extends TestCase
{
    /**
     * Test standard score calculation (Correct/Total * 100)
     */
    public function test_standard_score_calculation(): void
    {
        $jumlah_benar = 8;
        $total_soal = 10;
        
        $skor = ($jumlah_benar / $total_soal) * 100;
        
        $this->assertEquals(80, $skor);
    }

    /**
     * Test custom score calculation (Points * Correct / Divisor)
     */
    public function test_custom_score_calculation(): void
    {
        $jumlah_benar = 5;
        $point_per_question = 10;
        $score_divisor = 0.5; // (5 * 10) / 0.5 = 100
        
        $skor = ($jumlah_benar * $point_per_question) / $score_divisor;
        
        $this->assertEquals(100, $skor);
    }
}
