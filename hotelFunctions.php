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


//calculating the cost of room based on the amount of days in requested booking, and the costcolumn from "rooms" in db for the chosen room. 
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
}

//simply getting the features table from the database - for the data to be used in functions. 
function getFeatures()
{
    $dbh = connect('/bookings.db');
    $statement = $dbh->query('SELECT * FROM features');

    $features = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $features;
}

//function checking if each feature is set. Adding the cost to fearutecost if set. 
function featuresTotalCost(): int
{

    $features = getFeatures();

    $featurecost = 0;

    foreach ($features as $feature) {
        if (isset($_POST[$feature['id']])) {
            $featurecost = $featurecost + $feature['cost'];
        }
    }
    return $featurecost;
}


//function adding the chosen features in an array. For displaying as json upon succesful booking. 
function insertFeatures($choosenFeatures): array
{
    $features = getFeatures();

    foreach ($features as $feature) {
        if (isset($_POST[$feature['id']])) {

            $choosenFeatures[] = ["name" => $feature['name'], "cost" => $feature['cost']];
        }
    }

    return $choosenFeatures;
}


//discount check. If four or more days are booked, give 1$ discount. 
function checkForDiscount($requestedDays): int
{
    if (count($requestedDays) >= 4) {
        $discount = 1;
        return $discount;
    } else {
        $discount = 0;
        return $discount;
    }
}
