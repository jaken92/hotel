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
    <link rel="stylesheet" href="styling.css">
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
            <img class="hero" src="images/banner.png" alt="">
        </div>
    </div>
    <div class="sections">
        <h2>Basic</h2>
        <h3>Beachview</h3>
        <div class="basic-content">
            <div class="calendar-container">
                <div class="calendar">
                    <?= $calendarBasic->display(date('2023-01-01'), 'green'); ?>
                </div>
            </div>
            <div class="basic-container">
                <div class="beachimg-container">
                    <img class="beachimg" src="/images/beachview.png" alt="">
                </div>
            </div>
        </div>
        <p>Enjoy this gem of an island fully by sleeping under the blue sky on the beach. Your stay includes a very cosy blanket the we wash occasionaly. If you select this option we warmly reccomend you to preorder the feature "baseball-bat" to fend off the raccoons that occasionaly terrorize our guests during nighttime.
        </p>
    </div>
    <div class="sections">
        <h2>Basic</h2>
        <h3>Beachview</h3>
        <div class="regular-content">
            <div class="calendar-container">
                <div class="calendar">
                    <?= $calendarReg->display(date('2023-01-01'), 'green'); ?>
                </div>
            </div>
            <div class="basic-container">
                <div class="beachimg-container">
                    <img class="treehouse" src="/images/treehouse.png" alt="">
                </div>
            </div>
        </div>
        <p>Enjoy this gem of an island fully by sleeping under the blue sky on the beach. Your stay includes a very cosy blanket the we wash occasionaly. If you select this option we warmly reccomend you to preorder the feature "baseball-bat" to fend off the raccoons that occasionaly terrorize our guests during nighttime. </p>
    </div>
    <div class="sections">
        <h2>Basic</h2>
        <h3>Beachview</h3>
        <div class="luxury-content">
            <div class="calendar-container">
                <div class="calendar">
                    <?= $calendarLux->display(date('2023-01-01'), 'green'); ?>
                </div>
            </div>
            <div class="basic-container">
                <div class="beachimg-container">
                    <img class="beachimg" src="/images/bungalow.png" alt="">
                </div>
            </div>
        </div>
        <p>Enjoy this gem of an island fully by sleeping under the blue sky on the beach. Your stay includes a very cosy blanket the we wash occasionaly. If you select this option we warmly reccomend you to preorder the feature "baseball-bat" to fend off the raccoons that occasionaly terrorize our guests during nighttime. </p>
    </div>
    <div class="section-form">
        <h2>Book your stay</h2>
        <div class="booking-content">
            <div>
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
                    <div class="features-container">

                    </div>
                    <button>Book your stay</button>
                </form>
            </div>
            <div class="bar-container">
                <img class="bar-img" src="/images/bar.png" alt="">
            </div>
        </div>
    </div>
    <ul class="features">

    </ul>
    <script src="script.js"></script>
    <script src="fetch.js"></script>
</body>

</html>