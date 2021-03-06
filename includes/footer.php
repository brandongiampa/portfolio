<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<footer class="fade-in animated">
  <div class="container">
    <div id="footer-info">
      <h2>brandon giampa</h2>
      <a type="email" href="mailto:brandongiampa555@gmail.com">brandongiampa555@gmail.com</a><br>
      <a href="http://github.com/brandongiampa"><i class="fab fa-github"></i></a>
      <a href="http://linkedin.com/brandongiampa"><i class="fab fa-linkedin"></i></a>
    </div>
    <div id="footer-message">
      <span class="send-message">Send Brandon a Message!</span><br>
      <form action="<?php echo htmlentities( $_SERVER[ 'PHP_SELF' ] );?>" method="post">
        <label for="email-footer">Email</label><br>
        <input type="email" name="email-footer" id="email-footer"><br>
        <label for="message-footer">Message</label><br>
        <textarea name="message-footer" id="message-footer" cols="30" rows="10"></textarea><br>
        <input class="btn btn-purple" type="submit" value="Send" name="submit-footer">
      </form>
    </div>
    <div class="copyright">
      &copy;Copyright 2020, Brandon Giampa
    </div>
  </div>
</footer>
</main>
<?php $directory = !isset( $_GET[ 'work' ] ) ? "js/" : "../js/"; ?>
<script src="<?php echo $directory; ?>main-min.js" type="text/javascript" defer></script>
</body>
</html>
