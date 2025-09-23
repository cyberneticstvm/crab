<?php

/*function uniqueRegistrationId()
{
    do {
        $code = random_int(1000000, 9999999);
    } while (Ad::where("registration_id", $code)->first());

    return $code;
}*/

use App\Models\Donation;

function totDonationAmount()
{
    $amount = Donation::sum('amount');
    return number_format($amount, 2);
}

function totDonorCount()
{
    return Donation::count();
}
