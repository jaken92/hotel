<?php
require 'calendar.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/calendar.css">
    <link rel="stylesheet" href="/CSS/styling.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <title>The raccoon hotel</title>
</head>

<body>
    <header>
        <nav class="nav-bar">
            <a href="#" class="nav-branding">
                <img class="logo" src="/images/raccoon.png" alt="">
            </a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#basic" class="nav-link">Basic</a>
                </li>
                <li class="nav-item">
                    <a href="#regular" class="nav-link">Regular</a>
                </li>
                <li class="nav-item">
                    <a href="#luxury" class="nav-link">Luxury</a>
                </li>
                <li class="nav-item">
                    <a href="#booking" class="nav-link">Make Booking</a>
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
            <div class="headline-container">
                <h1>The very avarage island inn</h1>
            </div>
        </div>
    </div>
    <div id="basic" class="sections">
        <h2 class="basic-id">Basic</h2>
        <h3 class="basic-name">Beachview</h3>
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
        <p>Enjoy this gem of an island fully by sleeping under the blue sky on the beach. Your stay includes a very cosy blanket that we wash occasionaly, aswell as an almost waterproof parasol. If you select this option we warmly reccomend you to preorder the feature "baseball-bat" as you might need to fend off the aggressive raccoons that terrorize our guests during nighttime.
        </p>
    </div>
    <div id="regular" class="sections">
        <h2 class="regular-id">Basic</h2>
        <h3 class="regular-name">Beachview</h3>
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
        <p>Oh? Sleeping outside is not for you? Dont worry! For just 2$ you get to spend the night in our one-of-a-kind Treehouse! Enjoy the view from above! For this option we reccomend that you select the feature "vaccination" as one of our guests recently got bitten by one of the monkeys that inhabits the tree. Dont worry though. If you dont like vaccinations, the "baseball-bat" feature is avalible here aswell. Better safe than sorry!</p>
    </div>
    <div id="luxury" class="sections">
        <h2 class="lux-id">Basic</h2>
        <h3 class="lux-name">Beachview</h3>
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
        <p>Did you bring the big wallet? Great! Don´t hestitate to book your stay in our fabulous bungalow! For just $3 you get to sleep comfortably sheltered from the islands wildlife. Located close to the beach restaurant and just a few steps from the shoreline, this option has everything you need for a relaxing vacation! Except... maybe... A minibar? Dont worry! Just select "minibar" in the features list of your booking. The option gives you unlimited acces to a variety of delicious beverages. Are you up for the challenge? </p>
    </div>
    <div id="booking" class="section-form">
        <h2>BOOKING</h2>
        <div class="booking-content">
            <div class="form-container">
                <form method="post" action="makeBooking.php">
                    <h3>Book your stay</h3>
                    <label for="startdate">Enter the startdate of your stay</label>
                    <input type="date" name="startdate" min="2023-01-01" max="2023-01-31">
                    <label for="enddate">Enter your checkout day</label>
                    <input type="date" name="enddate" min="2023-01-01" max="2023-01-31">
                    <label for="room">Choose room type</label>
                    <select type="text" name="room" id="">
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