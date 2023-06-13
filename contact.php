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
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

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

<!-- Dropdown -->
<link rel="stylesheet" type="text/css" href="css/slider.css"/>
</head>

<body>

<div class="wrapper">

<!--=================================
 preloader -->

<?php include('include/header.php');?>
<!--=================================
 header -->


<!--=================================
page-title-->

<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="img/02.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-name">
            <h1>Contact ?</h1>
            <p>Jamais Seul ... </p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Contact</span> </li>
         </ul>
       </div>
     </div>
  </div>
</section>

<!--=================================
page-title -->





<!--=================================
 map-->

<section class="white-bg contact-3 o-hidden clearfix">
   <!-- =============================== -->
   <div class="container-fluid">
     <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 contact-add gray-bg h-100">
             <div class="text-center">
               <i class="ti-map-alt"></i>
               <h4 class="mt-15">Adresse</h4>
               <p>4 Bd Hector Berlioz, 51100 Reims</p>
              </div>
             </div>
             <div class="col-lg-4 col-md-4 col-sm-4 contact-add theme-bg h-100">
              <div class="text-center">
               <i class="ti-mobile text-white"></i>
               <h4 class="text-white mt-15">Nous Téléphoner</h4>
               <p class="text-white">03 26 06 48 09</p>
              </div>
             </div>
             <div class="col-lg-4 col-md-4 col-sm-4 contact-add  black-bg h-100">
             <div class="text-center">
               <i class="ti-email text-white"></i>
               <h4 class="text-white mt-15">Notre Email</h4>
               <p class="text-white">contact@jamais-seul.fr</p>
             </div>
           </div>
          </div>
    </div>
   <div class="container-fluid pos-r">
    <div class="row  full-height">
    <div class="col-lg-6 map-side g-map" id="map" data-type='black'>
       <div class="contact-map">
     </div>
    </div>
   </div>
  </div>
  <div class="container">
  <div class="row justify-content-end">
      <div class="col-lg-5">
      <div class="contact-3-info page-section-ptb">
       <div class="clearfix">
          <div class="section-title mb-0">
           <h6>Besoin de nous ?</h6>
           <h2 class="title-effect">Contacter Nous</h2>
           </div>
           <p class="mb-50">N'hésitez pas à nous contacter via le formulaire ci-dessous pour toute question ou demande d'information <span class="tooltip-content" data-original-title="Mon-Fri 10am–7pm (GMT +1)" data-bs-toggle="tooltip" data-placement="top"> 24 heures!</span></p>
            <div id="formmessage">Success/Error Message Goes Here</div>
             <form id="contactform" role="form" method="post" action="php/contact-form.php">
               <div class="contact-form clearfix">
                  <div class="section-field">
                    <input id="name" type="text" placeholder="Nom*" class="form-control"  name="name">
                   </div>
                   <div class="section-field">
                      <input type="email" placeholder="Email*" class="form-control" name="email">
                    </div>
                   <div class="section-field">
                      <input type="text" placeholder="Téléphone*" class="form-control" name="phone">
                    </div>
                   <div class="section-field textarea">
                     <textarea class="input-message form-control" placeholder="Message*"  rows="7" name="message"></textarea>
                    </div>
          					<!-- Google reCaptch-->
          					<div class="g-recaptcha section-field clearfix" data-sitekey="6LfNmS0UAAAAAO_ZVFQoQmkGPMlQXmKgVbizHFoq"></div>
          					<div class="section-field submit-button">
                    <input type="hidden" name="action" value="sendEmail"/>
                     <button id="submit" name="submit" type="submit" value="Send" class="button"><span> Envoyer votre message </span> <i class="fa fa-paper-plane"></i></button>
					          </div>
                    </div>
                  </form>
                 <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block" src="images/pre-loader/loader-02.svg" alt=""></div>
              </div>
         </div>
    </div>
    </div>
    </div>
</section>


<!--=================================
map -->



<!--=================================
our-services -->

<section class="action-box theme-bg full-width" >
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




<?php include('include/footer.php') ; ?>
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
