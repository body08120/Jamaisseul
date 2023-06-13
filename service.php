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

</head>

<body>

  <div class="wrapper">

    <!--=================================
 preloader -->

    <?php include('include/header.php'); ?>
    <!--=================================
 header -->


    <!--=================================
page-title-->

    <section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="img/02.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-title-name">
              <h1>NOS ÉTABLISSEMENTS ET SERVICES</h1>
              <p>Jamais Seul ... </p>
            </div>
            <ul class="page-breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Nos Établissements et Services</span> </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!--=================================
page-title -->


    <!--=================================
 service-->

    <section class="service white-bg page-section-ptb">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-title text-center">
            <h6>En savoir plus sur nos différents pôles et services </h6>
            <h2 class="title-effect">Nos Différents Pôles</h2>
          </div>
    </div>
    <!-- ============================================ -->
   <div class="service-3">
    <div class="row">
      <div class="col-lg-6 col-md-6 position-relative">
        <div class="service-blog text-end">
          <h3 class="theme-color">Pôle Hébergement</h3>
            <a href="hebergement.php">
              <p>Au sein de notre centre, nous proposons des places d'hébergement et de réinsertion sociale (CHRS) qui offrent un environnement sûr et sécurisé aux individus et aux familles qui ont besoin d'un soutien temporaire.</p>
            </a>
              <b>01</b>
              <ul class="list list-unstyled">
                <li>Centre d'hébergement et de réinsertion sociale (CHRS) </li>
                <li>Hébergement d'urgence (HU)</li>
                <!-- <li>Custom web design</li> -->
              </ul>
          </div>
       </div>
       <div class="col-lg-6 col-md-6 xs-mt-30 xs-mb-30">
         <img class="img-fluid full-width" src="img/s01.jpg" alt="">
       </div>
    </div>
    <!-- ============================================ -->
    <div class="row">

     <div class="col-lg-6 col-md-6 position-relative">
         <img class="img-fluid full-width" src="img/s02.jpg" alt="">
       </div>
        <div class="col-lg-6 col-md-6 xs-mt-30 xs-mb-30 position-relative">
          <div class="service-blog left text-start">
            <h3 class="theme-color">Pôle Médico-Social et Logement Adapté </h3>
            <a href="medicosocial.php">
              <p>Le pôle médico-social et logement adapté offre une gamme de services essentiels pour répondre aux besoins des personnes en situation de handicap et de troubles de santé mentale.</p>
            </a>
              <b>02</b>
              <ul class="list list-unstyled">
                <li>ACT (+ dossier de demande) </li>
                <li>LHSS (+ dossier de demande) </li>
                <li>Maison relais / Pension de famille</li>
              </ul>
          </div>
       </div>
    </div>
    <!-- ============================================ -->
    <div class="row">
       <div class="col-lg-6 col-md-6 xs-mt-30 xs-mb-30 position-relative">
          <div class="service-blog text-end">
            <a href="asile.php">
             <h3 class="theme-color">Pôle Asile</h3>
              <p></p>
              <b>03</b>
              <ul class="list list-unstyled">
                <li>Centres d’accueil pour demandeurs d’asile (CADA)</li>
                <li>Hébergement d’urgence des demandeurs d’asile (HUDA)</li>
                <li>Centre d’accueil et d’examen des situations (CAES)</li>
              </ul>
            </a>
            </div>
          <!-- ============================================ -->
        </div>
        <div class="col-lg-6 col-md-6 xs-mt-30 xs-mb-30">
          <img class="img-fluid full-width" src="img/s03.jpg" alt="">
        </div>
      </div>
    </section>

    <!--=================================
 service-->


    <?php include('include/contact.php'); ?>

    <?php include('include/footer.php'); ?>
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

</body>

</html>