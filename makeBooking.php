<?php

declare(strict_types=1);
require "calendar.php";
require "verifyCode.php";
// require "arrays.php";



if (isset($_POST['startdate'], $_POST['enddate'], $_POST['transfercode'], $_POST['room'])) {
    //storing user input from post.
    $startdate = htmlspecialchars($_POST['startdate']);
    $enddate = htmlspecialchars($_POST['enddate']);
    $transfercode = htmlspecialchars($_POST['transfercode']);
    $room = htmlspecialchars($_POST['room']);

    $choosenFeatures = array();
    $choosenFeatures = insertFeatures($choosenFeatures);

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

    //declaring array which we are going to fill with the requested days.  
    $bookingRequest = array();


    //covering the dates between the requested booking, minus the checkoutday. https://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
    $period = new DatePeriod(
        new DateTime($startdate),
        new DateInterval('P1D'),
        new DateTime($enddate)
    );

    //storing all the dates in the bookingRequest array
    foreach ($period as $key => $value) {
        $bookingRequest[] = $value->format('Y-m-d');
    }

    //calculating cost for room+features. Functions found in hotelFunctions.php.
    $roomcost = roomTotalCost($bookingRequest, $room);
    $featurecost = featuresTotalCost();
    $totalcost = $roomcost + $featurecost;

    //veryfing transfercode. If valid continues with the booking process. Functions found in hotelsFunction.php and in verifyCode.php.
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
            // echo "booking succesful";
            $statement = $dbh->prepare("INSERT INTO bookings ('start_date', 'end_date', 'room', 'feature_one', 'feature_two', 'feature_three') VALUES (:start_date, :end_date, :room, :feature_one, :feature_two, :feature_three)");

            $statement->bindParam(':start_date', $startdate, PDO::PARAM_STR);
            $statement->bindParam(':end_date', $enddate, PDO::PARAM_STR);
            $statement->bindParam(':room', $room, PDO::PARAM_STR);
            $statement->bindParam(':feature_one', $feature_one, PDO::PARAM_INT);
            $statement->bindParam(':feature_two', $feature_two, PDO::PARAM_INT);
            $statement->bindParam(':feature_three', $feature_three, PDO::PARAM_INT);

            $statement->execute();

            $yourBooking = [
                'island' => 'Mamona',
                'hotel' => 'Horale Hotel',
                'arrival_date' => $startdate,
                'departure_date' => $enddate,
                'total_cost' => $totalcost,
                'stars' => '3',
                'features' => $choosenFeatures,
                'additional_info' => 'Thank you for staying at this very avarage hotel.'
            ];


            deposit($transfercode);


            echo json_encode($yourBooking);
        } else {
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
