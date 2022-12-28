<?php
require 'calendar.php';
// require 'bookings.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="calendar.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="section-one">
        <div class="calendar-container">
            <div class="calendar">
                <?= $calendar->display(date('2023-01-01')); ?>
            </div>
        </div>
        <div>
            <form method="post" action="makeBooking.php">
                <label for="startdate">Enter the startdate of your stay</label>
                <!-- <input type="text" name="startdate"> -->
                <input type="date" name="startdate" min="2023-01-01" max="2023-01-31">
                <label for="enddate">Enter your checkout day</label>
                <!-- <input type="text" name="enddate"> -->
                <input type="date" name="enddate" min="2023-01-01" max="2023-01-31">
                <button>Book your stay</button>

            </form>
        </div>
    </div>

</body>

</html>