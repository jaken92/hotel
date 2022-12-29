<?php

//prints the calendar with the booked dates marked. 
declare(strict_types=1);

require 'vendor/autoload.php';
require 'backend.php';

use benhall14\phpCalendar\Calendar as Calendar;

//inserting data from db into $events to be displayed in calendar. Putting all the booked dates into the $bookedDays array. 
$events = array();
$bookedDays = array();
foreach ($bookingsX as $bookingX) {

    //changing the bookings enddate to not cover the checkout-day in the calendar. 
    strtotime($bookingX['end_date']);
    $enddate = new DateTime($bookingX['end_date']);
    $enddate->modify("-1 day");


    $events[] = array(
        'start' => $bookingX['start_date'],
        'end' => $enddate->format("Y-m-d"),
        'summary' => 'test',
        'mask' => true,
        'classes' => ['booked']

    );

    //Seperate array used for avalability check. the date-period method isnt able to cover enddate in php 8.1 which is why i choose to work with this array instead of $events[] where i have already modified the enddate. 
    $period = new DatePeriod(
        new DateTime($bookingX['start_date']),
        new DateInterval('P1D'),
        new DateTime($bookingX['end_date'])
    );
    foreach ($period as $key => $value) {
        $bookedDays[] = $value->format('Y-m-d');
    }
}


// foreach ($bookingsX as $bookingX) {



//     $events[] = array(
//         'start' => $bookingX['start_date'],
//         'end' => $bookingX['end_date'],
//         'summary' => 'test',
//         'mask' => true,
//         'classes' => ['booked']

//     );

// }




$calendar = new Calendar();
$calendar->useMondayStartingDate();

myFunc($events, $calendar);

function myFunc($events, $calendar)
{
    $calendar->addEvents($events);
}
