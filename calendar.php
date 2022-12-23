<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;


$events = array();

$events[] = array(
    'start' => '2023-01-14',
    'end' => '2023-01-18',
    'summary' => 'My Birthday',
    'mask' => true,
    'classes' => ['booked']
);
$events[] = array(
    'start' => '2023-01-01',
    'end' => '2023-01-04',
    'summary' => 'test',
    'mask' => true,
    'classes' => ['booked']

);




$calendar = new Calendar();
$calendar->useMondayStartingDate();
$calendar->addEvents($events);
