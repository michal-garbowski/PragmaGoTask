<?php

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\BreakPoint;
use InvalidArgumentException;

class FeeStructure
{
    private const string ERROR_FEE_STRUCTURE_TERM_WRONG_VALUE = 'Fee structure is only available for 12 and 24 months.';

    public static function getFeeStructure(int $term): array
    {
        return match ($term) {
            12 => [
                new BreakPoint(12, 1000, 50),
                new BreakPoint(12, 2000, 90),
                new BreakPoint(12, 3000, 90),
                new BreakPoint(12, 4000, 115),
                new BreakPoint(12, 5000, 100),
                new BreakPoint(12, 6000, 120),
                new BreakPoint(12, 7000, 140),
                new BreakPoint(12, 8000, 160),
                new BreakPoint(12, 9000, 180),
                new BreakPoint(12, 10000, 200),
                new BreakPoint(12, 11000, 220),
                new BreakPoint(12, 12000, 240),
                new BreakPoint(12, 13000, 260),
                new BreakPoint(12, 14000, 280),
                new BreakPoint(12, 15000, 300),
                new BreakPoint(12, 16000, 320),
                new BreakPoint(12, 17000, 340),
                new BreakPoint(12, 18000, 360),
                new BreakPoint(12, 19000, 380),
                new BreakPoint(12, 20000, 400),
            ],
            24 => [
                new BreakPoint(24, 1000, 70),
                new BreakPoint(24, 2000, 100),
                new BreakPoint(24, 3000, 120),
                new BreakPoint(24, 4000, 160),
                new BreakPoint(24, 5000, 200),
                new BreakPoint(24, 6000, 240),
                new BreakPoint(24, 7000, 280),
                new BreakPoint(24, 8000, 320),
                new BreakPoint(24, 9000, 360),
                new BreakPoint(24, 10000, 400),
                new BreakPoint(24, 11000, 440),
                new BreakPoint(24, 12000, 480),
                new BreakPoint(24, 13000, 520),
                new BreakPoint(24, 14000, 560),
                new BreakPoint(24, 15000, 600),
                new BreakPoint(24, 16000, 640),
                new BreakPoint(24, 17000, 680),
                new BreakPoint(24, 18000, 720),
                new BreakPoint(24, 19000, 760),
                new BreakPoint(24, 20000, 800),
            ],
            default => throw new InvalidArgumentException(self::ERROR_FEE_STRUCTURE_TERM_WRONG_VALUE),
        };
    }
}
