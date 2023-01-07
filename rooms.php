<?php

declare(strict_types=1);

require "hotelFunctions.php";

$dick = connect('/bookings.db');

$statement = $dick->query('SELECT * FROM rooms');

$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);

// foreach ($features as $feature) {
//     echo $feature['name'] . " " . $feature['cost'];
// }

header('Content-Type:application/json');
echo json_encode($rooms);
