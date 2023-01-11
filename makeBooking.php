<?php

declare(strict_types=1);
require "calendar.php";
require "verifyCode.php";


//checking if all the essential form data is set. 
if (isset($_POST['startdate'], $_POST['enddate'], $_POST['transfercode'], $_POST['room'])) {
    //storing and washing user input from post.
    $startdate = htmlspecialchars($_POST['startdate']);
    $enddate = htmlspecialchars($_POST['enddate']);
    $transfercode = htmlspecialchars($_POST['transfercode']);
    $room = htmlspecialchars($_POST['room']);


    //setting the features value to 0. 
    $feature_one = 0;
    $feature_two = 0;
    $feature_three = 0;
    //If a feature is choosen the value is changed to 1, which is what the respective post input contains.
    if (isset($_POST['feature_one'])) {
        $feature_one = $_POST['feature_one'];
    }
    if (isset($_POST['feature_two'])) {
        $feature_two = $_POST['feature_two'];
    }
    if (isset($_POST['feature_three'])) {
        $feature_three = $_POST['feature_three'];
    }

    //declaring array to be filled with the requested days.  
    $bookingRequest = array();

    //Putting all dates between the $startdate and $enddate, minus the checkoutday, into a datePeriod. https://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
    $period = new DatePeriod(
        new DateTime($startdate),
        new DateInterval('P1D'),
        new DateTime($enddate)
    );

    //storing all the dates from the dateperiod in the bookingRequest array.
    foreach ($period as $key => $value) {
        $bookingRequest[] = $value->format('Y-m-d');
    }

    //calculating cost for room. Applying discount if conditions are met.
    $roomcost = roomTotalCost($bookingRequest, $room);
    //calculating cost for features.
    $featurecost = featuresTotalCost();
    //checking if entitled to discount.
    $discount = checkForDiscount($bookingRequest);
    // calculating totalcost. 
    $totalcost = $roomcost + $featurecost - $discount;

    //veryfing transfercode. If valid continues with the booking process. Function codeCheck() found in verifyCode.php.
    if (isValidUuid($transfercode) && codeCheck($transfercode, $totalcost)) {

        //fetching the booked days with the the roomtype parameter. 
        $stmt = $dbh->prepare('SELECT * FROM bookings where room = :room');
        $stmt->bindValue(':room', $room);
        $stmt->execute();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //declaring array for storing the booked dates.
        $bookedDays = array();

        //each booking where the room = $room is added to a dateperiod with startdate and enddate as it appears in the db. 
        foreach ($bookings as $booking) {

            $period = new DatePeriod(
                new DateTime($booking['start_date']),
                new DateInterval('P1D'),
                new DateTime($booking['end_date'])
            );
            // all the dates in the dateperiod are stored in an array. 
            foreach ($period as $key => $value) {
                $bookedDays[] = $value->format('Y-m-d');
            }
        }
        //comparing the arrays to check for duplicate values.
        $result = array_intersect($bookedDays, $bookingRequest);

        //if no similar values, executes sql query for booking.
        if (empty($result)) {
            $statement = $dbh->prepare("INSERT INTO bookings ('start_date', 'end_date', 'room', 'feature_one', 'feature_two', 'feature_three') VALUES (:start_date, :end_date, :room, :feature_one, :feature_two, :feature_three)");

            $statement->bindParam(':start_date', $startdate, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $enddate, PDO::PARAM_STR);
            $statement->bindParam(':room', $room, PDO::PARAM_STR);
            $statement->bindParam(':feature_one', $feature_one, PDO::PARAM_INT);
            $statement->bindParam(':feature_two', $feature_two, PDO::PARAM_INT);
            $statement->bindParam(':feature_three', $feature_three, PDO::PARAM_INT);

            $statement->execute();

            // insertFeatures() puts the choosen features into an array to be displayed in the json response. 
            $choosenFeatures = array();
            $choosenFeatures = insertFeatures($choosenFeatures);

            $yourBooking = [
                'island' => 'Dirt Cheap Island',
                'hotel' => 'The Very Average Island Inn',
                'arrival_date' => $startdate,
                'departure_date' => $enddate,
                'total_cost' => $totalcost,
                'stars' => '3',
                'features' => $choosenFeatures,
                'additional_info' => 'Thank you for staying at this very average hotel.'
            ];

            // deposits payment to my account. function found in verifyCode.php
            deposit($transfercode);


            echo json_encode($yourBooking);
        } else {

            header("Location: https://petterjakobsson.se/unsuccesful.html");
        }
    } else {


        header("Location: https://petterjakobsson.se/unsuccesful.html");
    }
}
