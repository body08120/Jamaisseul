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

<body data-editor="ClassicEditor" data-collaboration="false" data-revision-history="false">

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
                            <li><a href="index.php?admin&action="><i class="fa fa-home"></i> Administration</a> <i
                                    class="fa fa-angle-double-right"></i></li>
                            <li><a href="index.php?admin&action=AdminAuteurs"><i class="fa fa-home"></i>Gestions des
                                    auteurs</a> <i class="fa fa-angle-double-right"></i>
                            </li>
                            <li><span>Ajout</span> </li>
                            <br><br>
                            <?php if (isset($_SESSION['username'])) { ?>
                                <li>
                                    <a href="index.php?action=TraitementDeconnexion" class="btn btn-danger">Déconnexion</a>
                                </li>
                            <?php } else {
                            } ?><br>
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
                            <h2 class="title-effect">Ajouter un auteur</h2>
                            <p>Vous pouvez ajouter un auteur depuis le formulaire ci-dessous.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="centered">
                    <div class="editor-container">

                        <form action="index.php?admin&action=TraitementAjoutAuteur" method="POST"
                            enctype="multipart/form-data">

                            <div class="form-body">

                                <!-- // Name // -->
                                <div class="form-group">
                                    <label for="name_author">Nom et prénom:</label>
                                    <input type="text" name="name_author" id="name_author" class="form-control"
                                        required>
                                </div>

                                <br />

                                <!-- // DESCRIPTION // -->
                                <div class="form-group">
                                    <label for="desc_author">Description:</label>
                                    <textarea class="form-control" name="desc_author" id="desc_author" rows="3"
                                        required></textarea>
                                </div>

                                <br />

                                <!-- // PICTURE & CHIEF // -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="picture_author">Image:</label>
                                        <input type="file" name="picture_author" id="picture_author"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <br />

                                <div class="form-group row">
                                    <div class="col">
                                        <label for="facebook">Facebook:</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="twitter">Twitter:</label>
                                        <input type="text" name="twitter" id="twitter" class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="pinterest">Pinterest:</label>
                                        <input type="text" name="pinterest" id="pinterest" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <br />

                            </div>

                            <br />

                            <div class="form-footer">
                                <a href="index.php?admin&action=AdminAuteurs" class="btn btn-default">Retour</a>
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Valider">
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </section>

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