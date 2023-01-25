<?php

$file = file_get_contents(__DIR__ . "/logbook.json");
$logBook = json_decode($file, true);
$totalCost = 0;
$numberOfBookings = 0;
$costPerBooking = 0;

?>

<main>
     <section class="logSection">
          <div class="logCards">
               <?php
               foreach ($logBook as $log => $hotelBookings) :
                    foreach ($hotelBookings as $hotelBooking) :
                         $totalCost += (int) $hotelBooking["total_cost"];
                         $numberOfBookings++;
               ?>
                         <article class="logCard">
                              <p class="headline">Visit Confirmed</p>
                              <p>Island: <?= $hotelBooking["island"] ?></p>
                              <p>Hotel: <?= $hotelBooking["hotel"] ?></p>
                              <p>Arrival Date: <?= $hotelBooking["arrival_date"] ?></p>
                              <p>Departure Date: <?= $hotelBooking["departure_date"] ?></p>
                              <p>Cost: <?= $hotelBooking["total_cost"] ?>$</p>
                         </article>
               <?php
                    endforeach;
               endforeach;
               $costPerBooking = $totalCost / $numberOfBookings;
               $costPerBooking = round($costPerBooking, 1);
               ?>
          </div>
          <article class="logFactBox">
               <div>
                    <p class="headline">Total Cost Fact Box</p>
                    <p>Amount spent: <b><?= $totalCost ?> $</b></p>
                    <p>Number of bookings: <b><?= $numberOfBookings ?></b></p>
                    <p>Cost per booking: <b><?= $costPerBooking ?> $</b></p>
               </div>

          </article>
     </section>
</main>
