<?php

require "backend.php";
require "calendar.php";

//storing user input.
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

//covering the dates between the requested booking, minus the checkoutday. https://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
$period = new DatePeriod(
    new DateTime($startdate),
    new DateInterval('P1D'),
    new DateTime($enddate)
);

$bookingRequest = array();

//storing all the dates in bookingRequest array
foreach ($period as $key => $value) {
    $bookingRequest[] = $value->format('Y-m-d');
}

// storing the already booked days in another array, bookedDays.
// $bookedDays = array();
// foreach ($events as $event) {
//     // echo $event['start'];
//     $period = new DatePeriod(
//         new DateTime($event['start']),
//         new DateInterval('P1D'),
//         new DateTime($event['end'])
//     );
//     foreach ($period as $key => $value) {
//         $bookedDays[] = $value->format('Y-m-d');
//     }
// }
print_r($bookedDays);
print_r($bookingRequest);
//comparing the arrays to check for duplicate values.
$result = array_intersect($bookedDays, $bookingRequest);

//if no similar values, executes sql query for booking.
if (empty($result)) {
    echo "booking succesful";
    $statement = $dbh->prepare("INSERT INTO bookingsX('start_date', 'end_date', 'room') VALUES (:start_date, :end_date 
    ,:room)");

    $statement->bindParam(':start_date', $startdate, PDO::PARAM_STR);
    $statement->bindParam(':end_date', $enddate, PDO::PARAM_STR);
    // $statement->bindParam(':room', 'regular', PDO::PARAM_STR);

    $statement->execute();
} else {
    //if array contains matching values - print an error message. 
    echo "booking unsuccesful";
}










//part below alrdy done in backend.php
$statement = $dbh->query('SELECT * FROM bookingsX');

$bookingsX = $statement->fetchAll(PDO::FETCH_ASSOC);

//putting the booking to the database

// $title = trim($_POST['title']);
// $tmdbUrl = trim($_POST['tmdb_url']);




// header("location: index.php");
