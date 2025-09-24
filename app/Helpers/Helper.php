<?php

/*function uniqueRegistrationId()
{
    do {
        $code = random_int(1000000, 9999999);
    } while (Ad::where("registration_id", $code)->first());

    return $code;
}*/

use App\Models\Contribution;

function totDonationAmount()
{
    $amount = Contribution::sum('amount');
    return number_format($amount, 2);
}

function totDonorCount()
{
    return Contribution::count();
}
