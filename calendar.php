<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'backend.php';

use benhall14\phpCalendar\Calendar as Calendar;

$startDay = 22;
$endDay = 24;



$events = array();

// $events[] = array(
//     'start' => '2023-01-14',
//     'end' => '2023-01-18',
//     'summary' => 'My Birthday',
//     'mask' => true,
//     'classes' => ['booked']
// );
// $events[] = array(
//     'start' => '2023-01-01',
//     'end' => '2023-01-04',
//     'summary' => 'test',
//     'mask' => true,
//     'classes' => ['booked']

// );

// $events[] = array(
//     'start' => '2023-01-' . $startDay,
//     'end' => '2023-01-' . $endDay,
//     'summary' => 'test',
//     'mask' => true,
//     'classes' => ['booked']

// );

foreach ($bookings as $booking) {
    $events[] = array(
        'start' => '2023-01-' . $booking['start_date'],
        'end' => '2023-01-' . $booking['end_date'],
        'summary' => 'test',
        'mask' => true,
        'classes' => ['booked']

    );
}





$calendar = new Calendar();
$calendar->useMondayStartingDate();

myFunc($events, $calendar);

function myFunc($events, $calendar)
{
    $calendar->addEvents($events);
}
