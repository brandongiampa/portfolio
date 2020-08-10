<?php session_start();?>
<?php include_once 'database/db.php';?>
<?php include_once 'mail.php';?>
<?php $site_url = isset($site_url) ? $site_url : "https://brandongiampa.com/";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Caveat|Fascinate|Oswald:300,400,500,600&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brandon Giampa - Web Developer</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php  echo $site_url;?>css/styles.css" type="text/css">
  <meta name="keywords" content="Web Developer, Full Stack Developer, Front End Developer, PHP Developer, Wordpress Developer, Orange County, Los Angeles, Brandon Giampa, Brandon Jump">
  <meta name="description" content="Portfolio of Brandon Giampa">
  <meta name="author" content="Brandon Giampa">
  <link rel="icon" href="../icons/icon2.png">
  <script data-ad-client="ca-pub-8145132171809817" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
  <main>
    <a href="#footer-message">
      <div id="message-me">
        <i class="fas fa-envelope"></i>
      </div>
    </a>
    <header class="fade-in animated">
      <a href="<?php  echo $site_url;?>">
        <div id="branding" class="fade-in animated">
          <span class="first-initial">b</span><span class="last-initial">g</span>
        </div>
      </a>
      <div id="hamburger" class="fade-in animated">
        <div class="line" id="hamburger-top"></div>
        <div class="line" id="hamburger-bottom"></div>
      </div>
    </header>
    <?php include_once 'nav-modal.php';?>
    <?php include_once 'cookie-notice.php';?>
    <?php include_once 'ad-modal.php';?>
