<?php

declare(strict_types=1);

$events = array();

booking(){

    $events[] = array(
        'start' => '2022-01-14 14:40',
        'end' => '2022-01-14 15:10',
        'summary' => 'My Birthday',
        'mask' => true,
        'classes' => ['booked']
    );





    $calendar->addEvents($events)->setTimeFormat('00:00', '00:00', 10)->display(date('Y-m-d'), 'green');
}