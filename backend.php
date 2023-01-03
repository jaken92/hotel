<?php
require 'hotelFunctions.php';

// $dbh = new PDO('sqlite:bookings.db');

// $statement = $dbh->query('SELECT * FROM bookingsX WHERE room = "room"');

// $bookingsX = $statement->fetchAll(PDO::FETCH_ASSOC);


$dick = connect('/bookings.db');
$statement = $dick->query('SELECT * FROM bookingsX');

$bookingsX = $statement->fetchAll(PDO::FETCH_ASSOC);

// $statement = $db->prepare('SELECT * FROM table WHERE id = :id;');
// $statement->bindValue(':id', $id);


// echo $bookings[0]['_date'];

// header('Content-Type:application/json');

// echo json_encode($bookings);

// echo "start-date:" . $bookings['0']['start_date'];
// echo "end-date:" . $bookings['0']['end_date'];
// foreach ($bookings as $booking) {
//     echo " NEW BOOKING: start: " . $booking['start_date'] . " end: " . $booking['end_date'];
// }
