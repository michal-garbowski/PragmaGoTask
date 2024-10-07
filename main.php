<?php

use PragmaGoTech\Interview\LoanFeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

include_once 'vendor/autoload.php';

try {
    $application = new LoanProposal(24, 2750);
    $calculator = new LoanFeeCalculator();
    $fee = $calculator->calculate($application);

    print 'Fee for ' . $application->amount() . ' PLN loan for ' . $application->term() .
        ' months should be ' . $fee . PHP_EOL;
} catch (Exception $e) {
    print $e->getMessage() . PHP_EOL;
}
