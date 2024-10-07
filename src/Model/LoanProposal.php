<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use InvalidArgumentException;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    private int $term;

    private float $amount;

    public function __construct(int $term, float $amount)
    {
        $this->validateParams($term, $amount);
        $this->term = $term;
        $this->amount = $amount;
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount;
    }

    private function validateParams(int $term, float $amount): void
    {
        if (!in_array($term, [12, 24])) {
            throw new InvalidArgumentException("Loan term must be 12 or 24 months.");
        }

        if ($amount < 1000 || $amount > 20000) {
            throw new InvalidArgumentException("Loan amount must be between 1000 and 20000 PLN.");
        }
    }
}
