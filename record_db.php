<?php
$action = $_GET['action'];

$conn = pg_connect('host=localhost port=5432 dbname=himm_record user=dodo password=net123') or die('Could not connect: ' . pg_last_error());

if ($action == "firstLoad") {
  $sql = "select * from record order by score, whattime";
}

$result = pg_query($conn, $sql);

if ($result) {
  echo '<div class="mainBody-gridMain">';

  $rowCount = pg_num_rows($result);

  if (pg_num_rows($result) > 0) {
    $limit = ($rowCount > 5) ? 5 : $rowCount;

    for ($i = 0; $i < $limit; $i++) {
      $row = pg_fetch_assoc($result);

      echo '<div class="mainBody-gridMain-item">';
        if ($i == 0) {
          echo '<p class="item-ranking first-rank">' . ($i + 1) . '</p>';
        } elseif ($i == 1) {
          echo '<p class="item-ranking second-rank">' . ($i + 1) . '</p>';
        } else {
          echo '<p class="item-ranking">' . ($i + 1) . '</p>';
        }
        echo '<p class="item-score">' . $row['score'] . '</p>';
        //  echo '<p class="item-name">' . $row['name'] . '</p>';
	$name = $row['name'];
	if (mb_strlen($name) > 2) {
    	  $firstChar = mb_substr($name, 0, 1);
    	  $lastChar = mb_substr($name, -1);
    	  $maskedName = $firstChar . str_repeat('*', mb_strlen($name) - 2) . $lastChar;
	} else {
    	  $maskedName = $name;
	}
        echo '<p class="item-name">' . $maskedName . '</p>';
	if ($i < 2) {
	  echo '<img class="item-icon gift" src="gift.png">';
	} else {
	  echo '<img class="item-icon" src="fail.png">';
	}
      echo '</div>';
    }
  }
  echo '</div>';
}


?>
