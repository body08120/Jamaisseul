<?php
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {

    header('Location: index.php');
}


require_once('src/php/token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: index.php');
    exit; // Arrêter le script ou effectuer une autre action
}


require_once('class/Post.php');
$postRepository = new PostRepository();

$page = isset($_GET['page']) ? $_GET['page'] : 1; // Récupère le numéro de page depuis la requête GET
$perPage = 10; // Nombre d'articles par page

$offset = ($page - 1) * $perPage; // Calcul de l'offset en fonction du numéro de page

$posts = $postRepository->findAllPosts($perPage, $offset); // Appel à la méthode findAllPosts() en passant les paramètres de pagination



// Afficher les liens de pagination
$totalPosts = $postRepository->getTotalPostsCount(); // Méthode pour obtenir le nombre total d'articles dans la base de données

$totalPages = ceil($totalPosts / $perPage); // Calcul du nombre total de pages

// Afficher les liens de pagination
// for ($i = 1; $i <= $totalPages; $i++) {
//     echo "<a href='?page=$i'>$i</a> ";
// }

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

    <!-- CRUD -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/posts.css" />

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
                            <li><span>Articles</span></li><br>
                            <!-- SE DECONNECTER -->
                            <li>
                                <!-- on écoute le clic sur le lien, on empêche le comportement par défaut du lien, on recherche le formulaire qu'on fait envoyer avec le token à l'intérieur -->
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>

                                <!-- formulaire avec le token qui attend d'être soumis par le javascript grâce au clic sur le lien-->
                                <form id="logout-form" action="index.php?action=TraitementDeconnexion" method="POST"
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

        <!--=================================
  CRUD-->

        <section class="white-bg">
            <div class="container">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h2>Gestions des <b> articles </b></h2>

                                </div>
                                <div class="col-xs-6">
                                    <a href="#deleteMutipleModal" class="deleteButton btn btn-danger"
                                        data-toggle="modal" data-operation="delete_posts">
                                        <i class="material-icons">&#xE15C;</i>
                                        <span>Supprimer</span>
                                    </a>
                                    <a href="index.php?admin&action=AdminAjoutActualite" class="btn btn-success"
                                        data-toggle="modal"><i class="material-icons">&#xE147;</i>
                                        <span>Ajouter</span></a>
                                </div>
                            </div>
                        </div>

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

                        <table class="table table-striped table-hover">
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
                                <?php foreach ($posts as $post): ?>
                                    <tr>
                                        <td>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" id="checkbox<?= $post->getId(); ?>" name="options[]"
                                                    value="1" data-id="<?= $post->getId(); ?>" />
                                                <label for="checkbox<?= $post->getId(); ?>"></label>
                                            </span>
                                        </td>

                                        <td>
                                            <?= (strlen($post->getTitle()) > 20) ? substr($post->getTitle(), 0, 20) . '...' : $post->getTitle(); ?>
                                        </td>


                                        <td class="text-nowrap">Date:
                                            <?= date_format(new DateTime($post->getDate()), 'Y-m-d'); ?>
                                        </td>

                                        <td>
                                            <img src="<?= $post->getPicture(); ?>" alt="<?= $post->getDescPicture(); ?>"
                                                width="180px">
                                        </td>

                                        <td class="text-nowrap">

                                            <a href="#editModal" class="updateButton" data-toggle="modal"
                                                data-id="<?= $post->getId(); ?>">

                                                <i class=" material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>

                                            <a href="#deleteModal" class="deleteSingleButton" data-toggle="modal"
                                                data-operation="delete_post" data-id="<?= $post->getId(); ?>">

                                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="hint-text">
                                <b>
                                    <?php echo $page; ?>
                                </b> sur <b>
                                    <?php echo $totalPages; ?>
                                </b> pages
                            </div>

                            <ul class="pagination">
                                <?php if ($page > 1): ?>
                                    <li class="page-item"><a href="admin/posts.php?page=<?= ($page - 1) ?>"
                                            class="page-link">Précédent</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item<?= ($page == $i) ? ' active' : '' ?>"><a
                                            href="admin/posts.php?page=<?= $i ?>" class="page-link"><?= $i ?></a></li>
                                <?php endfor; ?>

                                <?php if ($page < $totalPages): ?>
                                    <li class="page-item"><a href="admin/posts.php?page=<?= ($page + 1) ?>"
                                            class="page-link">Suivant</a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal HTML -->
            <div id="editModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <form action="index.php?admin&action=AdminEditActualite" method="POST">
                            <div class="modal-header">
                                <h4 class="modal-title">Éditer un article</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>

                            <div class="modal-body">

                                <p class="msg bg-warning text-truncate text-white">Souhaitez-vous modifiez l'article
                                    suivant ?</p>
                                <div class="form-group">
                                    <label>Titre:</label>
                                    <p id="update_title_post"></p>
                                </div>

                                <input type="hidden" name="update_id_post" id="update_id_post" />
                            </div>

                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Non">
                                <input type="submit" class="btn btn-info" value="Oui">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Modal HTML -->
            <div id="deleteModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="index.php?admin&action=TraitementSuppressionActualite" method="POST">
                            <div class="modal-header">
                                <h4 class="modal-title">Supprimer un article</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sur de vouloir supprimer <span id="selectedCount"></span> article(s) ?</p>

                                <p class="text-warning"><small>Cette action est définitive.</small></p>
                                <input type="hidden" id="deletePostId" name="deletePostId" value="">
                                <!-- <input type="hidden" id="deletePostIds" name="deletePostIds" value=""> -->
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Retour">
                                <input type="submit" class="btn btn-danger" id="confirmDeleteButton" value="Supprimer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Multip delete post -->
            <div id="deleteMutipleModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="index.php?admin&action=TraitementSuppressionActualites" method="POST">
                            <div class="modal-header">
                                <h4 class="modal-title">Supprimer un article</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sur de vouloir supprimer <span id="selectedCount"></span> article(s) ?</p>

                                <p class="text-warning"><small>Cette action est définitive.</small></p>
                                <!-- <input type="hidden" id="deletePostId" name="deletePostId" value=""> -->
                                <input type="hidden" id="deletePostIds" name="deletePostIds" value="">
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Retour">
                                <input type="submit" class="btn btn-danger" id="confirmDeleteButton" value="Supprimer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!--=================================
  CRUD-->



        <?php include('src/include/footer.php'); ?>
    </div>

    <div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>



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
                    var postId = this.getAttribute("data-id");
                    console.log(postId);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "index.php?admin&action=TraitementChercheActualite");
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var articleData = JSON.parse(xhr.responseText);

                            console.log(articleData);

                            // Utilisez les méthodes pour accéder aux valeurs des propriétés
                            var idPost = postId;
                            var titlePost = articleData.title_post;

                            // Utilisez les données de l'article pour afficher les valeurs dans la modal
                            document.getElementById("update_id_post").value = idPost;
                            document.getElementById("update_title_post").textContent = titlePost;

                        } else {
                            console.error("Aucun article n'a été trouvé:", xhr.statusText);
                        }
                    };

                    xhr.onerror = function () {
                        console.error("Requête échouée.");
                    };

                    var params = "id=" + postId;
                    xhr.send(params);
                });
            });

            //________________________________________________________________


            // Delete single button click handler
            var deleteSingleButtons = document.getElementsByClassName("deleteSingleButton");
            Array.from(deleteSingleButtons).forEach(function (button) {
                button.addEventListener("click", function () {
                    var postId = this.getAttribute("data-id");
                    console.log(postId);
                    document.getElementById("deletePostId").value = postId;
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
                    var checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]:checked');
                    var selectedIds = Array.from(checkboxes).map(function (checkbox) {
                        return checkbox.getAttribute("data-id");
                    });
                    // Compter le nombre d'articles sélectionnés
                    var selectedCount = 0;
                    checkboxes.forEach(function (checkbox) {
                        if (checkbox.checked) {
                            selectedCount++;
                        }
                    });

                    // Afficher le nombre d'articles sélectionnés
                    var selectedCountElement = document.getElementById("selectedCount");
                    selectedCountElement.innerText = selectedCount.toString();

                    console.log(selectedIds);
                    document.getElementById("deletePostIds").value = selectedIds.join("-");
                });
            });
            //________________________________________________________________
        });
    </script>


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