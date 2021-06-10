<?php $porto_is_allowed = true; ?>

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
  <div class="container about-section-text">
    <?php echo $output['content'];?>
  </div>
  <div class="back-to-portfolio fade-in fast animated">
    <a href="<?php  echo $site_url;?>portfolio">View Portfolio &rarr;</a>
  </div>
  <div class="about-b fade-in animated" id="technologies-used">
    <?php include_once 'includes/technologies-used.php';?>
  </div>
</section>
<?php include_once 'includes/footer.php';?>
