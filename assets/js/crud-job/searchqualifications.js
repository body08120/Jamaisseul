// Déclarer une variable pour stocker l'ID du délai
var timeoutId;

function filterQualifications() {
  // Récupérer la barre de recherche et la valeur saisie
  var input, filter, select, option, txtValue;
  input = document.getElementById("qualificationsSearch");
  filter = input.value.toUpperCase();

  // Récupérer le select contenant les options
  select = document.getElementById("qualificationsSelect");
  option = select.getElementsByTagName("option");

  // Loop à travers toutes les options du select, et masquer celles qui ne correspondent pas à la recherche
  for (var i = 0; i < option.length; i++) {
    txtValue = option[i].textContent || option[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      option[i].style.display = "";
    } else {
      option[i].style.display = "none";
    }
  }
}

function debounceFilter() {
  // Annuler le délai précédent s'il existe
  clearTimeout(timeoutId);

  // Définir un nouveau délai pour exécuter la recherche après 300 ms (ajuste le délai selon tes besoins)
  timeoutId = setTimeout(filterQualifications, 300); // 300 ms
}

// Ajouter un gestionnaire d'événement pour le changement de la barre de recherche
var inputElement = document.getElementById("qualificationsSearch");
inputElement.addEventListener("input", debounceFilter);
