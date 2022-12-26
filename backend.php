<?php

$dbh = new PDO('sqlite:bookings.db');

$statement = $dbh->query('SELECT * FROM bookings');

$bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

// echo $bookings[0]['_date'];

header('Content-Type:application/json');

echo json_encode($bookings);

