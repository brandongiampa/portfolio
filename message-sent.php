<?php include_once 'includes/header.php';?>
<div class="hero-image2 fade-in animated">
  <div class="hero-bg-mini" id="hero-work"></div>
  <div class="hero-opaque"></div>
</div>
<div class="container message-response" id="message-outcome">
<?php
  $str = "Your message has been sent";
  if(isset($_SESSION['email'])){
    $str .= " and you will receive a response promptly at <i>" . $_SESSION['email'] . "</i> ";
  }
  $str .= "!";
  $_SESSION = array();
  session_destroy();
?>
  <h1>Thank You!!!</h1>
  <p><?php echo $str;?></p>
  <h3>Redirecting you in <span id="redirect">5</span>...</h3>
  <a href="<?php  echo $site_url;?>" class="btn btn-purple">Home</a>
</div>
<?php include_once 'includes/footer.php';?>
