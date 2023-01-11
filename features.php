<?php

//Page for js to fetch data. Used in fetch.js.
declare(strict_types=1);

require "hotelFunctions.php";

$dbh = connect('/bookings.db');

$statement = $dbh->query('SELECT * FROM features');

$features = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type:application/json');
echo json_encode($features);
