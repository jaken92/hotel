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
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="nav-bar">
            <a href="#" class="nav-branding">P</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>
    <div class="section-one">
        <div class="hero-container">
            <img class="hero" src="images/pexels-julia-volk-7293098.jpg" alt="">
        </div>
    </div>
    <div class="section-two">
        <div class="calendar-container">
            <div class="calendar">
                <?= $calendarBasic->display(date('2023-01-01')); ?>
            </div>
        </div>
    </div>
    <div class="section-two">
        <div class="calendar-container">
            <div class="calendar">
                <?= $calendarReg->display(date('2023-01-01')); ?>
            </div>
        </div>
    </div>
    <div class="section-two">
        <div class="calendar-container">
            <div class="calendar">
                <?= $calendarLux->display(date('2023-01-01')); ?>
            </div>
        </div>
    </div>
    <div class="section-form">
        <form method="post" action="makeBooking.php">
            <label for="startdate">Enter the startdate of your stay</label>
            <!-- <input type="text" name="startdate"> -->
            <input type="date" name="startdate" min="2023-01-01" max="2023-01-31">
            <label for="enddate">Enter your checkout day</label>
            <!-- <input type="text" name="enddate"> -->
            <input type="date" name="enddate" min="2023-01-01" max="2023-01-31">
            <label for="room">Choose room type</label>
            <select name="room" id="">
                <option value="basic">Basic</option>
                <option value="regular">Regular</option>
                <option value="luxury">Luxury</option>
            </select>
            <label for="transfercode">Enter your transfercode below</label>
            <input type="text" name="transfercode" placeholder="Paste transfercode here">
            <button>Book your stay</button>

        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>