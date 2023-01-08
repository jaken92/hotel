<?php
require 'hotelFunctions.php';


$dbh = connect('/bookings.db');
$statement = $dbh->query('SELECT * FROM bookingsX');

$bookingsX = $statement->fetchAll(PDO::FETCH_ASSOC);


