<?php $porto_is_allowed = true; ?>

<?php include_once 'includes/header.php';?>
<?php

  $DB = DB::connect();

  try{
    $query = $DB->prepare("SELECT COUNT(*) FROM project");
    $query->execute();

    $numberOfProjects = $query->fetchColumn();

    $upperLimit = 8;
    $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($pageNumber * $upperLimit) - $upperLimit;
    $projectMessage = '';

    $query = $DB->prepare(
      'SELECT id, name, url, slug, github, img_path FROM project ORDER BY id DESC LIMIT :limit OFFSET :offset'
    );
    $query->bindParam(':limit', $upperLimit, PDO::PARAM_INT);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    $query->execute();

    $numOfProjects = $query->rowCount();

    if($numOfProjects === 0){
      $projectMessage = 'There are no projects to display.';
    }
  }
  catch(PDOException $ex){
    $numOfProjects = 0;
    $projectMessage = 'There was an error retrieving the projects. Please contact the site administrator if the problem continues after reloading. <br>' . $ex->getMessage();
  }
?>

<div class="hero-image2 fade-in animated">
  <div class="hero-bg-small" id="hero-portfolio"></div>
  <div class="hero-opaque"></div>
</div>
<section id="portfolio-section">
  <div class="section-header fade-from-left">
    <h2>portfolio</h2>
    <div class="underline"></div>
  </div>
  <div class="works px-3"><?php
  if($numOfProjects > 0){
    $i = 0;

    while($row = $query->fetch(PDO::FETCH_ASSOC)){?>
      <?php
        $animationClass = $i % 2 === 0 ? 'fade-from-left animated' : 'fade-from-right animated';
      ?>
      <div class="work <?php echo $animationClass;?>" id="work-<?php echo $i+1;?>">
        <a href="<?php  echo $site_url;?>work/<?php echo $row['slug'];?>">
          <img src="<?php echo $row[ 'img_path' ];?>" alt="">
        </a>
        <div class="work-overlay">
          <div class="work-links">
            <a href="<?php echo $site_url;?>work/<?php echo $row[ 'slug' ];?>" class="btn btn-transparent"><i class="fas fa-info-circle"></i>About</a>
            <a href="<?php echo $row['github'];?>" class="btn btn-transparent"><i class="fab fa-github"></i>Github</a>
            <a href="<?php echo $row['url'];?>" class="btn btn-transparent"><i class="fas fa-eye"></i>View</a>
          </div>
        </div>
      </div>
    <?php
      $i++;
    }
  }
  else {
    echo $projectMessage;
  }?>
  </div>
</section>
<section class="fade-in animated" id="end-of-portfolio">
  <div class="divider">(((----------------------End of Portfolio----------------------)))</div>
</section>
<?php include_once 'includes/footer.php';?>
