<?php

declare(strict_types=1);
require "calendar.php";
require "verifyCode.php";



if (isset($_POST['startdate'], $_POST['enddate'], $_POST['transfercode'], $_POST['room'])) {
    //storing user input.
    $startdate = htmlspecialchars($_POST['startdate']);
    $enddate = htmlspecialchars($_POST['enddate']);
    $transfercode = htmlspecialchars($_POST['transfercode']);
    $room = htmlspecialchars($_POST['room']);

    echo "startdate: " . $startdate;
    echo " enddate: " . $enddate;
    echo " code: " . $transfercode;
    echo " room: " . $room;
    $bookingRequest = array();
    $bookedDays = array();

    $period = new DatePeriod(
        new DateTime($startdate),
        new DateInterval('P1D'),
        new DateTime($enddate)
    );

    //storing all the dates in bookingRequest array
    foreach ($period as $key => $value) {
        $bookingRequest[] = $value->format('Y-m-d');
    }

    $totalcost = calcCost($bookingRequest, $room);


    if (isValidUuid($transfercode) && codeCheck($transfercode, $totalcost)) {
        //execute the rest of the code here? (maybe bot the booking check, but putting things in the db.)
        //covering the dates between the requested booking, minus the checkoutday. https://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array


        //fetching the booked days with the using the roomtype parameter and putting them into an array. 

        $stmt = $dick->prepare('SELECT * FROM bookingsX where room = :room');
        $stmt->bindValue(':room', $room);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $result) {

            $period = new DatePeriod(
                new DateTime($result['start_date']),
                new DateInterval('P1D'),
                new DateTime($result['end_date'])
            );
            foreach ($period as $key => $value) {
                $bookedDays[] = $value->format('Y-m-d');
            }
        }
        //comparing the arrays to check for duplicate values.
        $result = array_intersect($bookedDays, $bookingRequest);

        //if no similar values, executes sql query for booking.
        if (empty($result)) {
            echo "booking succesful";
            $statement = $dick->prepare("INSERT INTO bookingsX('start_date', 'end_date', 'room') VALUES (:start_date, :end_date 
        ,:room)");

            $statement->bindParam(':start_date', $startdate, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $enddate, PDO::PARAM_STR);
            $statement->bindParam(':room', $room, PDO::PARAM_STR);

            $statement->execute();

            deposit($transfercode);
        } else {
            //if array contains matching values - print an error message. 
            echo "booking unsuccesful";
            foreach ($result as $occupied) {
                echo $occupied . "is already booked, choose another date please! ";
            }
        }
    } else {
        //cancel booking process, put error message. 
        echo "Booking didnt go through. ";
    }
}











//part below alrdy done in backend.php
// $statement = $dbh->query('SELECT * FROM bookingsX');

// $bookingsX = $statement->fetchAll(PDO::FETCH_ASSOC);

//putting the booking to the database

// $title = trim($_POST['title']);
// $tmdbUrl = trim($_POST['tmdb_url']);




// header("location: index.php");
