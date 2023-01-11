const container = document.querySelector('.features-container');

//fetching features and printing them out in the booking form.
//http://localhost:3000/features.php
//https://petterjakobsson.se/features.php
fetch('http://localhost:3000/features.php')
  .then((response) => response.json())
  .then((features) => {
    features.forEach((feature) => {
      //creating inputfields of type checkbox for each feature from the features table.
      const input = document.createElement('input');
      input.type = 'checkbox';
      input.name = feature.id;
      input.value = 1;
      //letting the label for each checkbox use feature "name" and "cost" as innerHTML.
      const label = document.createElement('label');
      label.innerHTML = `${feature.name} $${feature.cost}`;
      label.htmlFor = feature.id;
      //creating a "checkboxContainer" wrapping each input + label.
      const checkboxContainer = document.createElement('div');
      //appending all created elements.
      container.appendChild(checkboxContainer);
      checkboxContainer.appendChild(label);
      checkboxContainer.appendChild(input);
    });
  });

//selecting html elements in which im going to print db data from "rooms"-table.

const basicId = document.querySelector('.basic-id');
const basicName = document.querySelector('.basic-name');

const regularId = document.querySelector('.regular-id');
const regularName = document.querySelector('.regular-name');

const luxId = document.querySelector('.lux-id');
const luxName = document.querySelector('.lux-name');

const select = document.querySelector('select');
//http://localhost:3000/rooms.php
//https://petterjakobsson.se/rooms.php
//fetching "rooms" data and printing out info about them in the html.
fetch('http://localhost:3000/rooms.php')
  .then((response) => response.json())
  .then((rooms) => {
    //Setting the heading innerHTML for each section.
    basicId.innerHTML = rooms[0]['id'];
    basicName.innerHTML = `${rooms[0]['name']}  $${rooms[0]['cost']}`;

    regularId.innerHTML = rooms[1]['id'];
    regularName.innerHTML = `${rooms[1]['name']}  $${rooms[1]['cost']}`;

    luxId.innerHTML = rooms[2]['id'];
    luxName.innerHTML = `${rooms[2]['name']}  $${rooms[2]['cost']}`;

    //Making each room appears as an option in the "select"- element in the booking form.
    rooms.forEach((room) => {
      const option = document.createElement('option');
      option.value = room.id;
      option.innerHTML = room.id;
      select.appendChild(option);
    });
  });
