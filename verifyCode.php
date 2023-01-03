<?php

declare(strict_types=1);
// Always require autoload when using packages
require(__DIR__ . '/vendor/autoload.php');
header("Content-type:application/json");

use GuzzleHttp\Client;

// codeCheck("44e34c89-ea91-402b-9fdd-ec2d9c4590a3", 2);

function codeCheck(string $transfercode, int $amount): bool
{
    $client = new Client;

    $response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/transferCode', [
        'form_params' => [
            'transferCode' => $transfercode,
            'totalcost' => $amount
        ]
    ]);


    $rez = $response->getBody()->getContents();
    // header("Content-type:application/json");
    $rez = json_decode($rez);
    // echo $rez->error;
    // print_r($rez);
    if (property_exists($rez, 'transferCode') && property_exists($rez, 'amount') && property_exists($rez, 'fromAccount')) {
        if ($rez->amount === $amount) {
            return true;
        } else {
            echo "The value of your transfercode doesnt match the totalcost. ";
            return false;
        }
    } else {
        echo json_encode($rez);
        return false;
    }
};

// if (property_exists($rez, 'error')) {
//     //  echo $rez->error;
//     print_r($rez);
//     return false;
// } else {
//     return true;
// }


// elseif (property_exists($rez, 'amount') && $rez->amount === 1) {
//     print_r($rez);
//     // echo "amount correct";
//     return true;
// }


// if (empty($rez->error) && $rez->amount == 2) {
//     // echo "no errors";
//     // echo json_encode($yourBooking);
//     // return true;
// } else {
//     // echo "we have an error: ";
//     // echo $rez->error;
//     // return false;
// }

$yourBooking[] = array(
    'island' => 'Mamona',
    'hotel' => 'Horale Hotel',
    'checkin' => '2023-01-02',
    'checkout' => '2023-01-07',

);

// echo json_encode($yourBooking);
