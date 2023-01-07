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
      label.innerHTML = feature.name + ' (' + feature.cost + ')';
      label.htmlFor = feature.id;
      const checkboxContainer = document.createElement('div');
      container.appendChild(checkboxContainer);
      checkboxContainer.appendChild(label);
      checkboxContainer.appendChild(input);
    });
  });

const standards = [];
const roomnames = [];
const roomcosts = [];

fetch('http://localhost:3000/rooms.php')
  .then((response) => response.json())
  .then((rooms) => {
    rooms.forEach((room) => {
      standards.push(room.id);
      roomnames.push(room.name);
      roomcosts.push(room.cost);
    });
  });
console.log(standards);
console.log(roomnames);
console.log(roomcosts);
