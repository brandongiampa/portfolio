<?php $porto_is_allowed = true; ?>

<?php include_once 'includes/header.php';?>
<?php
  $DB = DB::connect();

  $upperLimit = 4;
  $projectMessage = '';

  try{
    $query = $DB->prepare(
      'SELECT id, name, slug, url, github, img_path FROM project ORDER BY id DESC LIMIT :limit'
    );
    $query->bindParam(':limit', $upperLimit, PDO::PARAM_INT);
    $query->execute();

    $numOfProjects = $query->rowCount();

    if($numOfProjects === 0){
      $projectMessage = 'There are no projects to display.';
    }
  }
  catch(PDOException $ex){
    $numOfProjects = 0;
    $projectMessage = 'There was an error retrieving the projects. Please contact the site administrator if the problem continues after reloading.';
  }
?>
    <div class="hero-image fade-in animated">
      <div class="hero-bg"></div>
      <div class="hero-opaque"></div>
      <div class="hero-text">
        <h1>Do you need a website?</h1>
        <h4>Look no further.</h4>
        <div class="hero-links">
          <a href="<?php  echo $site_url;?>portfolio" class="btn btn-purple">View Portfolio &raquo;</a>
        </div>
      </div>
    </div>
    <div class="profile-bg" >
      <div class="profile container">
        <div class="profile-text fade-from-left animated">
          <h6>-hello-</h6>
          <h1>brandon giampa</h1>
          <div class="underline"></div>
          <h3>Full Stack Web Developer</h3>
          <div class="social-links">
            <a href="http://linkedin.com/brandongiampa"><i class="fab fa-linkedin"></i><span class="sr-only">Brandon's LinkedIn Profile URL</span></a>
            <a href="http://github.com/brandongiampa"><i class="fab fa-github"></i><span class="sr-only">Brandon's GitHub URL</span></a>
          </div>
        </div>
        <div class="profile-img-div fade-from-right animated">
          <img src="https://imgur.com/8V6vW0s.jpg" class="profile-img" alt="">
        </div>
      </div>
    </div>
    <section id="portfolio-section">
      <div class="section-header fade-from-left fast animated">
        <h2>portfolio</h2>
        <div class="underline"></div>
      </div>
      <div class="works px-3"><?php
        $i = 0;

        while($row = $query->fetch(PDO::FETCH_ASSOC)){?>
          <?php
            if($i%2 === 0){
              $animationClass = 'fade-from-left animated';
            }
            else {
              $animationClass = 'fade-from-right animated';
            }
          ?>
          <div class="work <?php echo $animationClass;?>" id="work-<?php echo $i+1;?>">
            <a href="<?php  echo $site_url;?>work/<?php echo $row[ 'slug' ];?>">
              <img src="<?php echo $row[ 'img_path' ];?>" alt="<?php echo $row[ 'name' ];?>">
              <span class="sr-only">View <?php echo $row['name']; ?> Info</span>
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
        }?>
      </div>
      <div class="link-strip fade-in fast animated">
        <h2>Do you want to view all of Brandon's work?</h2>
        <a class="btn btn-purple" href="<?php echo $site_url;?>portfolio">View Portfolio</a>
      </div>
    </section>
    <section id="about-section">
      <div class="section-header fade-from-left fast animated" id="about-header">
        <h2>about</h2>
        <div class="underline"></div>
      </div>
      <div class="about-section-text container fade-from-below animated" id="about-text">
        <?php
          $db = DB::connect();
          $query = $db->prepare('SELECT excerpt FROM pages WHERE name = :name');
          $page = 'about';
          $query->bindParam(':name', $page, PDO::PARAM_STR);
          $query->execute();

          $output = $query->fetch(PDO::FETCH_ASSOC);
        ?>
        <p><?php echo $output['excerpt'];?>... <a href="<?php echo $site_url;?>about">Learn more</a></p>
      </div>
      <div class="about-b fade-in animated" id="technologies-used">
        <?php include_once 'includes/technologies-used.php';?>
      </div>
    </section>
<?php include_once 'includes/footer.php';?>
