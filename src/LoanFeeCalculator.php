<?php

namespace PragmaGoTech\Interview;

use InvalidArgumentException;
use PragmaGoTech\Interview\Model\BreakPoint;
use PragmaGoTech\Interview\Model\LoanProposal;

/**
 * @author Michał Garbowski
 */
class LoanFeeCalculator implements FeeCalculator
{

    private const string ERR_AMOUNT_DOESNT_FIT_STRUCTURE =
        'Requested amount could not be interpolated with the given fee structure.';

    /**
     * @return float The calculated total fee.
     */
    public function calculate(LoanProposal $application): float
    {
        $loanTerm = $application->term();
        $loanAmount = $application->amount();

        $breakpoints = FeeStructure::getFeeStructure($loanTerm);
        usort($breakpoints, static fn($a, $b) => $a->getAmount() <=> $b->getAmount());

        $lowerBreakpoint = max(
            array_filter(
                $breakpoints,
                fn(BreakPoint $breakpoint) => $breakpoint->getAmount() <= $loanAmount
            )
        );

        $upperBreakpoint = min(
            array_filter(
                $breakpoints,
                fn(BreakPoint $breakpoint) => $breakpoint->getAmount() > $loanAmount
            )
        );

        if (empty($lowerBreakpoint) || empty($upperBreakpoint)) {
            throw new InvalidArgumentException(self::ERR_AMOUNT_DOESNT_FIT_STRUCTURE);
        }

        $interpolatedFee = $this->linearInterpolation(
            $loanAmount,
            $lowerBreakpoint,
            $upperBreakpoint,
        );

        return $this->roundUpToNearestFive($interpolatedFee + $loanAmount) - $loanAmount;
    }

    private function linearInterpolation(
        float $loanAmount,
        BreakPoint $lowerBreakpoint,
        BreakPoint $upperBreakpoint
    ): float {
        $x = $loanAmount;
        $x0 = $lowerBreakpoint->getAmount();
        $x1 = $upperBreakpoint->getAmount();
        $y0 = $lowerBreakpoint->getFee();
        $y1 = $upperBreakpoint->getFee();

        return $y0 + (($y1 - $y0) / ($x1 - $x0)) * ($x - $x0);
    }

    private function roundUpToNearestFive(float $value): float
    {
        return ceil($value / 5) * 5;
    }
}
