<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title_job']) && isset($_POST['desc_job']) && isset($_POST['chief_job']) && isset($_POST['date_job_created']) && isset($_POST['date_job_started']) && isset($_POST['selectedLocations']) && isset($_POST['selectedQualifications']) && isset($_POST['selectedResponsabilities']) && isset($_FILES['picture_job'])) {
        if ($_POST['title_job'] !== '' && $_POST['desc_job'] !== '' && $_POST['chief_job'] !== '' && $_POST['date_job_created'] !== '' && $_POST['date_job_started'] !== '' && $_POST['selectedLocations'] !== '' && $_POST['selectedQualifications'] !== '' && $_POST['selectedResponsabilities'] !== '' && $_FILES['picture_job']['name'] !== '') {

            // Recupération et filtrage des données
            $title = htmlspecialchars(strip_tags(trim($_POST['title_job'])));
            $desc = htmlspecialchars(strip_tags(trim($_POST['desc_job'])));
            $chief = htmlspecialchars(strip_tags(trim($_POST['chief_job'])));
            $selectedLocations = $_POST['selectedLocations'];
            $selectedQualifications = $_POST['selectedQualifications'];
            $selectedResponsabilities = $_POST['selectedResponsabilities'];

            // Dates
            $dateCreated = htmlspecialchars(strip_tags(trim($_POST['date_job_created'])));
            $dateStarted = htmlspecialchars(strip_tags(trim($_POST['date_job_started'])));
            // Convertir les dates en objets DateTime
            $dateCreatedObj = DateTime::createFromFormat('Y-m-d\TH:i', $dateCreated);
            $dateStartedObj = DateTime::createFromFormat('Y-m-d\TH:i', $dateStarted);
            // Vérifier si les dates sont valides
            if (!$dateCreatedObj || !$dateStartedObj) {
                $_SESSION['error-message'] = "Les dates fournies ne sont pas valides !";
                header('location: index.php?admin&action=AdminAjoutEmploi');
                exit();
            }
            // Vérifier si la date de début est postérieure ou égale à la date de création
            if ($dateStartedObj < $dateCreatedObj) {
                $_SESSION['error-message'] = "La date de début doit être postérieure ou égale à la date de création !";
                header('location: index.php?admin&action=AdminAjoutEmploi');
                exit();
            }
            // Formater les dates dans le format DATETIME
            $formattedDateCreated = $dateCreatedObj ? $dateCreatedObj->format('Y-m-d H:i:s') : null;
            $formattedDateStarted = $dateStartedObj ? $dateStartedObj->format('Y-m-d H:i:s') : null;

            // Vérification de l'image et upload
            $path = $_SERVER['DOCUMENT_ROOT'] . 'upload/';

            try {

                if (!empty($_FILES['picture_job'])) {
                    $nameFile = $_FILES['picture_job']['name'];
                    $typeFile = $_FILES['picture_job']['type'];
                    $tmpFile = $_FILES['picture_job']['tmp_name'];
                    $errorFile = $_FILES['picture_job']['error'];
                    $sizeFile = $_FILES['picture_job']['size'];

                    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
                    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

                    $extension = explode('.', $nameFile);

                    $max_size = 500000;

                    if (in_array($typeFile, $type)) {
                        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                            if ($sizeFile <= $max_size && $errorFile == 0) {
                                if (move_uploaded_file($tmpFile, $picture = 'upload/' . uniqid() . '.' . end($extension))) {
                                    // echo "Upload effectué !";

                                } else {
                                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                                    header('location: index.php?admin&action=AdminAjoutEmploi');
                                    exit();
                                }
                            } else {
                                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                                header('location: index.php?admin&action=AdminAjoutEmploi');
                                exit();
                            }
                        } else {
                            $_SESSION['error-message'] = "Merci d'uploader une image !";
                            header('location: index.php?admin&action=AdminAjoutEmploi');
                            exit();
                        }
                    } else {
                        $_SESSION['error-message'] = "Type non autorisé !";
                        header('location: index.php?admin&action=AdminAjoutEmploi');
                        exit();
                    }
                }

                $desc_picture = htmlspecialchars(strip_tags(trim($_FILES['picture_job']['name'])));

                // On instancie notre objet 'job'
                $job = new Job();
                $job->setJobTitle($title);
                $job->setJobDescription($desc);
                $job->setJobPicture($picture);
                $job->setJobDescriptionPicture($desc_picture);
                $job->setJobChiefName($chief);
                $job->setJobDateCreated($formattedDateCreated);
                $job->setJobDateStarted($formattedDateStarted);
                $job->setJobPlaces($selectedLocations);
                $job->setJobQualifications($selectedQualifications);
                $job->setJobResponsabilities($selectedResponsabilities);

                $jobRepository = new JobRepository();
                $jobRepository->addJob($job);

                $_SESSION['success-message'] = "Votre offre d'emploie a bien été ajouté !";
                header('location: index.php?admin&action=AdminEmplois');
                exit();

            } catch (Exception $e) {

                $_SESSION['error-message'] = $e->getMessage();
                header('location: index.php?admin&action=AdminAjoutEmploi');
                exit();
            }

        } else {
            $_SESSION['error-message'] = "Aucun champs ne doit être vide !";
            header('location: index.php?admin&action=AdminAjoutEmploi');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Veillez à remplir tout les champs !";
        header('location: index.php?admin&action=AdminAjoutEmploi');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: index.php?admin&action=AdminAjoutEmploi');
    exit();
}