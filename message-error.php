<?php $porto_is_allowed = true; ?>

<?php include_once 'includes/header.php';?>

<?php
  $str = 'Unfortunately, there was an error sending your message.  If this persists, please contact webmaster directly at <a href="mailto:brandongiampa555@gmail.com">brandongiampa555@gmail.com</a>.';
  $_SESSION = array();
  session_destroy();
?>

<div class="container message-response">
  <p class="green-text"><?php echo $str;?></p>
  <a href="<?php  echo $site_url;?>" class="btn btn-purple">Home</a>
</div>

<?php include_once 'includes/footer.php';?>
