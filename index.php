<?php
  include_once 'database/db.php';

  $DB = DB::connect();

  $upperLimit = 4;
  $projectMessage = '';

  try{
    $query = $DB->prepare(
      'SELECT id, name, link, github, img FROM project ORDER BY id DESC LIMIT :limit'
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

<?php include_once 'includes/header.php';?>
    <div class="hero-image fade-in animated">
      <div class="hero-bg"></div>
      <div class="hero-opaque"></div>
      <div class="hero-text">
        <h1>Do you need a website?</h1>
        <p>Look no further.</p>
        <div class="hero-links">
          <a href="#portfolio-section" class="btn btn-blue">Learn More</a>
          <a href="portfolio.php" class="btn btn-purple">Skip to Portfolio &raquo;</a>
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
            <a href="http://linkedin.com/brandongiampa"><i class="fab fa-linkedin"></i></a>
            <a href="http://github.com/brandongiampa"><i class="fab fa-github"></i></a>
          </div>
        </div>
        <div class="profile-img-div fade-from-right animated">
          <img src="img/face.jpg" class="profile-img" alt="">
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
            <a href="work.php?work=<?php echo $row['link'];?>">
              <img src="img/<?php echo $row['img'];?>" alt="">
            </a>
            <div class="work-overlay">
              <div class="work-links">
                <a href="work.php?work=<?php echo $row['link'];?>" class="btn"><i class="fas fa-info-circle"></i>About</a>
                <a href="<?php echo $row['github'];?>" class="btn"><i class="fab fa-github"></i>Github</a>
                <a href="https://brandongiampa.com/<?php echo $row['link'];?>" class="btn"><i class="fas fa-eye"></i>View</a>
              </div>
            </div>
          </div>
        <?php
          $i++;
        }?>
      </div>
      <div class="link-strip fade-in fast animated">
        Do you want to view all of Brandon's work?
        <a href="portfolio.php">View Portfolio</a>
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
        <p><?php echo $output['excerpt'];?>... <a href="about.php">Learn more</a></p>
      </div>
      <div class="about-b fade-in animated" id="technologies-used">
        <?php include_once 'includes/technologies-used.php';?>
        <!--
        <h3>Technologies Used</h3>
        <div class="technologies">
          <div class="technology"><i class="fab fa-html5"></i><br> HTML5</div>
          <div class="technology"><i class="fab fa-css3-alt"></i><br> CSS3</div>
          <div class="technology"><i class="fab fa-js-square"></i><br> Javascript</div>
          <div class="technology"><i class="fab fa-php"></i><br> PHP</div>
          <div class="technology"><i class="fas fa-database"></i><br> mySQL</div>
          <div class="technology"><i class="fab fa-wordpress"></i><br> WordPress</div>
          <div class="technology"><i class="fab fa-bootstrap"></i><br> Bootstrap</div>
          <div class="technology"><i class="fab fa-sass"></i><br> Sass</div>
          <div class="technology"><i class="fab fa-git"></i><br> Git</div>
        </div>-->
      </div>
    </section>
<?php include_once 'includes/footer.php';?>
