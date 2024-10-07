<?php

namespace PragmaGoTech\Interview\Model;

class BreakPoint
{
    private float $amount;
    private float $fee;
    private int $term;

    public function __construct(int $term, float $amount, float $fee)
    {
        $this->term = $term;
        $this->amount = $amount;
        $this->fee = $fee;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function getTerm(): int
    {
        return $this->term;
    }
}
