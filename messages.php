<?php
error_reporting(0);
include("mysql.php");
$statement = $pdo->prepare("SELECT * FROM messages");
$statement->execute(array());
echo '<div class="list-group">';
while($row = $statement->fetch()) {
  echo '<br><div class="list-group-item active">';
  echo $row['name']." - ".$row['date']."<br>";
  echo $row['msg']."";
  echo '</div>';
}
echo '</div>'
?>
