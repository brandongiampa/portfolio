<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<?php session_start();?>
<?php include_once 'database/db.php';?>
<?php include_once 'mail.php';?>
<?php $site_url = isset($site_url) ? $site_url : "https://brandongiampa.com/";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Caveat|Fascinate|Oswald:400,500,600&display=block" rel="stylesheet">
  <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T8Q4NRS');</script>
  <!-- End Google Tag Manager -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brandon Giampa - Web Developer</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $site_url;?>css/style.css" type="text/css">
  <meta name="keywords" content="Web Developer, Full Stack Developer, Front End Developer, PHP Developer, Wordpress Developer, Orange County, Los Angeles, Brandon Giampa, Brandon Jump">
  <meta name="description" content="Full Stack Web Developer Portfolio of Brandon Giampa">
  <meta name="author" content="Brandon Giampa">
  <link rel="icon" href="https://imgur.com/3txobOf">
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T8Q4NRS"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <main>
    <a href="#footer-message">
      <div id="message-me">
        <i class="fas fa-envelope"></i>
      </div>
    </a>
    <header class="fade-in animated">
      <a href="<?php echo $site_url;?>">
        <div id="branding" class="fade-in animated">
          <span class="first-initial">b</span><span class="last-initial">g</span>
        </div>
      </a>
      <div id="hamburger" class="fade-in animated">
        <div class="line" id="hamburger-top"></div>
        <div class="line" id="hamburger-bottom"></div>
      </div>
    </header>
    <?php include_once __DIR__ . '/nav-modal.php';?>
    <?php include_once __DIR__ . '/ad-modal.php';?>
