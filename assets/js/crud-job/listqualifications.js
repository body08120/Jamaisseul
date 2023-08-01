// Gardez une liste des qualifications déjà sélectionnées
var selectedQualifications = [];

function addSelectedQualifications() {
  var qualificationsSelect = document.getElementById("qualificationsSelect");
  var selectedQualificationsList = document.getElementById("selectedQualificationsList");

  for (var i = 0; i < qualificationsSelect.options.length; i++) {
    var option = qualificationsSelect.options[i];
    if (option.selected) {
    console.log(option);
      // Vérifiez si la qualification est déjà dans la liste des qualifications sélectionnées
      if (!selectedQualifications.includes(option.value)) {
        var qualificationItem = document.createElement("div");
        qualificationItem.className = "d-flex align-items-center mb-1";
        qualificationItem.innerHTML = ` <input type="hidden" name="selectedQualifications[]" value="${option.value}">
        <span class="me-2">${option.text}</span>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeManualQualification(this)">X</button>
        `;
        selectedQualificationsList.appendChild(qualificationItem);

        // Ajoutez la qualification à la liste des qualifications sélectionnées
        selectedQualifications.push(option.value);
      }
    }
  }
}

function removeManualQualification(button) {
  var qualificationItem = button.parentElement;
  var optionValue = qualificationItem.querySelector("input[type='hidden']").value;

  // Retirez la qualification de la liste des qualifications sélectionnées
  var index = selectedQualifications.indexOf(optionValue);
  if (index !== -1) {
    selectedQualifications.splice(index, 1);
  }

  qualificationItem.remove();
}
