const container = document.querySelector('.features-container');

//fetching features and printing them out in the booking form.
//https://petterjakobsson.se/features.php
fetch('http://localhost:3000/features.php')
  .then((response) => response.json())
  .then((features) => {
    features.forEach((feature) => {
      const input = document.createElement('input');
      input.type = 'checkbox';
      input.name = feature.id;
      input.value = 1;
      const label = document.createElement('label');
      label.innerHTML = `${feature.name} $${feature.cost}`;
      label.htmlFor = feature.id;
      const checkboxContainer = document.createElement('div');
      container.appendChild(checkboxContainer);
      checkboxContainer.appendChild(label);
      checkboxContainer.appendChild(input);
    });
  });

//selecting html elements where i want to print db data from "rooms"-table.

const basicId = document.querySelector('.basic-id');
const basicName = document.querySelector('.basic-name');

const regularId = document.querySelector('.regular-id');
const regularName = document.querySelector('.regular-name');

const luxId = document.querySelector('.lux-id');
const luxName = document.querySelector('.lux-name');

const select = document.querySelector('select');

//https://petterjakobsson.se/features.php
//fetching rooms and printing out info about them in the html. Making the rooms appeaer in the booking from as a list where u can select from them.
fetch('http://localhost:3000/rooms.php')
  .then((response) => response.json())
  .then((rooms) => {
    basicId.innerHTML = rooms[0]['id'];
    basicName.innerHTML = `${rooms[0]['name']}  $${rooms[0]['cost']}`;

    regularId.innerHTML = rooms[1]['id'];
    regularName.innerHTML = `${rooms[1]['name']}  $${rooms[1]['cost']}`;

    luxId.innerHTML = rooms[2]['id'];
    luxName.innerHTML = `${rooms[2]['name']}  $${rooms[2]['cost']}`;

    rooms.forEach((room) => {
      const option = document.createElement('option');
      option.value = room.id;
      option.innerHTML = room.id;
      select.appendChild(option);
    });
  });
