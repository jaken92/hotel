<?php

//prints the calendar with the booked dates marked. 
declare(strict_types=1);

require 'vendor/autoload.php';
require 'backend.php';

use benhall14\phpCalendar\Calendar as Calendar;

//inserting data from db into $events to be displayed in calendar. Putting all the booked dates into the $bookedDays array. 
$eventsReg = array();
$eventsLux = array();
$eventsBasic = array();
foreach ($bookingsX as $bookingX) {
    if ($bookingX['room'] === "basic") {
        //changing the bookings enddate to not cover the checkout-day in the calendar. 
        strtotime($bookingX['end_date']);
        $enddate = new DateTime($bookingX['end_date']);
        $enddate->modify("-1 day");

        $eventsBasic[] = array(
            'start' => $bookingX['start_date'],
            'end' => $enddate->format("Y-m-d"),
            'summary' => 'test',
            'mask' => true,
            'classes' => ['booked']

        );
    } elseif ($bookingX['room'] === "regular") {
        //changing the bookings enddate to not cover the checkout-day in the calendar. 
        strtotime($bookingX['end_date']);
        $enddate = new DateTime($bookingX['end_date']);
        $enddate->modify("-1 day");

        $eventsReg[] = array(
            'start' => $bookingX['start_date'],
            'end' => $enddate->format("Y-m-d"),
            'summary' => 'test',
            'mask' => true,
            'classes' => ['booked']

        );
    } elseif ($bookingX['room'] === "luxury") {
        //changing the bookings enddate to not cover the checkout-day in the calendar. 
        strtotime($bookingX['end_date']);
        $enddate = new DateTime($bookingX['end_date']);
        $enddate->modify("-1 day");

        $eventsLux[] = array(
            'start' => $bookingX['start_date'],
            'end' => $enddate->format("Y-m-d"),
            'summary' => 'test',
            'mask' => true,
            'classes' => ['booked']

        );
    }
}

$calendarBasic = new Calendar();
$calendarBasic->useMondayStartingDate();
$calendarBasic->addEvents($eventsBasic);


$calendarReg = new Calendar();
$calendarReg->useMondayStartingDate();
$calendarReg->addEvents($eventsReg);

$calendarLux = new Calendar();
$calendarLux->useMondayStartingDate();
$calendarLux->addEvents($eventsLux);



// myFunc($events, $calendar);

// function myFunc($events, $calendar)
// {

// }

// function printToCalendar(string $roomtype, array $calendarArray, array $roomArray, array $bookingsX)
// {

//     foreach ($bookingsX as $bookingX) {
//         if ($bookingX['room'] === $roomtype) {
//             //changing the bookings enddate to not cover the checkout-day in the calendar. 
//             strtotime($bookingX['end_date']);
//             $enddate = new DateTime($bookingX['end_date']);
//             $enddate->modify("-1 day");

//             $calendarArray[] = array(
//                 'start' => $bookingX['start_date'],
//                 'end' => $enddate->format("Y-m-d"),
//                 'summary' => 'test',
//                 'mask' => true,
//                 'classes' => ['booked']

//             );

//             //Seperate array used for avalability check. Method doesnt put the end_date into the array. 
//             $period = new DatePeriod(
//                 new DateTime($bookingX['start_date']),
//                 new DateInterval('P1D'),
//                 new DateTime($bookingX['end_date'])
//             );
//             foreach ($period as $key => $value) {
//                 $roomArray[] = $value->format('Y-m-d');
//             }
//         }
//     }
//     return $calendarArray;
// };


// $room = "luxury";
// $luxBookedDays = array();
// $luxCalendarDays = array();
// $luxCalendarDays = printToCalendar($room, $luxCalendarDays, $luxBookedDays, $bookingsX,);

// $calendar = new Calendar();
// $calendar->useMondayStartingDate();
// $calendar->addEvents($luxCalendarDays);

// $room = "regular";
// $regCalendarDays = array();
// $regBookedDays = array();
// $regCalendarDays = printToCalendar($room, $regCalendarDays, $regBookedDays, $bookingsX);

// $calendarReg = new Calendar();
// $calendarReg->useMondayStartingDate();
// $calendarReg->addEvents($regCalendarDays);

// $room = "basic";
// $basicCalendarDays = array();
// $basicBookedDays = array();
// $basicCalendarDays = printToCalendar($room, $regCalendarDays, $regBookedDays, $bookingsX);

// $calendarBasic = new Calendar();
// $calendarBasic->useMondayStartingDate();
// $calendarBasic->addEvents($basicCalendarDays);



// $stmt = $dick->prepare('SELECT * FROM bookingsX where room = :email');
// $stmt->bindValue(':email', 'regular');
// $stmt->execute();
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($results as $result) {

//     $period = new DatePeriod(
//         new DateTime($result['start_date']),
//         new DateInterval('P1D'),
//         new DateTime($result['end_date'])
//     );
//     foreach ($period as $key => $value) {
//         $bokadeDagar[] = $value->format('Y-m-d');
//     }
// }
// print_r($bokadeDagar);
