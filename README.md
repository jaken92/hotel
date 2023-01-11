# Dirt Cheap Island

Dirt Cheap Island is dirt cheap. Come visit!

# The Very Avarage Island Inn

Neat little hotel with very avarage facilities! I recommend for you my friend.

# Instructions

Start a php server with localhost from the map where the files are located. Change the links in the fetch-statements in the fetch.js file to be valid for the localhost you are running. Example https://petterjakobsson.se/features.php can be changed to http://localhost:3000/features.php. Same goes for the links in makeBooking.php line 122 and 127. Aswell as unsuccesful.html, line 25.

Now fire up your webapp and browse in on http://localhost:YourPort/index.php to book your stay at this avarage hotel!

Or just find the application online at https://petterjakobsson.se.

# Code review

1. calendar.php:12-55 - Du kunde gjort en funktion som tar emot parametrarna array och string för att slippa att repetera kod.
2. calendar.php:6-7 - Kan vara bra att ha med **DIR** i din require.
3. databasen: -rooms och features: Kan vara bra att id är siffra och inte namn, då kan man lättare länka till andra tabeller om man så vill.
4. fetch.js:30-63 - Du kunde även här gjort en function för att slippa upprepa kod.
5. index.php:8-25 - De raderna hade du kunna lägga in en header.php-fil. Och ha sluttaggar på body och html i en footer.php.
6. index.php:66, 84, 101 - Beachview finns inte med på sidan? Skriver Js över det när du hämtar namnen från db?
   7.index.php :65, 83, 100 - Samma gäller för Basic. Blir lite förvirrande. Hade varit bra att lämna den diven tom eller skriva namnet på rummet som den tillhör.
7. verifyCode.php:38 - Du kallar på funktionen innan du skapar den och har en hårdkodad transfer code i.
8. verifyCode.php:118-121 - Utkommenterad kod, kan vara snyggt att resna bort. Fanns lite uttkomenterad kod i en annan fil med.
9. unsuccesful.html: - Borde vara en php fil med html kod i som i index.php.
10. Css-filerna - Kan vara bra att göra en :root med font och färger.
11. - Side note, du har inte med din vendor på github.. vet inte om den bör läggas upp...

-   Punkt 6,7 och 8 åtgärdade efter codereview. /Petter
