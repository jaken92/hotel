const container = document.querySelector('.features-container');

fetch('http://localhost:3000/features.php')
  .then((response) => response.json())
  .then((features) => {
    features.forEach((feature) => {
      const input = document.createElement('input');
      input.type = 'checkbox';
      input.name = feature.id;
      input.value = 1;
      const label = document.createElement('label');
      // label.innerHTML = feature.name + ' ($' + feature.cost + ')';
      label.innerHTML = `${feature.name} $${feature.cost}`;
      label.htmlFor = feature.id;
      const checkboxContainer = document.createElement('div');
      container.appendChild(checkboxContainer);
      checkboxContainer.appendChild(label);
      checkboxContainer.appendChild(input);
    });
  });

// let standards = [];
// const roomnames = [];
// const roomcosts = [];

const basicId = document.querySelector('.basic-id');
const basicName = document.querySelector('.basic-name');

const regularId = document.querySelector('.regular-id');
const regularName = document.querySelector('.regular-name');

const luxId = document.querySelector('.lux-id');
const luxName = document.querySelector('.lux-name');

// fetch('http://localhost:3000/rooms.php')
//   .then((response) => response.json())
//   .then((rooms) => {
//     rooms.forEach((room) => {
//       standards.push(String(room.id));
//       roomnames.push(room.name);
//       roomcosts.push(room.cost);
//     });
//   });
// console.log(standards);
// console.log(roomnames);
// console.log(roomcosts);
// basicId.innerHTML = standards[0];
// console.log(array.length(standards));
const select = document.querySelector('select');

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
