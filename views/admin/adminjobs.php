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

    <!-- DataTables -->
    <link href="assets/DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


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
                            <li><a href="index.php?admin&action="><i class="fa fa-home"></i> Administration</a> <i
                                    class="fa fa-angle-double-right"></i></li>
                            <li><a href="index.php?admin&action=AdminEmplois"><i class="fa fa-home"></i>Offres
                                    d'emplois</a> <i class="fa fa-angle-double-right"></i>
                            </li>
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
                    <div class="col">
                        <div class="section-title">
                            <h2 class="title-effect">Gestion des <b>offres d'emplois</b></h2>
                            <p class="text-nowrap">Vous retrouvez ici tous les outils pour la gestion des offres
                                d'emplois</p>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-end align-items-center gap-3">
                        <a href="#deleteMutipleModal" class="deleteButton btn btn-danger" data-bs-toggle="modal"
                            data-operation="delete_jobs">
                            <span>Supprimer</span>
                        </a>

                        <a href="index.php?admin&action=AdminAjoutEmploi" class="btn btn-primary">
                            <span>Ajouter</span>
                        </a>
                    </div>
                </div>



                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($jobs as $job): ?>

                            <tr>
                                <!-- checkbox -->
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox<?= $job->getJobId(); ?>" name="options[]"
                                            value="1" data-id="<?= $job->getJobId(); ?>" />
                                        <label for="checkbox<?= $job->getJobId(); ?>"></label>
                                    </span>
                                </td>

                                <!-- title job -->
                                <td>
                                    <?= (strlen($job->getJobTitle()) > 20) ? substr($job->getJobTitle(), 0, 20) . '...' : $job->getJobTitle(); ?>
                                </td>

                                <!-- date start -->
                                <td>
                                    <?= date_format(new DateTime($job->getJobDateCreated()), 'Y-m-d'); ?>
                                </td>

                                <!-- thumbnail job -->
                                <td>
                                    <img src="<?= $job->getJobPicture(); ?>" alt="<?= $job->getJobDescriptionPicture(); ?>"
                                        width="180px">
                                </td>

                                <!-- action job -->
                                <td>
                                    <a href="#editModal" class="updateButton" data-bs-toggle="modal"
                                        data-id="<?= $job->getJobId(); ?>" data-title="<?= $job->getJobTitle(); ?>">
                                        <i class=" material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>

                                    <a href="#deleteModal" class="deleteSingleButton" data-bs-toggle="modal"
                                        data-id="<?= $job->getJobId(); ?>" data-operation="delete_job"
                                        data-title="<?= $job->getJobTitle(); ?>">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>

            <!-- Edit Modal HTML -->
            <div id="editModal" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Éditer un article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="index.php?admin&action=AdminEditionEmploi" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <p class="msg text-truncate">Souhaitez-vous modifiez cette article :</p>

                                    <b><span id="updateJobTitle"></span></b>
                                </div>
                            </div>

                            <input type="hidden" name="updateJobId" id="updateJobId" />

                            <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Retour">
                                <input type="submit" class="btn btn-primary" value="Éditer">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Delete Modal HTML -->
            <div id="deleteModal" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer un article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="index.php?admin&action=TraitementSuppression" method="POST">
                            <div class="modal-body">
                                <p>Êtes-vous sur de vouloir supprimer <span id="selectedCount"></span> article(s) ?</p>

                               <b><span id="deleteJobTitle"></span> <br></b>

                                <p class="text-warning"><small><b>Cette action est définitive.</b></small></p>
                            </div>

                            <input type="hidden" id="deleteJobId" name="deleteJobId" value="">

                            <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Retour">
                                <input type="submit" class="btn btn-danger" id="confirmDeleteButton" value="Supprimer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Multiple delete modal -->
            <div id="deleteMutipleModal" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer plusieurs articles</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="index.php?admin&action=TraitementSuppressionActualites" method="POST">
                            <div class="modal-body">
                                <p>Êtes-vous sur de vouloir supprimer <span id="selectedCounts"></span> article(s) ?</p>
                                <p class="text-warning"><small><b>Cette action est définitive.</b></small></p>
                            </div>

                            <input type="hidden" id="deleteJobIds" name="deleteJobIds" value="">

                            <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Retour">
                                <input type="submit" class="btn btn-danger" id="confirmDeleteButton" value="Supprimer">
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Activate tooltip
            var tooltips = document.querySelectorAll('[data-toggle="tooltip"]');
            tooltips.forEach(function (tooltip) {
                tooltip.addEventListener("mouseover", function () {
                    // Show tooltip
                });
                tooltip.addEventListener("mouseout", function () {
                    // Hide tooltip
                });
            });
            });
            //________________________________________________________________


            // Select/Deselect checkboxes
            var selectAll = document.getElementById("selectAll");
            var checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]');
            selectAll.addEventListener("click", function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAll.checked;
                });
            });
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener("click", function () {
                    if (!this.checked) {
                        selectAll.checked = false;
                    }
                });
            });
            //________________________________________________________________


            // Update button click handler
            var updateButton = document.getElementsByClassName("updateButton");
            Array.from(updateButton).forEach(function (button) {
                button.addEventListener("click", function () {
                    var jobId = this.getAttribute("data-id");
                    var jobTitle = this.getAttribute("data-title");
                    console.log(jobId);
                    console.log(jobTitle);

                    // Utilisez les données de l'article pour afficher les valeurs dans la modal
                    document.getElementById("updateJobId").value = jobId;
                    document.getElementById("updateJobTitle").textContent = jobTitle;
                });

                //________________________________________________________________


                // Delete single button click handler
                var deleteSingleButtons = document.getElementsByClassName("deleteSingleButton");
                Array.from(deleteSingleButtons).forEach(function (button) {
                    button.addEventListener("click", function () {
                        var jobId = this.getAttribute("data-id");
                        var jobTitle = this.getAttribute("data-title");
                        console.log(jobId);
                        console.log(jobTitle);

                        document.getElementById("deleteJobId").value = jobId;
                        document.getElementById("deleteJobTitle").textContent = jobTitle;
                    });

                    var selectedCount = 1;

                    // Afficher le nombre d'articles sélectionnés
                    var selectedCountElement = document.getElementById("selectedCount");
                    selectedCountElement.innerText = selectedCount.toString();
                });
                //________________________________________________________________


                // Delete button click handler
                var deleteButtons = document.getElementsByClassName("deleteButton");
                Array.from(deleteButtons).forEach(function (button) {
                    button.addEventListener("click", function () {
                        var checkboxes = document.querySelectorAll('table tbody tr td input[type="checkbox"]:checked');
                        var selectedIds = Array.from(checkboxes).map(function (checkbox) {
                            return checkbox.getAttribute("data-id");
                        });
                        // Compter le nombre d'articles sélectionnés
                        var selectedCounts = 0;
                        checkboxes.forEach(function (checkbox) {
                            if (checkbox.checked) {
                                selectedCounts++;
                            }
                        });

                        // Afficher le nombre d'articles sélectionnés
                        var selectedCountsElement = document.getElementById("selectedCounts");
                        selectedCountsElement.innerText = selectedCounts.toString();

                        console.log(selectedIds);
                        document.getElementById("deleteJobIds").value = selectedIds.join("-");
                    });
                });
                //________________________________________________________________
            });
    </script>

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


    <!-- DataTables -->
    <script src="assets/DataTables/datatables.min.js"></script>
    <script>
            var table = new DataTable('#myTable', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/fr-FR.json',
                },
            });
    </script>


</body>

</html>