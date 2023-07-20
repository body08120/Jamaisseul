<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: ../../');
}

require_once('../token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: ../index.php');
    exit; // Arrêter le script ou effectuer une autre action
}

$upload_dir = array(
    'img' => '/Jamaisseul/assets/img/',
);

$imgset = array(
    'maxsize' => 500000,
    'maxwidth' => 1600,
    'maxheight' => 1200,
    'minwidth' => 10,
    'minheight' => 10,
    'type' => array('bmp', 'gif', 'jpg', 'jpeg', 'png'),
);

// Vérifier si le fichier a été téléchargé avec succès
if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
    define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));

    // Vérifier le type de fichier
    $sepext = explode('.', strtolower($_FILES['upload']['name']));
    $type = end($sepext); // Obtenir l'extension du fichier
    $upload_dir = in_array($type, $imgset['type']) ? $upload_dir['img'] : $upload_dir['img'];
    $upload_dir = trim($upload_dir, '/') . '/';

    // Vérifier les dimensions et la taille de l'image
    if (in_array($type, $imgset['type'])) {
        list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);

        if (isset($width) && isset($height)) {
            if ($width > $imgset['maxwidth'] || $height > $imgset['maxheight']) {
                $re = 'La largeur x hauteur de l\'image doit être inférieure ou égale à ' . $imgset['maxwidth'] . ' x ' . $imgset['maxheight'];
                echo json_encode(array('error' => array('message' => $re)));
                exit();
            }

            if ($width < $imgset['minwidth'] || $height < $imgset['minheight']) {
                $re = 'La largeur x hauteur de l\'image doit être supérieure ou égale à ' . $imgset['minwidth'] . ' x ' . $imgset['minheight'];
                echo json_encode(array('error' => array('message' => $re)));
                exit();
            }

            if ($_FILES['upload']['size'] > $imgset['maxsize'] * 1000) {
                $re = 'La taille du fichier doit être inférieure ou égale à ' . $imgset['maxsize'] . ' KB';
                echo json_encode(array('error' => array('message' => $re)));
                exit();
            }
        }
    } else {
        $re = 'Le fichier téléchargé n\'a pas la bonne extension';
        echo json_encode(array('success' => false, array('message' => $re)));
        exit();
    }

    // Générer un nom de fichier unique
    function setFName($p, $fn, $ex, $i)
    {
        if (file_exists($p . $fn . $ex)) {
            return setFName($p, F_NAME . '_' . ($i + 1), $ex, ($i + 1));
        } else {
            return $fn . $ex;
        }
    }
    $f_name = setFName($_SERVER['DOCUMENT_ROOT'] . '/' . $upload_dir, F_NAME, ".$type", 0);
    $uploadpath = $_SERVER['DOCUMENT_ROOT'] . '/' . $upload_dir . $f_name;

    // Déplacer le fichier téléchargé vers le répertoire de destination
    if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
        $image_url = $_SERVER['HTTP_ORIGIN'] . '/' . $upload_dir . $f_name;
        echo json_encode(array('success' => true, 'url' => $image_url));
        exit();
    } else {
        $re = 'Impossible de télécharger le fichier';
        echo json_encode(array('success' => false, array('message' => $re)));
        exit();
    }
}

// Aucun fichier téléchargé ou une erreur s'est produite
$re = 'Aucun fichier téléchargé ou une erreur s\'est produite';
echo json_encode(array('error' => array('message' => $re)));
exit();
?>
