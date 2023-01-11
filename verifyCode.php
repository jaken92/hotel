<?php

declare(strict_types=1);
//Some functions using guzzle. For verifying and depositing transfercodes.

require(__DIR__ . '/vendor/autoload.php');
header("Content-type:application/json");

use GuzzleHttp\Client;


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

    $rez = json_decode($rez);

    if (property_exists($rez, 'transferCode') && property_exists($rez, 'amount') && property_exists($rez, 'fromAccount')) {

        return true;
    } elseif (property_exists($rez, 'error')) {
        return false;
    } else {
        return false;
    }
};

deposit("05e8b347-987f-45a3-9c05-2fc2ad706608");

function deposit($transfercode)
{
    $client = new Client;

    $response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/deposit', [
        'form_params' => [
            'user' => "Petter",
            'transferCode' => $transfercode
        ]
    ]);


    $rez = $response->getBody()->getContents();
    // header("Content-type:application/json");
    // $rez = json_decode($rez);
    // echo json_encode($rez);
}
