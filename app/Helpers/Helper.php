<?php

/*function uniqueRegistrationId()
{
    do {
        $code = random_int(1000000, 9999999);
    } while (Ad::where("registration_id", $code)->first());

    return $code;
}*/

use App\Models\Contribution;
use Illuminate\Support\Facades\Config;

function totDonationAmount()
{
    $amount = Contribution::sum('amount');
    return number_format($amount, 2);
}

function totDonorCount()
{
    return Contribution::count();
}

function sendWAMessage()
{
    $token = Config::get('crabconfig.whatsapp.token');
    $config = [
        "messaging_product" => "whatsapp",
        "to" => "+919188848860",
        "type" => "template",
        "template" => [
            "name" => "crab_notification",
            "language" => ["code" => "en"],
            "components" => [
                [
                    "type" => "header",
                    "parameters" => [
                        [
                            "type" => "document",
                            "document" =>
                            [
                                "link" => "{{ asset('/assets/docs/crab-letter-head.pdf') }}",
                            ],
                        ],
                    ]
                ],
                [
                    "type" => "body",
                    "parameters" => [
                        ["type" => "text", "text" => 'Cybernetics'],
                    ]
                ],
            ]
        ]
    ];
    //curl_init();
    $data_string = json_encode($config);
    $ch = curl_init('https://graph.facebook.com/v22.0/543653938835557/messages');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );
    $result = curl_exec($ch);
    $res = json_decode($result, true);
    return $res;
}
