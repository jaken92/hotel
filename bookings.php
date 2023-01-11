<?php

//connecting to the db, saving all the data from bookings as bookingsX.
require 'hotelFunctions.php';


$dbh = connect('/bookings.db');
$statement = $dbh->query('SELECT * FROM bookings');

$bookingsX = $statement->fetchAll(PDO::FETCH_ASSOC);
