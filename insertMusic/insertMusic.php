<?php
    // Inclusion de la classe
    function chargerclasses($class){
        require("../dao/".$class.".class.php");
    }
    spl_autoload_register('chargerclasses');
    require '../config.php';

    $mgt = new BDDmusicManager(HOST,DBNAME,USER,PASSWORD);
    $mgt->connect();
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Insert music - Music Events</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
  <script src="../content/js/jquery-1.7.1.min.js"></script>
  <script src="../content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
  <div data-role="page">
    <div data-role="header"><h1>Insert Music</h1></div>
    <div data-role="main" class="ui-content">
      <form action="insertTraitmentMusic.php" method="GET" data-ajax="false">
        <div class="ui-field-contain">
          <select name="select_genre" id="select_genre" data-native-menu="false">
              <option value="0">Choose your genre</option>
                <?php 
                  $genreList = $mgt->readGenre();
                  foreach ($genreList as $genre_id => $resultat) {
                ?>
                  <option value="<?php echo $resultat->genre_id; ?>"><?php echo $resultat->genre_label; ?></option>
                <?php } ?>
          </select>
          <br>
          <select name="select_mood" id="select_mood" data-native-menu="false">
              <option value="0">Choose your mood</option>
                <?php 
                  $moodList = $mgt->readMood();
                  foreach ($moodList as $mood_id => $resultat) {
                ?>
                  <option value="<?php echo $resultat->mood_id; ?>"><?php echo $resultat->mood_label; ?></option>
                <?php } ?>
          </select>
        </div>
        <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Insert</button>
      </form>
    </div>
  </div>
</body>
</html>