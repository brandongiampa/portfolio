<?php
  try{
    include_once 'database/db.php';
  }
  catch(Exception $ex){
    echo "Unfortunately, an error occurred.";
  }
?>
<?php
try{
    $db = DB::connect();
    $query = $db->prepare("SELECT * FROM tbl_languages_and_technologies ORDER BY priority, id");
    $query->execute();
?>

  <h3>Technologies Used</h3>
  <div class="technologies">
    <?php
      while($row = $query->fetch(PDO::FETCH_ASSOC)):
        extract($row);
    ?>
    <div class="technology">
      <img src="icons/<?php echo $icon;?>" alt=""><br>
      <?php echo $name;?>
    </div>
    <?php
      endwhile;
    ?>
  </div>
<?php
}
catch(PDOException $ex){
  echo "Error Connecting: " . $ex->getMessage();
}
