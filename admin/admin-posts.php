<?php
session_start();

require_once('../class/Post.php');


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

    <!-- CRUD -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        /* body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        } */

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .msg {
            max-width: fit-content;
            padding: 5px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }

        .custom-checkbox label:before {
            width: 18px;
            height: 18px;
        }

        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }

        .custom-checkbox input[type="checkbox"]:checked+label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            border-color: #fff;
        }

        .custom-checkbox input[type="checkbox"]:disabled+label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
</head>

<body>

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
                            <li><a href="index.php"><i class="fa fa-home"></i> Administration</a> <i
                                    class="fa fa-angle-double-right"></i></li>
                            <li><span>Articles</span> </li>
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
                                    <a href="#deleteModal" class="deleteButton btn btn-danger" data-toggle="modal"
                                        data-operation="delete_posts"><i class="material-icons">&#xE15C;</i>
                                        <span>Supprimer</span></a>
                                    <a href="#addModal" class="btn btn-success" data-toggle="modal"><i
                                            class="material-icons">&#xE147;</i> <span>Ajouter</span></a>
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
                                    <th>Description<br>
                                        de l'article</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Enoncé</th>
                                    <th>Texte</th>
                                    <th>Outro</th>
                                    <th>Auteur</th>
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

                                        <td>
                                            <?= (strlen($post->getDescPost()) > 50) ? substr($post->getDescPost(), 0, 40) . '...' : $post->getDescPost(); ?>
                                        </td>

                                        <td>Date:
                                            <?= date_format(new DateTime($post->getDate()), 'Y-m-d'); ?>
                                        </td>

                                        <td>
                                            <img src="<?= $post->getPicture(); ?>" alt="<?= $post->getDescPicture(); ?>"
                                                width="180px">
                                        </td>

                                        <td>
                                            <?= (strlen($post->getContent()) > 50) ? substr($post->getContent(), 0, 40) . '...' : $post->getContent(); ?>
                                        </td>

                                        <td>
                                            <?= (strlen($post->getText()) > 50) ? substr($post->getText(), 0, 40) . '...' : $post->getText(); ?>
                                        </td>

                                        <td>
                                            <?= (strlen($post->getOutro()) > 50) ? substr($post->getOutro(), 0, 40) . '...' : $post->getOutro(); ?>
                                        </td>

                                        <td>
                                            <?= (strlen($post->getAuthor()) > 50) ? substr($post->getAuthor(), 0, 40) . '...' : $post->getAuthor(); ?>
                                        </td>

                                        <td>

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
                                    <li class="page-item"><a href="admin/admin-posts.php?page=<?= ($page - 1) ?>"
                                            class="page-link">Précédent</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item<?= ($page == $i) ? ' active' : '' ?>"><a
                                            href="admin/admin-posts.php?page=<?= $i ?>" class="page-link"><?= $i ?></a></li>
                                <?php endfor; ?>

                                <?php if ($page < $totalPages): ?>
                                    <li class="page-item"><a href="admin/admin-posts.php?page=<?= ($page + 1) ?>"
                                            class="page-link">Suivant</a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="admin/add_post.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title">Ajouter un article</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" name="title_post" id="title_post" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Description <br>
                                        de l'article</label>
                                    <!-- <input type="text" name="desc_post" id="desc_post" class="form-control" required> -->
                                    <textarea name="desc_post" id="desc_post" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="date_post" id="date_post" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <!-- desc_picture est égale à name file -->
                                    <input type="file" name="picture_post" id="picture_post" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Enoncé</label>
                                    <textarea name="content_post" id="content_post" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Texte</label>
                                    <textarea name="text_post" id="text_post" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Outro</label>
                                    <input type="text" name="outro_post" id="outro_post" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Auteur</label>
                                    <input type="text" name="author_post" id="author_post" class="form-control" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="button" name="button" id="button" class="btn btn-default"
                                    data-dismiss="modal" value="Cancel">
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="admin/update_post.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title">Éditer un article</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="updatePicture" id="updatePicture" class="form-control"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" name="updateTitle" id="updateTitle" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="updateDate" id="updateDate" class="form-control" required>
                                    <!-- <textarea class="form-control" required></textarea> -->
                                </div>
                                <div class="form-group">
                                    <label>Enoncé</label>
                                    <textarea name="updateEnunciate" id="updateEnunciate" class="form-control"
                                        required></textarea>
                                    <!-- <input type="text" class="form-control" required> -->
                                </div>
                                <input type="hidden" name="updateId" id="updateId" />
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-info" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Delete Modal HTML -->
            <div id="deleteModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" method="">
                            <div class="modal-header">
                                <h4 class="modal-title">Supprimer un article</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sur de vouloir supprimer <span id="selectedCount"></span> articles ?</p>

                                <p class="text-warning"><small>Cette action est définitive.</small></p>
                                <input type="hidden" id="deletePostId" name="deletePostId" value="">
                                <input type="hidden" id="deletePostIds" name="deletePostIds" value="">
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-danger" id="confirmDeleteButton" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!--=================================
  CRUD-->



        <?php include('../include/footer.php'); ?>
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
                    xhr.open("POST", "admin/get_article.php");
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var articleData = JSON.parse(xhr.responseText);

                            console.log(articleData);

                            // Utilisez les méthodes pour accéder aux valeurs des propriétés
                            var id = postId;
                            var title = articleData.title;
                            var rawDate = articleData.date;
                            var descPost = articleData.desc_post;

                            // Formater la date dans le format AAAA-MM-JJ
                            var formattedDate = new Date(rawDate).toLocaleDateString('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit' });

                            // Utilisez les données de l'article pour afficher les valeurs dans la modal
                            document.getElementById("updateId").value = id;
                            document.getElementById("updateTitle").value = title;
                            document.getElementById("updateDate").value = formattedDate;
                            document.getElementById("updateEnunciate").value = descPost;

                        } else {
                            console.error("Error fetching article data:", xhr.statusText);
                        }
                    };

                    xhr.onerror = function () {
                        console.error("Request failed.");
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


            // Submit button click handler in the modal
            var confirmDeleteButton = document.getElementById("confirmDeleteButton");
            confirmDeleteButton.addEventListener("click", function () {

                var postId = document.getElementById("deletePostId").value;
                var postIds = document.getElementById("deletePostIds").value;

                // Vérification de l'opération au moment de la confirmation
                if (postId !== "") {
                    // Suppression d'un seul post
                    deleteSinglePost(postId);
                } else if (postIds !== "") {
                    // Suppression de plusieurs posts
                    deleteMultiplePosts(postIds);
                }
            });
            //________________________________________________________________


            function deleteSinglePost(postId) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "admin/delete_post.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log("Post deleted successfully.");
                        // Effectuer d'autres actions si nécessaire, comme mettre à jour la liste des posts
                    } else {
                        console.error("Error deleting the post:", xhr.statusText);
                    }
                };

                xhr.onerror = function () {
                    console.error("Request failed.");
                };

                xhr.send("deletePostId=" + encodeURIComponent(postId));
            }
            //________________________________________________________________


            function deleteMultiplePosts(postIds) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "admin/delete_posts.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log("Posts deleted successfully.");
                        // Effectuer d'autres actions si nécessaire, comme mettre à jour la liste des posts
                    } else {
                        console.error("Error deleting the posts:", xhr.statusText);
                    }
                };

                xhr.onerror = function () {
                    console.error("Request failed.");
                };

                xhr.send("deletePostIds=" + encodeURIComponent(postIds));
            }
            //________________________________________________________________


        });
    </script>


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

</body>

</html>