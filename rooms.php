<?php

//Page to fetch data via js. Used in fetch.js.
declare(strict_types=1);

require "hotelFunctions.php";

$dbh = connect('/bookings.db');

$statement = $dbh->query('SELECT * FROM rooms');

$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type:application/json');
echo json_encode($rooms);
