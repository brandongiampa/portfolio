<?php include_once 'includes/header.php';?>
<style>
  header {
    border-bottom: 1px var(--primaryColor) solid;
  }
</style>
<div class="hero-image2 fade-in animated">
  <div class="hero-bg-mini" id="hero-work"></div>
  <div class="hero-opaque"></div>
</div>
<div class="container">
  <div class="section-header fade-from-left fast animated">
    <h2>works</h2>
    <div class="underline"></div>
  </div>
  <main class="work-main">
    <?php
      if(isset($_GET['work'])):

        $workName = $_GET['work'];

        $DB = DB::connect();

        try{
          $query = $DB->prepare("SELECT * FROM project WHERE link = :workName LIMIT 1");
          $query->bindParam(':workName', $workName, PDO::PARAM_STR);
          $query->execute();

          if($query->rowCount() < 1){
            echo 'Project not found. ' . ($_GET['work']);
          }

          $row = $query->fetch(PDO::FETCH_ASSOC);

          $workId = $row['id'];
          $tagline = $row['tagline'];
          $img_path = $row['img_path'];
          $url = $row['url'];
          $link = 'https://brandongiampa.com/' . $row['link'];
          $github = $row['github'];
          $img = $site_url . 'img/' . $row['img'];
          $objective = $row['objective'];

          $hashtags = $query->fetch(PDO::FETCH_ASSOC);

          $query = $DB->prepare('SELECT name FROM features WHERE project_id = :workid');
          $query->bindParam(':workid', $workId, PDO::PARAM_INT);
          $query->execute();

          $features = $query->fetch(PDO::FETCH_ASSOC);

          $query = $DB->prepare('SELECT name FROM technologies WHERE project_id = :workid');
          $query->bindParam(':workid', $workId, PDO::PARAM_INT);
          $query->execute();

          $technologies = $query->fetch(PDO::FETCH_ASSOC);?>

          <div class="img-carousel fade-from-left animated">
            <div class="img-carousel-wrap">
              <img src="<?php echo $img_path;?>" alt="">
            </div>
          </div>
          <div class="work-description fade-in fast animated">
            <h6>
              <?php
              $query = $DB->prepare('SELECT name FROM hashtags WHERE project_id = :workid');
              $query->bindParam(':workid', $workId, PDO::PARAM_INT);
              $query->execute();

              while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo $row['name'] . ' ';
              }
              ?>
            </h6>
            <h1><?php echo $workName;?></h1>
            <div class="underline"></div>
            <h3><?php echo $tagline;?></h3>
            <div class="work-display-links">
              <a href="<?php echo $link;?>"><i class="fas fa-eye"></i> <span class="site-link">View Site</span></a>
              <a href="<?php echo $github;?>" class="repo-link"><i class="fab fa-github"></i> Github</a>
            </div>
            <p><span class="description-header">Description:</span>
              <br><?php echo $objective;?></p>
          </div>
          <div class="fade-in fast animated" id="features-and-technologies">
            <div id="features" class="work-ul fade-from-left animated">
              <h3>Features</h3>
              <ul>
                <?php
                $query = $DB->prepare('SELECT name FROM features WHERE project_id = :workid');
                $query->bindParam(':workid', $workId, PDO::PARAM_INT);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  echo '<li>' . $row['name'] . '</li>';
                }
                ?>
              </ul>
            </div>
            <div id="technologies" class="work-ul fade-from-right animated">
              <h3>Tech</h3>
              <ul>
                <?php
                $query = $DB->prepare('SELECT name FROM technologies WHERE project_id = :workid');
                $query->bindParam(':workid', $workId, PDO::PARAM_INT);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  echo '<li>' . $row['name'] . '</li>';
                }
                ?>
              </ul>
            </div>
          </div>
        <?php
        }
        catch(PDOException $ex){
          echo 'There was an error accessing the database.  Please try again later. <br>';
          echo $ex->getMessage();
        }?>

        <?php
    ?>
    <div class="back-to-portfolio fade-in fast animated">
      <a class="btn btn-purple" href="<?php  echo $site_url;?>portfolio">&larr; Back to Portfolio</a>
    </div>
    <?php
  else:
    echo "Project not found.";
  endif;
    ?>
  </main>
</div>
<?php include_once 'includes/footer.php';?>
