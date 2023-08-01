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
                            <li><a href="index.php?admin&action=AdminEmplois"><i class="fa fa-home"></i>Offres
                                    d'emplois</a> <i class="fa fa-angle-double-right"></i>
                            </li>
                            <li><span>Ajout</span> </li>
                            <br><br>
                            <?php if (isset($_SESSION['username'])) { ?>
                                <li>
                                    <a href="index.php?action=TraitementDeconnexion">Déconnexion</a>
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
                            <h2 class="title-effect">Ajouter une offre d'emploie</h2>
                            <p>Vous pouvez ajouter une offre depuis le formulaire ci-dessous.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="centered">
                    <div class="editor-container">

                        <form action="index.php?admin&action=" method="POST" enctype="multipart/form-data">

                            <div class="form-body">

                                <!-- // TITLE // -->
                                <div class="form-group">
                                    <label for="title_job">Titre:</label>
                                    <input type="text" name="title_job" id="title_job" class="form-control" required>
                                </div>

                                <br />

                                <!-- // DESCRIPTION // -->
                                <div class="form-group">
                                    <label for="desc_job">Description:</label>
                                    <textarea class="form-control" name="desc_job" id="desc_job" rows="3"
                                        required></textarea>
                                </div>

                                <br />

                                <!-- // PICTURE & CHIEF // -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="picture_job">Image:</label>
                                        <!-- desc_pictur_job est égale à name file -->
                                        <input type="file" name="picture_job" id="picture_job" class="form-control"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="chief_job">Nom du chef:</label>
                                        <input type="text" name="chief_job" id="chief_job" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <br />

                                <!-- // DATE // -->
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="date_job_created">Date de début:</label>
                                        <input type="date" name="date_job_created" id="date_job_created"
                                            class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="date_job_started">Date de lancement:</label>
                                        <input type="date" name="date_job_started" id="date_job_started"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <br />

                                <!-- // LOCATIONS // -->
                                <div class="form-group">
                                    <label for="locationsSelect">Lieux:</label>
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded"
                                            placeholder="Tapez le nom d'une ville" aria-label="Search"
                                            aria-describedby="search-addon" id="locationsSearch" />
                                        <!-- <button type="button" class="btn btn-outline-primary">Rechercher</button> -->
                                    </div>

                                    <select multiple class="form-control overflow-auto" name="locations[]"
                                        id="locationsSelect">
                                    </select>

                                    <br />

                                    <button type="button" class="btn btn-success"
                                        onclick="addSelectedLocations()">Valider les lieux sélectionnés</button>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label>Lieux sélectionnés:</label>
                                    <br />
                                    <div id="selectedLocationsList">
                                    </div>
                                    <br />
                                </div>

                                <br />

                                <!-- // QUALIFICATIONS // -->
                                <div class="form-group">
                                    <label for="qualificationsSelect">Qualifications:</label>
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded"
                                            placeholder="Vérifier l'existence d'une qualifcation" aria-label="Search"
                                            aria-describedby="search-addon" id="qualificationsSearch" />
                                        <!-- <button type="button" class="btn btn-outline-primary">Rechercher</button> -->
                                    </div>

                                    <select multiple class="form-control overflow-auto" name="qualifications[]"
                                        id="qualificationsSelect">
                                        <?php foreach ($qualifications as $qualification): ?>
                                            <option value="<?= $qualification->getQualificationsId(); ?>"><?= $qualification->getQualificationsName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <br />

                                    <button class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addQualificationModal">Ajouter une qualification</button>

                                    <button type="button" class="btn btn-success"
                                        onclick="addSelectedQualifications()">Valider les qualifications
                                        sélectionnés</button>


                                </div>
                                <br />
                                <!-- Élément pour afficher le message de réussite -->
                                <div id="success-message-qualifAdd" style="display: none; color: green;"></div>
                                <!-- Élément pour afficher le message d'erreur -->
                                <div id="error-message-qualifAdd" style="display: none; color: red;"></div>

                                <div class="form-group">
                                    <label>Qualifications sélectionnés:</label>
                                    <br />
                                    <div id="selectedQualificationsList">
                                    </div>
                                    <br />
                                </div>

                                <br />

                                <!-- // RESPONSABILITIES // -->
                                <div class="form-group">
                                    <label for="responsabilitiesSelect">Responsabilité:</label>
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded"
                                            placeholder="Vérifier l'existence d'une responsabilité" aria-label="Search"
                                            aria-describedby="search-addon" id="responsabilitiesSearch" />
                                        <!-- <button type="button" class="btn btn-outline-primary">Rechercher</button> -->
                                    </div>

                                    <select multiple class="form-control overflow-auto" name="responsabilities[]"
                                        id="responsabilitiesSelect">
                                        <?php foreach ($responsabilities as $responsabilitie): ?>
                                            <option value="<?= $responsabilitie->getResponsabilitieId(); ?>"><?= $responsabilitie->getResponsabilitieName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <br />

                                    <button class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addResponsabilitieModal">Ajouter une responsabilité</button>

                                    <button type="button" class="btn btn-success"
                                        onclick="addSelectedResponsabilities()">Valider les qualifications
                                        sélectionnés</button>


                                </div>
                                <br />
                                <!-- Élément pour afficher le message de réussite -->
                                <div id="success-message-respAdd" style="display: none; color: green;"></div>
                                <!-- Élément pour afficher le message d'erreur -->
                                <div id="error-message-respAdd" style="display: none; color: red;"></div>

                                <div class="form-group">
                                    <label>Responsabilités sélectionnés:</label>
                                    <br />
                                    <div id="selectedResponsabilitiesList">
                                    </div>
                                    <br />
                                </div>

                            </div>

                            <br />

                            <div class="form-footer">
                                <a href="index.php?admin&action=AdminEmplois" class="btn btn-default">Retour</a>
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

    <!-- // MODAL FOR ADD QUALIFICATION // -->
    <div id="addQualificationModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une qualifcation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="addQualificationForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addQualificationName">Qualification :</label>
                            <input type="text" name="addQualificationName" id="addQualificationName"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Retour">
                        <input type="submit" name="submitQualif" id="submitQualif" class="btn btn-primary"
                            value="Ajouter">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- // MODAL FOR ADD RESPONSABILITIE // -->
    <div id="addResponsabilitieModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une responsabilité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="addResponsabilitieForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addResponsabilitieName">Responsabilité :</label>
                            <input type="text" name="addResponsabilitieName" id="addResponsabilitieName"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Retour">
                        <input type="submit" name="submitResp" id="submitResp" class="btn btn-primary" value="Ajouter">
                    </div>
                </form>

            </div>
        </div>
    </div>

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

    <!-- // PAPA PARSE // -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"
        integrity="sha512-dfX5uYVXzyU8+KHqj8bjo7UkOdg18PaOtpa48djpNbZHwExddghZ+ZmzWT06R5v6NSk3ZUfsH6FNEDepLx9hPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- // SEARCH AND READ LOCATION LIBS // -->
    <script src="assets/js/crud-job/papaparse.js"></script>

    <!-- // SEARCH BAR LOCATIONS // -->
    <script src="assets/js/crud-job/searchlocation.js"></script>
    <script src="assets/js/crud-job/searchqualifications.js"></script>
    <script src="assets/js/crud-job/searchresponsabilities.js"></script>

    <!-- // ADD / REMOVE LISTING // -->
    <script src="assets/js/crud-job/listlocation.js"></script>
    <script src="assets/js/crud-job/listqualifications.js"></script>
    <script src="assets/js/crud-job/listresponsabilities.js"></script>

    <!-- // SCRIPT FOR ADD QUALIFICATIONS AND RESPONSABILITIES // -->
    <script src="assets/js/crud-job/addqualification.js"></script>
    <script src="assets/js/crud-job/addresponsabilitie.js"></script>
</body>

</html>