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
  <link rel="stylesheet" href="assets/css/slider.css">

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
              <h1>Offre d'emploi</h1>
              <p>Jamais Seul ... </p>
            </div>
            <ul class="page-breadcrumb">
              <li><a href="index.php?action=Recrutements"><i class="fa fa-home"></i> Recrutements</a> <i
                  class="fa fa-angle-double-right"></i></li>
              <li><span>Offre d'emploi</span> </li>
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
                <!-- OFFRE D'EMPLOI : Assistant(e) social(e) - Pôle médico-social et logement adapté -->
                <?= htmlspecialchars($job->getJobTitle(), ENT_QUOTES, 'UTF-8'); ?>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================== -->
    <section class="mb-80">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <p>
              <!-- L'association "Jamais Seul à Reims" recherche un(e) assistant(e) social(e) pour rejoindre notre équipe
              travaillant sur le pôle médico-social et logement adapté. Le/la candidat(e) retenu(e) travaillera en
              étroite collaboration avec les membres de l'équipe pour fournir des solutions de logement adapté aux
              personnes ayant des besoins médico-sociaux spécifiques. -->
              <?= htmlspecialchars($job->getJobDescription(), ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <!-- assets/img/assist.jpg -->
            <img src="<?= htmlspecialchars($job->getJobPicture(), ENT_QUOTES, 'UTF-8'); ?>"
              class="img-fluid full-width mt-20"
              alt="<?= htmlspecialchars($job->getJobDescriptionPicture(), ENT_QUOTES, 'UTF-8'); ?>">

            <div class="row">

              <div class="col-lg-4 col-sm-4 text-center mt-30">
                <h5>Lieux</h5>
                <p class="mt-20">
                  <?= $job->getJobPlaces(); ?>
                </p>
              </div>

              <div class="col-lg-4 col-sm-4 text-center mt-30">
                <h5>Chef(fe) de service</h5>
                <p class="mt-20">
                  <?= $lastName; ?><span class="d-block">
                    <?= $firstName; ?>
                  </span>
                </p>
              </div>

              <div class="col-lg-4 col-sm-4 text-center mt-30">
                <h5>Date</h5>
                <p class="mt-20"><b>Date de début:</b>
                  <?= htmlspecialchars($job->getJobDateCreated(), ENT_QUOTES, 'UTF-8'); ?> <span class="d-block"><b>Date
                      de lancement:</b>
                    <?= htmlspecialchars($job->getJobDateStarted(), ENT_QUOTES, 'UTF-8'); ?>
                  </span>
                </p>
              </div>

            </div>

          </div>
        </div>
        <div class="divider outset mt-30"></div>

        <div class="row">

          <div class="col-lg-6 mt-40 mb-40">
            <h4 class="mb-20">Responsabilités</h4>
            <!-- <p>I coach my clients to practice the 3 D’s – Defer, Delegate or Delete. Can the particular activity be done
              later? Defer it! Can it be done by someone else? Delegate it! Does it need to be done at all? If not,
              consider deleting it! Posing these questions will help to keep you focused on what is truly important!</p> -->
            <ul class="list list-mark">
              <?php foreach ($responsibilityList as $responsibility): ?>
                <li>
                  <?= trim($responsibility); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="col-lg-6 mt-40 mb-40 sm-mt-0">
            <h4>Qualifications requises</h4>
<br>
            <?php foreach ($qualificationList as $qualification): ?>
              <p>
                <?= trim($qualification); ?>
            </p>
            <?php endforeach; ?>

            <p> Si vous êtes intéressé(e) par cette opportunité et que vous êtes passionné(e) par l'aide aux personnes
              en situation de vulnérabilité, n'hésitez pas à postuler en envoyant votre CV et votre lettre de motivation
              via notre formulaire de contact ci-dessous. Nous avons hâte de vous entendre!</p>
            <a class="button" href="index.php?action=Contact"> POSTULER ICI </a>
          </div>

        </div>


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