<?php

declare(strict_types=1);
/* 
Here's something to start your career as a hotel manager.

One function to connect to the database you want (it will return a PDO object which you then can use.)
    For instance: $db = connect('hotel.db');
                  $db->prepare("SELECT * FROM bookings");
                  
one function to create a guid,
and one function to control if a guid is valid.
*/

function connect(string $dbName): object
{
    $dbPath = __DIR__ . '/' . $dbName;
    $db = "sqlite:$dbPath";

    // Open the database file and catch the exception if it fails.
    try {
        $db = new PDO($db);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Failed to connect to the database";
        throw $e;
    }
    return $db;
}

function guidv4(string $data = null): string
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function isValidUuid(string $uuid): bool
{
    if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
        return false;
    }
    return true;
}

// $blast = ["bird", "aunt", "moose"];


// $hej = roomTotalCost($blast, "regular");
// echo $hej;

function roomTotalCost(array $requestedDays, string $roomtype): int
{
    $dbh = connect('/bookings.db');
    $statement = $dbh->query('SELECT * FROM rooms');

    $rooms = $statement->fetchAll(PDO::FETCH_ASSOC);

    $cost = 0;

    $amountOfDays = count($requestedDays);

    foreach ($rooms as $room) {
        if ($roomtype == $room['id']) {
            $cost = $amountOfDays * $room['cost'];
            // echo $room['id'];
            return $cost;
        }
    }


    // $amountOfDays = count($requestedDays);
    // if ($roomtype == "basic") {
    //     $cost = $amountOfDays * 1;
    //     return $cost;
    // } elseif ($roomtype == "regular") {
    //     $cost = $amountOfDays * 2;
    //     return $cost;
    // } else {
    //     $cost = $amountOfDays * 3;
    //     return $cost;
    // }
}


//function fetching feature data from db and checking if they are set. Adding the cost to fearutecost if set. 
function featuresTotalCost(): int
{
    // $yourBooking[] = array(
    //     'island' => 'Mamona',
    //     'hotel' => 'Horale Hotel',
    //     'arrival_date' => '2023-01-02',
    //     'departure_date' => '2023-01-07',
    //     'total_cost' => '',
    //     'stars' => '',
    //     'additional_info' => ''
    // );

    $dbh = connect('/bookings.db');
    $statement = $dbh->query('SELECT * FROM features');

    $features = $statement->fetchAll(PDO::FETCH_ASSOC);

    $featurecost = 0;

    foreach ($features as $feature) {
        if (isset($_POST[$feature['id']])) {
            $featurecost = $featurecost + $feature['cost'];


            // $choosenFeatures[] = ["name" => $feature['name'], "cost" => $feature['cost']];
        }
    }
    // $yourBooking[0] += ["features" => $choosenFeatures];
    // print_r($choosenFeatures);
    // print_r($yourBooking);
    // header("Content-type:application/json");
    // echo json_encode($yourBooking);
    return $featurecost;
}

function getFeatures()
{
    $dbh = connect('/bookings.db');
    $statement = $dbh->query('SELECT * FROM features');

    $features = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $features;
}


function insertFeatures($choosenFeatures): array
{
    // $yourBooking[] = array(
    //     'island' => 'Mamona',
    //     'hotel' => 'Horale Hotel',
    //     'arrival_date' => '2023-01-02',
    //     'departure_date' => '2023-01-07',
    //     'total_cost' => '',
    //     'stars' => '',
    //     'additional_info' => ''
    // );

    $features = getFeatures();

    foreach ($features as $feature) {
        if (isset($_POST[$feature['id']])) {


            $choosenFeatures[] = ["name" => $feature['name'], "cost" => $feature['cost']];
        }
    }

    // $yourBooking[0] += ["features" => $choosenFeatures];

    header("Content-type:application/json");

    // return $yourBooking;
    return $choosenFeatures;
}
