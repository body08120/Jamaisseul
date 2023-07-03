<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: ../');
}
require_once('../class/User.php');

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
    <base href="http://localhost/jamaisseul/">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="css/plugins-css.css" />

    <!-- Typography -->
    <link rel="stylesheet" type="text/css" href="css/typography.css" />

    <!-- Shortcodes -->
    <link rel="stylesheet" type="text/css" href="css/shortcodes/shortcodes.css" />

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />

    <!-- Slider -->
    <link rel="stylesheet" type="text/css" href="css/slider.css" />

</head>

<body data-editor="ClassicEditor" data-collaboration="false" data-revision-history="false">

    <div class="wrapper">

        <!--=================================
 preloader -->

        <?php include('../include/header.php'); ?>
        <!--=================================
 header -->


        <!--=================================
page-title-->

        <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6">
            <div class="head-slider"><img src="img/02.jpg" alt=""></div>
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
                            <li><span>Compte</span> </li>
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
                            <h2 class="title-effect">Ajouter un article</h2>
                            <p>Vous pouvez ajouter un article depuis le formulaire ci-dessous.
                                <br>
                                <span class="bg-warning">Les images doivent être copier/coller depuis un support en
                                    ligne. </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="centered">
                    <div class="editor-container">
                        <form action="" method="post">
                            <textarea name="content" class="editor"></textarea>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Enregistrer" />
                        </form>
                    </div>
                </div>

                <?php var_dump($_POST); ?>

            </div>
        </section>






        <!--================================-->

        <?php include('../include/footer.php'); ?>
    </div>

    <div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>

    <!--=================================
 jquery -->

    <!-- jquery -->
    <script src="js/jquery-3.6.0.min.js"></script>

    <!-- plugins-jquery -->
    <script src="js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>var plugin_path = 'js/';</script>

    <!-- custom -->
    <script src="js/custom.js"></script>

    <!-- slider -->
    <script src="js/slider.js"></script>

    <!-- ckeditor -->
    <script src="build/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector(".editor"), {
            licenseKey: "",
        })
            .then((editor) => {
                window.editor = editor;
            })
            .catch((error) => {
                console.error("Oops, something went wrong!");
                console.error(
                    "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:"
                );
                console.warn("Build id: ajbu9bmapby0-unt8fr6ckh47");
                console.error(error);
            });
    </script>

</body>

</html>