<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords"
        content="association, précarité, vulnérabilité, isolement, Reims, entraide, solidarité, hébergement, asile, médico-social, logement adapté" />
    <meta name="description"
        content="Le site de l'association 'Jamais Seul à Reims'. Notre association s'engage à fournir des solutions concrètes pour aider les personnes en situation de précarité, de vulnérabilité ou d'isolement dans la ville de Reims. Découvrez nos activités et projets visant à créer un environnement d'entraide et de solidarité, ainsi que nos services d'hébergement, d'asile et de médico-social et logement adapté." />
    <meta name="author" content="Jamais Seul à Reims" />
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

        <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="assets/img/02.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title-name">
                            <h1>Réinitialisation</h1>
                            <p>Jamais Seul ... </p>
                        </div>
                        <ul class="page-breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a> <i
                                    class="fa fa-angle-double-right"></i></li>
                            <li><a href="index.php?action=Connexion">Réinitialisation</a> <i
                                    class="fa fa-angle-double-right"></i></li>
                            <li><span>Mot de passe</span> </li>
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
                            <h2 class="title-effect">Récupération du mot de passe</h2>
                            <p>Vous pouvez définir votre nouveau mot de passe</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <form action="index.php?reset&action=TraitementReinitialisationMdp" method="POST">
                            <input type="hidden" name="user_id" value="<?= $userId['id_user']; ?>">
                            <input type="hidden" name="token" value="<?= $token; ?>">
                            <div class="form-group">
                                <label for="newpassword">Nouveau mot de passe:</label>
                                <input type="password" class="form-control" name="newpassword" id="newpassword"
                                    placeholder="Votre nouveau mot de passe">
                                <br>
                                <input type="password" class="form-control" name="newrepassword" id="newrepassword"
                                    placeholder="Re-tapez votre nouveau mot de passe">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Sauvegarder" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!--=================================
 Blog-->



    <!--=================================
action box- -->

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

</body>

</html>