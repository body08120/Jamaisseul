<?php
// Cette fonction d'autoloader va lire tous les fichiers .php du répertoire /class et les monter en mémoire
function autoloader($className) {
    $classFile = __DIR__ . '/../src/models/' . $className . '.php';
    if (file_exists($classFile)) {
        require_once($classFile);
    }
}

// On exécute cette fonction via la fonction native PHP disponible
spl_autoload_register('autoloader');

?>