<?php
var_dump($_POST);
// SI L'IMAGE N'A PAS ÉTÉ CHANGÉE //
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['update_picture_job']['name'] == '') {

    if (isset($_POST['update_id_job']) && isset($_POST['update_title_job']) && isset($_POST['update_desc_job']) && isset($_POST['update_chief_job']) && isset($_POST['update_date_job_created']) && isset($_POST['update_date_job_started']) && isset($_POST['selectedLocations']) && isset($_POST['selectedQualifications']) && isset($_POST['selectedResponsabilities'])) {

        if ($_POST['update_id_job'] !== '' && $_POST['update_title_job'] !== '' && $_POST['update_desc_job'] !== '' && $_POST['update_chief_job'] !== '' && $_POST['update_date_job_created'] !== '' && $_POST['update_date_job_started'] !== '' && $_POST['selectedLocations'] !== '' && $_POST['selectedQualifications'] !== '' && $_POST['selectedResponsabilities'] !== '') {

            // Stockage et filtrage
            $jobId = $_POST['update_id_job'];
            $title = htmlspecialchars(strip_tags(trim($_POST['update_title_job'])));
            $desc = htmlspecialchars(strip_tags(trim($_POST['update_desc_job'])));
            $chief = htmlspecialchars(strip_tags(trim($_POST['update_chief_job'])));
            $selectedLocations = $_POST['selectedLocations'];
            $selectedQualifications = $_POST['selectedQualifications'];
            $selectedResponsabilities = $_POST['selectedResponsabilities'];

            // Dates
            $dateCreated = htmlspecialchars(strip_tags(trim($_POST['update_date_job_created'])));
            $dateStarted = htmlspecialchars(strip_tags(trim($_POST['update_date_job_started'])));
            // Convertir les dates en objets DateTime
            $dateCreatedObj = DateTime::createFromFormat('Y-m-d\TH:i', $dateCreated);
            $dateStartedObj = DateTime::createFromFormat('Y-m-d\TH:i', $dateStarted);
            // Vérifier si les dates sont valides
            if (!$dateCreatedObj || !$dateStartedObj) {
                $_SESSION['error-message'] = "Les dates fournies ne sont pas valides !";
                header('location: index.php?admin&action=AdminEditEmploi');
                exit();
            }
            // Vérifier si la date de début est postérieure ou égale à la date de création
            if ($dateStartedObj < $dateCreatedObj) {
                $_SESSION['error-message'] = "La date de début doit être postérieure ou égale à la date de création !";
                header('location: index.php?admin&action=AdminEditEmploi');
                exit();
            }
            // Formater les dates dans le format DATETIME
            $formattedDateCreated = $dateCreatedObj ? $dateCreatedObj->format('Y-m-d H:i:s') : null;
            $formattedDateStarted = $dateStartedObj ? $dateStartedObj->format('Y-m-d H:i:s') : null;

            try {
                // Instancier un objet Job et définir ses propriétés
                $job = new Job();
                $job->setJobId($jobId);
                $job->setJobTitle($title);
                $job->setJobDescription($desc);
                $job->setJobChiefName($chief);
                $job->setJobDateCreated($formattedDateCreated);
                $job->setJobDateStarted($formattedDateStarted);
                $job->setJobPlaces($selectedLocations);
                $job->setJobQualifications($selectedQualifications);
                $job->setJobResponsabilities($selectedResponsabilities);

                // Update en db
                $jobRepository = new JobRepository();
                $jobRepository->updateJob($job);
                // var_dump($job);
                // die;

                $_SESSION['success-message'] = "L'offre d'emploie à bien été modifier !";
                header('location: index.php?admin&action=AdminEmplois');
                exit();

            } catch (Exception $e) {

                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: index.php?admin&action=AdminEmplois');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
        header('location: index.php?admin&action=AdminEmplois');
        exit();
    }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['']['name'] !== '') {


    if (isset($_POST['']) && isset($_POST[''])) {

        if ($_POST[''] !== '' && $_POST[''] !== '') {

            try {

                // On va chercher le lien de l'image
                $postRepository = new PostRepository();
                $image = 1;
                $imagePath = 1;

                // On prépare l'url du fichier à supprimer
                $basePath = '/'; // Remplacez cette valeur par le chemin absolu de votre projet
                $path = $imagePath;

                // $path = $_SERVER['DOCUMENT_ROOT'] . '/localhost/' . $imagePath;

                // On tente de supprimer le fichier et quittons le script si il n'est pas supprimer et stockons une erreur en session
                if (!unlink($path)) {

                    $_SESSION['error-message'] = "Modification échouée, l'image n'a pas été supprimée : $path";
                    header('location: index.php?admin&action=AdminEmplois');
                    exit;

                } else {

                    $nameFile = $_FILES['']['name'];
                    $typeFile = $_FILES['']['type'];
                    $tmpFile = $_FILES['']['tmp_name'];
                    $errorFile = $_FILES['']['error'];
                    $sizeFile = $_FILES['']['size'];

                    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
                    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

                    $extension = explode('.', $nameFile);

                    $max_size = 500000;


                    if (in_array($typeFile, $type)) {
                        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                            if ($sizeFile <= $max_size && $errorFile == 0) {
                                if (move_uploaded_file($tmpFile, $image = 'upload/' . uniqid() . '.' . end($extension))) {

                                    // Instancier un objet Post et définir ses propriétés

                                    // On supprime et réinserre les valeurs

                                    $_SESSION['success-message'] = "Votre offre d'emploie a bien été modifié !";
                                    header('location: index.php?admin&action=AdminEmplois');
                                    exit();

                                    // echo "Upload effectué !";
                                } else {
                                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                                    header('location: index.php?admin&action=AdminEmplois');
                                    exit();
                                }
                            } else {
                                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                                header('location: index.php?admin&action=AdminEmplois');
                                exit();
                            }
                        } else {
                            $_SESSION['error-message'] = "Merci d'uploader une image !";
                            header('location: index.php?admin&action=AdminEmplois');
                            exit();
                        }
                    } else {
                        $_SESSION['error-message'] = "Type non autorisé !";
                        header('location: index.php?admin&action=AdminEmplois');
                        exit();
                    }

                }

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: index.php?admin&action=AdminEmplois');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis ! 2";
        header('location: index.php?admin&action=AdminEmplois');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: index.php?admin&action=AdminEmplois');
    exit();
}
?>