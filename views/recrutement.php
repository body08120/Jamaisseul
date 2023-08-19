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
              <h1>RECRUTEMENTS</h1>
              <p>Jamais Seul ... </p>
            </div>
            <ul class="page-breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a> <i class="fa fa-angle-double-right"></i>
              </li>
              <li><span>Recrutements</span> </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!--=================================
page-title -->

    <!--=================================
  our-clients-->

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

    <section class="our-clients white-bg page-section-ptb" style="text-align: justify;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="section-title text-center">
              <h6>Nos offres d'emplois</h6>
              <h2 class="title-effect">Rejoignez notre équipe</h2>
              <p class="">Une équipe conviviale et pleine d'empathie</p>
            </div>

          </div>
        </div>

        <div class="row">

          <!-- On boucle -->
          <?php
          foreach ($jobs as $job): ?>
            <div class="col-lg-6 col-md-6">
              <div class="clients-box mb-30 clearfix">
                <div class="clients-photo">
                  <img src="<?= htmlspecialchars($job->getJobPicture(), ENT_QUOTES, 'UTF-8'); ?> " alt="<?= htmlspecialchars($job->getJobDescriptionPicture(), ENT_QUOTES, 'UTF-8'); ?> " width="200"
                    height="200">
                </div>
                <div class="clients-info sm-pt-20">
                  <h5>
                    <?= htmlspecialchars($job->getJobTitle(), ENT_QUOTES, 'UTF-8'); ?> 
                  </h5>
                  <a href="index.php?action=Recrutement&id=<?= $job->getJobId(); ?>"> <i class="fa fa-link"></i> cliquer
                    ici</a>
                  <p>
                  <?= htmlspecialchars(substr($job->getJobDescription(), 0, 255) . '...', ENT_QUOTES, 'UTF-8'); ?> 
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- On boucle -->


        </div>

        <!-- ================================================ -->
        <div class="row">
          <div class="col-lg-12 col-lg-12">
            <div class="entry-pagination">
              <nav aria-label="Page navigation example text-center">
                <ul class="pagination justify-content-center">

                  <!-- Si la page courante + grand que 1: -->
                  <li class="page-item">
                    <?php if ($currentPage > 1): ?>
                      <a class="page-link" href="index.php?action=Recrutements&page=<?php echo $currentPage - 1; ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    <?php endif; ?>
                  </li>

                  <!-- on boucle les pages -->
                  <?php for ($page = 1; $page <= $pages; $page++): ?>
                    <li class="page-item">
                      <a class="page-link" href="index.php?action=Recrutements&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                    </li>
                  <?php endfor; ?>

                  <!-- si la page courante est + petite que le nombre de pages -->
                  <li class="page-item">
                    <?php if ($currentPage < $pages): ?>
                      <a class="page-link" href="index.php?action=Recrutements&page=<?php echo $currentPage + 1; ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    <?php endif; ?>
                  </li>

                </ul>
              </nav>
            </div>
          </div>
        </div>
        <!-- ================================================ -->
      </div>
    </section>

    <!--=================================
  our-clients-->


    <?php include('src/include/contact.php'); ?>

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