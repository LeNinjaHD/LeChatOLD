<?php
error_reporting(0);
include("mysql.php");
$statement = $pdo->prepare("SELECT * FROM messages");
$statement->execute(array());
while($row = $statement->fetch()) {
  echo $row['name']." - ".$row['date']."<br />";
  echo $row['msg']."<p>";
}
?>
