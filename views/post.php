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
              <h1>Actualité</h1>
              <!-- <p>Toutes nos actualités</p> -->
            </div>
            <ul class="page-breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a> <i class="fa fa-angle-double-right"></i>
              </li>
              <li><a href="index.php?action=Actualites"> Actualités</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Actualité 01</span> </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!--=================================
page-title -->

    <section class="service white-bg mt-80 sm-mt-40">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-title text-center">
              <h2 class="title-effect">
                <?= strip_tags($post->getTitle()); ?>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--=================================
 Blog-->

    <section class="blog blog-single white-bg page-section-ptb" style="text-align: justify;">
      <div class="container">
        <div class="row">

          <div class="col-lg-12">
            <div class="blog-entry mb-10">
              <div class="entry-image clearfix">
                <img class="img-fluid" src="<?= htmlspecialchars($post->getPicture(), ENT_QUOTES, 'UTF-8'); ?>"
                  alt="<?= htmlspecialchars($post->getDescPicture(), ENT_QUOTES, 'UTF-8'); ?>">
              </div>

            </div>
            <!-- ================================================ -->
            <!-- <div class="blog-entry blockquote mb-40 mt-40">
                <div class="entry-blockquote clearfix">
                  <blockquote class="mt-60 blockquote">
                    The trouble with programmers is that you can never tell what a programmer is doing until it's too
                    late. The future belongs to a different kind of person with a different kind of mind: artists,
                    inventors, storytellers-creative and holistic ‘right-brain’ thinkers whose abilities mark the fault
                    line between who gets ahead and who doesn’t.
                    <cite> – Romain PETIT</cite>
                  </blockquote>
                </div>
              </div> -->
            <!-- ================================================ -->
            <div class="blog-entry entry-content mt-20 mb-30 post-1 clearfix">

              <?= $post->getContent(); ?>

              <div class="entry-share clearfix">
                <div class="social list-style-none float-end mt-10">
                  <strong>Partagez : </strong>
                  <ul>
                    <li>
                      <a href="#"> <i class="fa fa-facebook"></i> </a>
                    </li>
                    <li>
                      <a href="#"> <i class="fa fa-twitter"></i> </a>
                    </li>
                    <li>
                      <a href="#"> <i class="fa fa-pinterest-p"></i> </a>
                    </li>
                    <li>
                      <a href="#"> <i class="fa fa-dribbble"></i> </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- ================================================ -->
            <div class="port-navigation clearfix">

              <?php if ($nextPost): ?>
                <div class="port-navigation-left float-start">
                  <div class="tooltip-content-3" data-original-title="Previous Project" data-bs-toggle="tooltip"
                    data-placement="right">
                    <a href="index.php?action=Actualite&id=<?= $nextPost->getId(); ?>">
                      <div class="port-photo float-start">
                        <img src="<?= $nextPost->getPicture(); ?>" alt="<?= $nextPost->getDescPicture(); ?>">
                      </div>
                      <div class="port-arrow">
                        <i class="fa fa-angle-left"></i>
                      </div>
                    </a>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($precPost): ?>
                <div class="port-navigation-right float-end">
                  <div class="tooltip-content-3" data-original-title="Next Project" data-bs-toggle="tooltip"
                    data-placement="left">
                    <a href="index.php?action=Actualite&id=<?= $precPost->getId(); ?>">
                      <div class="port-arrow float-start">
                        <i class="fa fa-angle-right"></i>
                      </div>
                      <div class="port-photo">
                        <img src="<?= $precPost->getPicture(); ?>" alt="<?= $precPost->getDescPicture(); ?>">
                      </div>
                    </a>
                  </div>
                </div>
              <?php endif; ?>

            </div>
            <!-- ================================================ -->
            <div class="port-post clearfix mt-40" style="text-align: justify;">
              <div class="port-post-photo">
                <img src="<?= htmlspecialchars($post->getPicture(), ENT_QUOTES, 'UTF-8'); ?>"
                  alt="<?= htmlspecialchars($post->getDescPicture(), ENT_QUOTES, 'UTF-8'); ?>">
              </div>
              <div class="port-post-info">
                <h3 class="theme-color"><span>Posté par:</span>
                  <?= strip_tags($author->getName()); ?>
                </h3>
                <div class="port-post-social float-end">
                  <strong>Suivez-le:</strong>
                  <a href="<?= htmlspecialchars($author->getFacebook(), ENT_QUOTES, 'UTF-8'); ?>"><i
                      class="fa fa-facebook"></i></a>
                  <a href="<?= htmlspecialchars($author->getTwitter(), ENT_QUOTES, 'UTF-8'); ?>"><i
                      class="fa fa-twitter"></i></a>
                  <a href="<?= htmlspecialchars($author->getPinterest(), ENT_QUOTES, 'UTF-8'); ?>"><i
                      class="fa fa-pinterest-p"></i></a>
                </div>
                <p>
                  <?= htmlspecialchars(substr($author->getDesc(), 0, 255) . '...', ENT_QUOTES, 'UTF-8'); ?>
                </p>
              </div>
            </div>
            <!-- ================================================ -->


            <div class="related-work mt-40">
              <div class="row">
                <div class="col-ld-12 col-md-12">
                  <h3 class="theme-color mb-20">Nos derniers articles</h3>
                  <div class="owl-carousel" data-nav-dots="false" data-items="2" data-xs-items="1" data-xx-items="1">

                    <?php foreach ($latestPosts as $postAuthorPair):
                          $lastPost = $postAuthorPair['post'];
                          $lastPostAuthor = $postAuthorPair['author']; ?>

                      <div class="item" style="text-align: justify;">
                        <div class="blog-box blog-1 active">
                          <div class="blog-info">
                            <!-- <span class="post-category"><a href="#">Business</a></span> -->
                            <h4> <a href="index.php?action=Actualite&id=<?= $lastPost->getId(); ?>"><?= strip_tags($lastPost->getTitle()); ?></a></h4>
                            <p>
                            <?= nl2br(strip_tags(substr($lastPost->getContent(), 0, 150) . '...')); ?>
                            </p>
                            <span><i class="fa fa-user"></i> By <?= htmlspecialchars($lastPostAuthor->getName(), ENT_QUOTES, 'UTF-8'); ?></span>
                            <span><i class="fa fa-calendar-check-o"></i> <?= htmlspecialchars($lastPost->getFormattedDate(), ENT_QUOTES, 'UTF-8'); ?> </span>
                          </div>
                          <div class="blog-box-img" style="background-image:url(<?= htmlspecialchars($lastPost->getPicture(), ENT_QUOTES, 'UTF-8'); ?>);"></div>
                        </div>
                      </div>
                    <?php endforeach; ?>

                  </div>
                </div>
              </div>
            </div>
            <br />

          </div>
          <!-- ================================================ -->
        </div>
      </div>
  </div>
  </section>

  <!--=================================
 Blog-->



  <!--=================================
our-services -->


  <?php include('src/include/contact.php'); ?>

  <!--=================================
action box- -->

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