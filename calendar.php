<?php

//prints the calendar with the booked dates marked. 
declare(strict_types=1);

require 'vendor/autoload.php';
require 'bookings.php';

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
