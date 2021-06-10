<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<?php
  if(isset($_POST['submit-modal'])){
    $email = $_POST['email-modal'];
    $message = $_POST['message-modal'];
  }
  else if(isset($_POST['submit-footer'])){
    $email = $_POST['email-footer'];
    $message = $_POST['message-footer'];
  }

  if(isset($_POST['submit-modal'])||isset($_POST['submit-footer'])){
    $to = "me@brandongiampa.com";
    $subject = "Dev Inquiry";
    $txt = $message;
    $headers = "From: " . $email . "\r\n";

    if(mail($to,$subject,$txt,$headers)){
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['message-sent'] = true;
      header("Location: message-sent.php");
    }
    else {
      session_start();
      $_SESSION['message-sent'] = false;
      header("Location: message-error.php");
    }
  }
?>
