<?php

namespace PragmaGoTech\Interview\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\LoanFeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorTest extends TestCase
{
    private FeeCalculator $calculator;

    public static function feeCalculationProvider(): array
    {
        return [
            [12, 19250, 385],
            [24, 11500, 460],
            [24, 2750, 115.0]
        ];
    }

    public static function invalidLoanAmountProvider(): array
    {
        return [
            [12, 999.99],
            [12, 20000.01],
            [24, 999.99],
            [24, 20000.01],
            [12, -1],
            [24, -1],
        ];
    }

    public static function invalidLoanTermProvider(): array
    {
        return [
            [36, 11000],
            [48, 15000],
            [-1, 15000]
        ];
    }

    #[DataProvider('feeCalculationProvider')]
    public function testCalculateFee(
        int $term,
        float $amount,
        float $expectedFee
    ): void {
        $loanProposal = new LoanProposal($term, $amount);
        $fee = $this->calculator->calculate($loanProposal);
        $this->assertEquals(
            0,
            (($amount + $fee) % 5),
            'Sum of amount and calculated fee must be a multiple of 5.'
        );
        $this->assertEquals($expectedFee, $fee);
    }

    #[DataProvider('invalidLoanAmountProvider')]
    public function testInvalidLoanAmount(int $term, float $amount): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal($term, $amount);
    }

    #[DataProvider('invalidLoanTermProvider')]
    public function testInvalidLoanTerm(int $term, float $amount): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal($term, $amount);
    }

    protected function setUp(): void
    {
        $this->calculator = new LoanFeeCalculator();
    }
}
