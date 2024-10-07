<?php

namespace PragmaGoTech\Interview\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\LoanFeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorTest extends TestCase
{
    private FeeCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new LoanFeeCalculator();
    }

    /**
     * @dataProvider feeCalculationProvider
     */
    public function testCalculateFee(int $term, float $amount, float $expectedFee): void
    {
        $loanProposal = new LoanProposal($term, $amount);
        $fee = $this->calculator->calculate($loanProposal);
        $this->assertEquals($expectedFee, $fee);
    }

    public static function feeCalculationProvider(): array
    {
        return [
            [12, 19250, 385],
            [24, 11500, 460],
            [24, 2750, 115.0]
        ];
    }

    /**
     * @dataProvider invalidLoanAmountProvider
     */
    public function testInvalidLoanAmount(int $term, float $amount): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal($term, $amount);
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

    /**
     * @dataProvider invalidLoanTermProvider
     */
    public function testInvalidLoanTerm(int $term, float $amount): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LoanProposal($term, $amount);
    }

    public static function invalidLoanTermProvider(): array
    {
        return [
            [36, 11000],
            [48, 15000],
            [-1, 15000]
        ];
    }
}
