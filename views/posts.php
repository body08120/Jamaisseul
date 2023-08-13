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
              <h1>ACTUALITÉ ?</h1>
              <p>Jamais Seul ... </p>
            </div>
            <ul class="page-breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a> <i class="fa fa-angle-double-right"></i>
              </li>
              <li><span>Nos Actualités</span> </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!--=================================
page-title -->


    <!--=================================
 Blog-->

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

    <section class="blog blog-grid-3-column white-bg page-section-ptb">
      <div class="container">

        <div class="row">
          <?php foreach ($posts as $post): ?>
            <div class="col-lg-4 col-md-4">
              <div class="blog-entry mb-50">
                <div class="entry-image clearfix">
                  <img class="img-fluid" src="<?= htmlspecialchars($post->getPicture(), ENT_QUOTES, 'UTF-8'); ?> " alt="<?= htmlspecialchars($post->getDescPicture(), ENT_QUOTES, 'UTF-8'); ?> ">
                </div>
                <div class="blog-detail">
                  <div class="entry-title mb-10">
                    <a href="index.php?action=Actualite&id=<?= htmlspecialchars($post->getId(), ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($post->getTitle(), ENT_QUOTES, 'UTF-8'); ?> </a>
                  </div>
                  <div class="entry-meta mb-10">
                    <ul>
                      <li><a href="index.php?action=Actualite&id=<?= htmlspecialchars($post->getId(), ENT_QUOTES, 'UTF-8'); ?>"><i class="fa fa-calendar-o"></i><?= htmlspecialchars($post->getFormattedDate(), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    </ul>
                  </div>
                  <div class="entry-content">
                  <p><?= nl2br(strip_tags($post->getContent())); ?></p>
                  </div>
                  <div class="entry-share clearfix">
                    <div class="entry-button">
                      <a class="button arrow" href="index.php?action=Actualite&id=<?= htmlspecialchars($post->getId(), ENT_QUOTES, 'UTF-8'); ?>">Lire l'Article<i class="fa fa-angle-right"
                          aria-hidden="true"></i></a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <!-- ================================================ -->
          <!-- <div class="col-lg-4 col-md-4">
            <div class="blog-entry mb-50">
              <div class="entry-image clearfix">
                <div class="owl-carousel bottom-center-dots" data-nav-dots="ture" data-items="1" data-md-items="1"
                  data-sm-items="1" data-xs-items="1" data-xx-items="1">
                  <div class="item">
                    <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
                  </div>
                  <div class="item">
                    <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
                  </div>
                  <div class="item">
                    <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="blog-detail">
                <div class="entry-title mb-10">
                  <a href="#">Actualité 02</a>
                </div>
                <div class="entry-meta mb-10">
                  <ul>
                    <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2021</a></li>
                  </ul>
                </div>
                <div class="entry-content">
                  <p>Asperiores mollitia excepturi voluptatibus sequi nostrum ipsam veniam omnis nihil! A ea maiores
                    corporis. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. consectetur, assumenda provident lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Quae laboriosam sunt hic perspiciatis, </p>
                </div>
                <div class="entry-share clearfix">
                  <div class="entry-button">
                    <a class="button arrow" href="#">Read More<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </div>

                </div>
              </div>
            </div>

          </div> -->
          <!-- ================================================ -->
          <!-- <div class="col-lg-4 col-md-4">
            <div class="blog-entry mb-50">
              <div class="entry-image clearfix">
                <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
              </div>
              <div class="blog-detail">
                <div class="entry-title mb-10">
                  <a href="#">Actualité 03</a>
                </div>
                <div class="entry-meta mb-10">
                  <ul>
                    <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2021</a></li>
                  </ul>
                </div>
                <div class="entry-content">
                  <p>Quae laboriosam sunt hic perspiciatis, asperiores mollitia excepturi voluptatibus sequi nostrum
                    ipsam veniam omnis nihil! A ea maiores corporis. Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Consectetur, assumenda
                    provident lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                </div>
                <div class="entry-share clearfix">
                  <div class="entry-button">
                    <a class="button arrow" href="#">Lire l'Article<i class="fa fa-angle-right"
                        aria-hidden="true"></i></a>
                  </div>

                </div>
              </div>
            </div>

          </div> -->

        </div>

        <!-- <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="blog-entry mb-50">
              <div class="entry-image clearfix">
                <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
              </div>
              <div class="blog-detail">
                <div class="entry-title mb-10">
                  <a href="#">Actualité 01</a>
                </div>
                <div class="entry-meta mb-10">
                  <ul>
                    <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2021</a></li>
                  </ul>
                </div>
                <div class="entry-content">
                  <p>Quae laboriosam sunt hic perspiciatis, asperiores mollitia excepturi voluptatibus sequi nostrum
                    ipsam veniam omnis nihil! A ea maiores corporis. Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Consectetur, assumenda
                    provident lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                </div>
                <div class="entry-share clearfix">
                  <div class="entry-button">
                    <a class="button arrow" href="#">Lire l'Article<i class="fa fa-angle-right"
                        aria-hidden="true"></i></a>
                  </div>

                </div>
              </div>
            </div>

          </div> -->
        <!-- ================================================ -->
        <!-- <div class="col-lg-4 col-md-4">
            <div class="blog-entry mb-50">
              <div class="entry-image clearfix">
                <div class="owl-carousel bottom-center-dots" data-nav-dots="ture" data-items="1" data-md-items="1"
                  data-sm-items="1" data-xs-items="1" data-xx-items="1">
                  <div class="item">
                    <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
                  </div>
                  <div class="item">
                    <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
                  </div>
                  <div class="item">
                    <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="blog-detail">
                <div class="entry-title mb-10">
                  <a href="#">Actualité 02</a>
                </div>
                <div class="entry-meta mb-10">
                  <ul>
                    <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2021</a></li>
                  </ul>
                </div>
                <div class="entry-content">
                  <p>Asperiores mollitia excepturi voluptatibus sequi nostrum ipsam veniam omnis nihil! A ea maiores
                    corporis. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. consectetur, assumenda provident lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Quae laboriosam sunt hic perspiciatis, </p>
                </div>
                <div class="entry-share clearfix">
                  <div class="entry-button">
                    <a class="button arrow" href="#">Read More<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </div>

                </div>
              </div>
            </div>

          </div> -->
        <!-- ================================================ -->
        <!-- <div class="col-lg-4 col-md-4">
            <div class="blog-entry mb-50">
              <div class="entry-image clearfix">
                <img class="img-fluid" src="assets/img/blog01.jpg" alt="">
              </div>
              <div class="blog-detail">
                <div class="entry-title mb-10">
                  <a href="#">Actualité 03</a>
                </div>
                <div class="entry-meta mb-10">
                  <ul>
                    <li><a href="#"><i class="fa fa-calendar-o"></i> 12 Aug 2021</a></li>
                  </ul>
                </div>
                <div class="entry-content">
                  <p>Quae laboriosam sunt hic perspiciatis, asperiores mollitia excepturi voluptatibus sequi nostrum
                    ipsam veniam omnis nihil! A ea maiores corporis. Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Consectetur, assumenda
                    provident lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                </div>
                <div class="entry-share clearfix">
                  <div class="entry-button">
                    <a class="button arrow" href="#">Lire l'Article<i class="fa fa-angle-right"
                        aria-hidden="true"></i></a>
                  </div>

                </div>
              </div>
            </div>

          </div> -->
        <!-- </div> -->


        <!-- ================================================ -->
        <div class="row">
          <div class="col-lg-12 col-lg-12">
            <div class="entry-pagination">
              <nav aria-label="Page navigation example text-center">
                <ul class="pagination justify-content-center">

                  <!-- Si la page courante + grand que 1: -->
                  <li class="page-item">
                    <?php if ($currentPage > 1): ?>
                        <a class="page-link" href="index.php?action=Actualites&page=<?php echo $currentPage - 1; ?>"
                          aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                    <?php endif; ?>
                  </li>

                  <!-- on boucle les pages -->
                  <?php for ($page = 1; $page <= $pages; $page++): ?>
                      <li class="page-item">
                        <a class="page-link" href="index.php?action=Actualites&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                      </li>
                  <?php endfor; ?>

                  <!-- si la page courante est + petite que le nombre de pages -->
                  <li class="page-item">
                    <?php if ($currentPage < $pages): ?>
                        <a class="page-link" href="index.php?action=Actualites&page=<?php echo $currentPage + 1; ?>"
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
 Blog-->


    <!--=================================
our-services -->

    <section class="action-box theme-bg full-width">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 position-relative">
            <div class="action-box-text">
              <h3><strong> Jamais Seul : </strong> Vous souhaitez nous contacter ? </h3>
            </div>
            <div class="action-box-button">
              <a class="button button-border white" href="#">
                <span>Cliquer Ici</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

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

  <!-- slider -->
  <script src="assets/js/slider.js"></script>

</body>

</html>