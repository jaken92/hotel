<?php

declare(strict_types=1);

require "hotelFunctions.php";

$dbh = connect('/bookings.db');

$statement = $dbh->query('SELECT * FROM rooms');

$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);

// foreach ($features as $feature) {
//     echo $feature['name'] . " " . $feature['cost'];
// }

header('Content-Type:application/json');
echo json_encode($rooms);
