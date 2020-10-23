<?php
error_reporting(0);
include("mysql.php");
$statement = $pdo->prepare("SELECT * FROM messages");
$statement->execute(array());
while($row = $statement->fetch()) {
  echo '<br><div class="card" style=""><div class="card-body">';
  echo '<h5 class="card-title">' .$row['name'].'</h5> <h6 class="card-subtitle mb-2 text-muted">'.$row['date'].'</h6>';
  echo '<p class="card-text">' .$row['msg'].'</p>';
  echo '</div></div>';
}
?>
