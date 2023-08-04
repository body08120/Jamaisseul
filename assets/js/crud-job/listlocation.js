// Gardez une liste des qualifications déjà sélectionnées
var selectedLocations = [];

function addSelectedLocations() {
  var locationsSelect = document.getElementById("locationsSelect");
  var selectedLocationsList = document.getElementById("selectedLocationsList");

  for (var i = 0; i < locationsSelect.options.length; i++) {
    var option = locationsSelect.options[i];
    if (option.selected) {
      console.log(option.text);
      if (!selectedLocations.includes(option.value)) {
        var locationItem = document.createElement("div");
        locationItem.className = "d-flex align-items-center mb-1";
        locationItem.innerHTML = ` <input type="hidden" name="selectedLocations[]" value="${option.value}">
        <span class="me-2">${option.text}</span>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeManualLocation(this)">X</button>
        `;
        selectedLocationsList.appendChild(locationItem);

        selectedLocations.push(option.value);
      }
    }
  }
}

function removeManualLocation(button) {
  var locationItem = button.parentElement;
  var optionValue = locationItem.querySelector(
    "input[type='hidden']"
  ).value;

  var index = selectedLocations.indexOf(optionValue);
  if (index !== -1) {
    selectedLocations.splice(index, 1);
  }

  locationItem.remove();
}
