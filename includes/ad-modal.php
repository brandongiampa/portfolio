<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<div class="modal" id="modal-ad">
  <div class="modal-bg" id="modal-ad-bg"></div>
  <div class="modal-opaque"></div>
  <div class="modal-content" id="modal-ad-content">
    <div class="x-out x-out-modal" id="x-out-modal">
      <i class="fas fa-times"></i>
    </div>
    <h2>What are you waiting for?</h2>
    <h4>Send Brandon a message right now!</h4>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <label for="email">Email</label><br>
      <input type="email" name="email-modal" id="email-modal" required><br>
      <label for="message">Message</label><br>
      <textarea name="message-modal" id="message-modal" cols="30" rows="10" required></textarea><br>
      <input class="btn btn-purple" type="submit" value="Send" name="submit-modal">
    </form>
  </div>
</div>
