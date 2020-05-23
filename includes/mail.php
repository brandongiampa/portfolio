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
    $to = "brandongiampa555@gmail.com";
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
