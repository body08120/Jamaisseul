// Écouteur d'événement sur le formulaire d'ajout de qualification
document
  .getElementById("addQualificationForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    // Récupérer la valeur saisie dans le champ d'ajout de qualification
    const qualificationName = document
      .getElementById("addQualificationName")
      .value.trim();

    if (qualificationName !== "") {
      fetch("index.php?admin&action=AdminAjoutQualificationJob", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "name=" + encodeURIComponent(qualificationName),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Mettre à jour la liste des qualifications dans le select sans recharger la page
            const qualificationsSelect = document.getElementById(
              "qualificationsSelect"
            );
            const newOption = document.createElement("option");
            newOption.value = data.qualification.id; // Assure-toi que le serveur renvoie l'ID correctement
            newOption.textContent = data.qualification.name; // Assure-toi que le serveur renvoie le nom correctement
            qualificationsSelect.insertAdjacentElement("afterbegin", newOption);

            // Fermer la modal après l'ajout
            var myModalEl = document.getElementById("addQualificationModal");
            var addQualificationModal = bootstrap.Modal.getInstance(myModalEl);
            addQualificationModal.hide();

            const successMessageElement =
              document.getElementById("success-message-qualifAdd");
            successMessageElement.textContent =
              "La qualification a été ajoutée avec succès.";
            successMessageElement.style.display = "block";

            const errorMessageElement =
              document.getElementById("error-message-qualifAdd");
            errorMessageElement.style.display = "none";

            document.getElementById("addQualificationForm").reset();

          } else {

            const errorMessageElement =
              document.getElementById("error-message-qualifAdd");
            errorMessageElement.textContent =
              "Erreur lors de l'ajout de la qualification.";
            errorMessageElement.style.display = "block"; // Afficher le message d'erreur
          }
        })
        .catch((error) => {
          // Gérer les erreurs de la requête AJAX
        });
    }
  });
