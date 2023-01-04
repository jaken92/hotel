const container = document.querySelector('.features-container');

fetch('http://localhost:3000/features.php')
  .then((response) => response.json())
  .then((features) => {
    features.forEach((feature) => {
      const input = document.createElement('input');
      input.type = 'checkbox';
      input.name = feature.id;
      input.value = feature.cost;
      const label = document.createElement('label');
      label.innerHTML = feature.name + ' (' + feature.cost + ')';
      label.htmlFor = feature.id;
      const checkboxContainer = document.createElement('div');
      container.appendChild(checkboxContainer);
      checkboxContainer.appendChild(label);
      checkboxContainer.appendChild(input);
    });
  });

// checkbox.type = 'checkbox';
// checkbox.name = 'name';
// checkbox.value = 'value';
// checkbox.id = 'id';

// // creating label for checkbox
// var label = document.createElement('label');

// // assigning attributes for
// // the created label tag
// label.htmlFor = 'id';
