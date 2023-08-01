// Fonction pour remplir le select avec les communes
function fillSelectWithCommunes(locations) {
  const selectLocations = document.getElementById("locationsSelect");

  // Boucle pour ajouter chaque commune comme option dans le select
  locations.forEach((location) => {
    var commune = location.Nom_de_la_commune + ' ' + location.Code_postal;
    const option = document.createElement("option");
    option.value = location.Code_commune_INSEE; // Utilisez le code INSEE comme valeur de l'option
    option.textContent = commune; // Le nom de la commune à afficher
    selectLocations.appendChild(option);
  });
}

// Fonction pour charger le fichier CSV et afficher les communes
function loadCSVAndDisplayCommunes() {
  Papa.parse("assets/js/crud-job/locations.csv", {
    download: true,
    header: true,
    delimiter: ";",
    complete: function (results) {
      const locationsData = results.data;
      fillSelectWithCommunes(locationsData);
    },
  });
}

// Appeler la fonction pour charger le fichier CSV et afficher les communes
loadCSVAndDisplayCommunes();
