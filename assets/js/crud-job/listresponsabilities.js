// Gardez une liste des responsabilitiess déjà sélectionnées
var selectedResponsabilities = [];

function addSelectedResponsabilities() {
  var responsabilitiesSelect = document.getElementById("responsabilitiesSelect");
  var selectedResponsabilitiesList = document.getElementById("selectedResponsabilitiesList");

  for (var i = 0; i < responsabilitiesSelect.options.length; i++) {
    var option = responsabilitiesSelect.options[i];
    if (option.selected) {
      // Vérifiez si la responsabilities est déjà dans la liste des responsabilitiess sélectionnées
      if (!selectedResponsabilities.includes(option.value)) {
        var responsabilitieItem = document.createElement("div");
        responsabilitieItem.className = "d-flex align-items-center mb-1";
        responsabilitieItem.innerHTML = ` <input type="hidden" name="selectedResponsabilities[]" value="${option.value}">
        <span class="me-2">${option.text}</span>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeManualResponsabilitie(this)">X</button>
        `;
        selectedResponsabilitiesList.appendChild(responsabilitieItem);

        // Ajoutez la responsabilities à la liste des responsabilitiess sélectionnées
        selectedResponsabilities.push(option.value);
      }
    }
  }
}

function removeManualResponsabilitie(button) {
  var responsabilitieItem = button.parentElement;
  var optionValue = responsabilitieItem.querySelector("input[type='hidden']").value;

  // Retirez la responsabilities de la liste des responsabilitiess sélectionnées
  var index = selectedResponsabilities.indexOf(optionValue);
  if (index !== -1) {
    selectedResponsabilities.splice(index, 1);
  }

  responsabilitieItem.remove();
}
