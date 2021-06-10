<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<div class="modal" id="modal-nav">
  <div class="modal-bg" id="modal-nav-bg"></div>
  <div class="modal-opaque"></div>
  <div id="modal-nav-content" class="modal-content">
    <div class="x-out x-out-modal" id="x-out-nav">
      <i class="fas fa-times"></i>
    </div>
    <h2>Menu</h2>
    <nav id="nav-main">
      <ul>
        <li><a href="<?php  echo $site_url;?>">Home</a></li>
        <li><a href="<?php  echo $site_url;?>about">About</a></li>
        <li><a href="<?php  echo $site_url;?>portfolio">Portfolio</a></li>
      </ul>
    </nav>
  </div>
</div>
