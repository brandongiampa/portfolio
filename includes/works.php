<?php isset( $porto_is_allowed ) ? false : die( "You do not have authorization to view this page." ); ?>

<?php

$works = array();

$work1 = array(
  'description-link' => 'work.php?work=spartacus-tile',
  'img' => 'spartacuspc.png',
  'site-link' => 'https://brandongiampa.com/spartacus-tile',
  'github-link' => 'https://github.com'
);

$work2 = array(
  'description-link' => 'work.php?work=seafarer-grille',
  'img' => 'seafarerpc.png',
  'site-link' => 'https://brandongiampa.com/seafarer-grille',
  'github-link' => 'https://github.com'
);

$works[] = $work1;
$works[] = $work2;

for ($i = 0; $i < sizeof($works); $i++){?>
  <div class="work" id="work-<?php echo $i+1;?>">
    <a href="<?php echo $works[$i]['description-link'];?>">
      <img src="img/<?php echo $works[$i]['img'];?>" alt="">
    </a>
    <div class="work-overlay">
      <div class="work-links">
        <a href="<?php echo $works[$i]['description-link'];?>" class="btn"><i class="fas fa-info-circle"></i>About</a>
        <a href="<?php echo $works[$i]['github-link'];?>" class="btn"><i class="fab fa-github"></i>Github</a>
        <a href="<?php echo $works[$i]['site-link'];?>" class="btn"><i class="fas fa-eye"></i>View</a>
      </div>
    </div>
  </div>
<?php
}
?>
