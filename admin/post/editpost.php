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

require_once('../../class/Post.php');
$postId = $_GET['update_id_post'];

$postRepository = new PostRepository();
$post = $postRepository->findPostById($postId);

// var_dump($post);
// die();
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

    <style>
        .ck-content {
            padding: 1.5em !important;
        }
    </style>

</head>

<body data-editor="ClassicEditor" data-collaboration="false" data-revision-history="false">

    <div class="wrapper">

        <!--=================================
 preloader -->

        <?php include('../../include/header.php'); ?>
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
                            <li><a href="admin/posts.php"><span>Article</span></a><i
                                    class="fa fa-angle-double-right"></i> </li>
                            <li><span>Édition</span> </li>
                            <br>
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
                            <h2 class="title-effect">Éditer un article</h2>
                            <p>Vous pouvez éditer un article depuis le formulaire ci-dessous.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="centered">
                    <div class="editor-container">

                        <form action="admin/post/edit_post.php" method="POST" enctype="multipart/form-data">

                            <div class="form-body">

                                <div class="form-group">
                                    <label>Titre:</label>
                                    <input value="<?= $post->getTitle(); ?>" type="text" name="update_title_post"
                                        id="update_title_post" class="form-control" required>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label>Date:</label>
                                    <input value="<?= date('Y-m-d', strtotime($post->getDate())); ?>" type="date"
                                        name="update_date_post" id="update_date_post" class="form-control" required>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label>Miniature:</label>
                                    <!-- Affichage de l'image par défaut -->
                                    <div class="w-60">
                                        <img src="<?= $post->getPicture(); ?>" alt="Miniature par défaut" class="w-100">
                                    </div>

                                    <!-- Champ de fichier -->
                                    <input type="file" name="update_picture_post" id="update_picture_post"
                                        class="form-control">
                                </div>


                                <br />

                                <textarea name="update_content_post" id="update_content_post"
                                    class="editor"><?= $post->getContent(); ?></textarea>

                                <input type="hidden" name="update_id_post" value="<?= $postId; ?>">

                            </div>

                            <br />

                            <div class="form-footer">
                                <a href="admin/posts.php" class="btn btn-default">Retour</a>
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Valider">
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </section>






        <!--================================-->

        <?php include('../../include/footer.php'); ?>
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
            simpleUpload: {
                // The URL that the images are uploaded to.
                uploadUrl: "http://localhost/Jamaisseul/admin/post/upload.php",

                // Enable the XMLHttpRequest.withCredentials property.
                withCredentials: true,

                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    "X-CSRF-TOKEN": "CSRF-Token",
                    Authorization: "Bearer <JSON Web Token>",
                },
            },
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

        // Function to handle the file upload response and insert the image
        function handleUploadResponse(response) {
            const { success, fileUrl, message } = response;

            if (success) {
                const imageUrl = `${window.location.origin}/${fileUrl}`;
                const imageElement = window.editor.model.document.createElement(
                    "image",
                    {
                        src: imageUrl,
                        alt: "Image",
                        title: "Image",
                    }
                );

                window.editor.model.insertContent(imageElement);

                // Display a success message
                console.log("Image uploaded successfully.");
            } else {
                console.error(`Unable to upload the file: ${message}`);
            }
        }
    </script>
</body>

</html>