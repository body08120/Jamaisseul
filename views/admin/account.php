<?php
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {

    header('Location: ../');
}


require_once('src/php/token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: index.php');
    exit; // Arrêter le script ou effectuer une autre action
}

require_once('class/User.php');
$userRepository = new UserRepository();
$user = $userRepository->getUserByUserName($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webster - Responsive Multi-purpose HTML5 Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ASSOCIATION JAMAIS SEUL</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="assets/css/plugins-css.css" />

    <!-- Typography -->
    <link rel="stylesheet" type="text/css" href="assets/css/typography.css" />

    <!-- Shortcodes -->
    <link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css" />

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />

    <!-- Slider -->
    <link rel="stylesheet" type="text/css" href="assets/css/slider.css" />

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <?php include('src/include/header.php'); ?>
        <!--=================================
 header -->


        <!--=================================
page-title-->

        <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6">
            <div class="head-slider"><img src="assets/img/02.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title-name">
                            <h1>Administration</h1>
                            <p>Jamais Seul ... </p>
                        </div>
                        <ul class="page-breadcrumb">
                            <li><a href="admin/panel.php"><i class="fa fa-home"></i> Administration</a> <i
                                    class="fa fa-angle-double-right"></i></li>
                            <li><span>Compte</span> </li><br>
                            <!-- SE DECONNECTER -->
                            <li>
                                <!-- on écoute le clic sur le lien, on empêche le comportement par défaut du lien, on recherche le formulaire qu'on fait envoyer avec le token à l'intérieur -->
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>

                                <!-- formulaire avec le token qui attend d'être soumis par le javascript grâce au clic sur le lien-->
                                <form id="logout-form" action="admin/treatment_logout.php" method="POST"
                                    style="display: none;">
                                    <?php injectCSRFToken(); ?>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
page-title -->



        <!-- =======MESSAGE ALERT ================
             ========================================-->
        <?php
        echo isset($_SESSION['success-message']) ? '<p class="msg bg-success text-truncate text-white">' . $_SESSION['success-message'] . '</p>' : '';
        unset($_SESSION['success-message']);

        echo isset($_SESSION['error-message']) ? '<p class="msg bg-danger text-truncate text-white">' . $_SESSION['error-message'] . '</p>' : '';
        unset($_SESSION['error-message']);
        ?>

        <!-- =======MESSAGE ALERT ================
            =======================================-->


        <section class="page-section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="title-effect">Gérez votre compte</h2>
                            <p>Retrouvez ici les informations correspondante à votre compte.</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="w-70"><img src="<?= $user->getPicture(); ?>" alt="Image de profil"
                                    class="p-1 w-100" /></div>
                            <a href="#" class="p-1" data-bs-toggle="modal" data-bs-target="#userPictureModal"><i
                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h6>Nom d'utilisateur:</h6>
                                <i>
                                    <?= $user->getUsername(); ?>
                                </i>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#usernameModal"><i
                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                            </li>

                            <li class="list-group-item">
                                <h6>Adresse email:</h6>
                                <i>
                                    <?= $user->getEmail(); ?>
                                </i>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#emailModal"><i class="fa fa-pencil"
                                        aria-hidden="true"></i></a>
                            </li>

                            <li class="list-group-item">
                                <h6>Mot de passe:</h6>
                                <i>
                                    <?= $user->getPassword(); ?>
                                </i>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#passwordModal"><i
                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- UserPicture Modal -->
        <div class="modal fade" id="userPictureModal" tabindex="-1" aria-labelledby="userPictureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="userPictureModalLabel">Modification de l'utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="admin/account/treatment_userpicture.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="userPicture">Image de profil:</label>
                                <p class="text-warning">Cette image est afficher uniquement sur la gestion de votre
                                    compte.</p>
                                <input type="file" class="form-control" name="userPicture" id="userPicture">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                            <input type="submit" class="btn btn-primary" value="Sauvegarder" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- UserName Modal -->
        <div class="modal fade" id="usernameModal" tabindex="-1" aria-labelledby="usernameModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="usernameModalLabel">Modification de l'utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="admin/account/treatment_username.php" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="username">Pseudonyme:</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Votre nouveau pseudonyme.">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                            <input type="submit" class="btn btn-primary" value="Sauvegarder" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Email Modal -->
        <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="emailModalLabel">Modification de l'utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="admin/account/treatment_email.php" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Votre nouvel email.">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                            <input type="submit" class="btn btn-primary" value="Sauvegarder" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="passwordModalLabel">Modification de l'utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="admin/account/treatment_password.php" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="password">Mot de passe:</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Votre nouveau mot de passe">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                            <input type="submit" class="btn btn-primary" value="Sauvegarder" />
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!--================================-->

        <?php include('src/include/footer.php'); ?>
    </div>

    <div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>

    <!--=================================
 jquery -->

    <!-- jquery -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- plugins-jquery -->
    <script src="assets/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>var plugin_path = 'assets/js/';</script>

    <!-- custom -->
    <script src="assets/js/custom.js"></script>

    <!-- slider -->
    <script src="assets/js/slider.js"></script>

</body>

</html>