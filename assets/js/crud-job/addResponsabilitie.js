// Écouteur d'événement sur le formulaire d'ajout de resp
document
  .getElementById("addResponsabilitieForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    // Récupérer la valeur saisie dans le champ d'ajout de resp
    const responsabilitieName = document
      .getElementById("addResponsabilitieName")
      .value.trim();

    if (responsabilitieName !== "") {
      fetch("index.php?admin&action=AdminAjoutResponsabiliteJob", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "name_resp=" + encodeURIComponent(responsabilitieName),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Mettre à jour la liste des resps dans le select sans recharger la page
            const responsabilitiesSelect = document.getElementById(
              "responsabilitiesSelect"
            );
            const newOption = document.createElement("option");
            newOption.value = data.responsabilitie.id; // Assure-toi que le serveur renvoie l'ID correctement
            newOption.textContent = data.responsabilitie.name; // Assure-toi que le serveur renvoie le nom correctement
            responsabilitiesSelect.insertAdjacentElement(
              "afterbegin",
              newOption
            );

            // Fermer la modal après l'ajout
            var myModalEl = document.getElementById("addResponsabilitieModal");
            var addResponsabilitieModal =
              bootstrap.Modal.getInstance(myModalEl);
            addResponsabilitieModal.hide();

            const successMessageElement = document.getElementById(
              "success-message-respAdd"
            );
            successMessageElement.textContent =
              "La responsabilité a été ajoutée avec succès.";
            successMessageElement.style.display = "block";

            const errorMessageElement = document.getElementById(
              "error-message-respAdd"
            );
            errorMessageElement.style.display = "none";

            document.getElementById("addResponsabilitieForm").reset();
          } else {
            const errorMessageElement = document.getElementById(
              "error-message-respAdd"
            );
            errorMessageElement.textContent =
              "Erreur lors de l'ajout de la responsabilité.";
            errorMessageElement.style.display = "block"; // Afficher le message d'erreur
          }
        })
        .catch((error) => {
          // Gérer les erreurs de la requête AJAX
        });
    }
  });
