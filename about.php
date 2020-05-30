<?php include_once 'includes/header.php';?>
<?php
  $db = DB::connect();
  $query = $db->prepare('SELECT content FROM pages WHERE name = :name');
  $page = 'about';
  $query->bindParam(':name', $page, PDO::PARAM_STR);
  $query->execute();

  $output = $query->fetch(PDO::FETCH_ASSOC);
?>
<style>
  header {
    border-bottom: 1px var(--primaryColor) solid;
  }
</style>
<div class="hero-image2 fade-in fast animated">
  <div class="hero-bg-mini" id="hero-work"></div>
  <div class="hero-opaque"></div>
</div>
<section id="about-section">
  <div class="section-header fade-from-left fast animated">
    <h2>about</h2>
    <div class="underline"></div>
  </div>
  <div class="container about-section-text fade-in animated">
    <?php echo $output['content'];?>
    <!--
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni optio quas doloremque excepturi itaque inventore dolorem ab eum voluptatum. Ipsum ipsa doloremque aperiam autem nostrum, nobis voluptate assumenda quae dolore necessitatibus accusantium, quasi voluptatem doloribus aut omnis possimus, ea commodi? Earum provident, ab sed error quibusdam, fuga, sequi officiis debitis cupiditate ducimus exercitationem quis eum iste quod fugit possimus? Autem officia voluptatem, exercitationem eveniet quae amet iure! Autem maxime eos, reprehenderit necessitatibus debitis!</p>
    <p>Ipsum dolor sit amet, consectetur adipisicing elit. Iste culpa, non esse perferendis fugit laborum maxime quidem, animi repudiandae magni enim amet nemo quibusdam ut cupiditate tenetur! Error facilis iure dolorem fugit?</p>
    <p>Dolor sit amet, consectetur adipisicing elit. Ea eius dignissimos fuga dolorum dicta repellat tenetur ratione tempora libero aliquam, architecto, laboriosam doloremque. Odit tempore, dolorum illum eum quo provident officiis.</p>
    <p>Sit amet, consectetur adipisicing elit. Eos nam nulla nostrum?</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo ipsa excepturi in aliquam suscipit reiciendis, veritatis magnam? Harum asperiores, consequatur nihil? Ipsa ea, similique. Unde corporis, maxime nostrum vel perferendis quam labore blanditiis repellendus mollitia rem quos ab magnam eaque sint impedit doloribus at molestias eos voluptates, accusamus. A, possimus ipsam. Perferendis, temporibus! Aut veritatis maxime repellat nihil vitae in.</p>
  -->
  </div>
  <div class="back-to-portfolio fade-in fast animated">
    <a href="<?php  echo $site_url;?>portfolio">View Portfolio &rarr;</a>
  </div>
  <div class="about-b fade-in animated" id="technologies-used">
    <?php include_once 'includes/technologies-used.php';?>
  </div>
</section>
<?php include_once 'includes/footer.php';?>
