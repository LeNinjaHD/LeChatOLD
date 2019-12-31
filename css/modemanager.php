<?php
include("mysql.php");
$userid = $_SESSION['userid'];
$id = $userid;
$mode = "";
function getmode() {
  include("mysql.php");
  $statement = $pdo->prepare("SELECT mode FROM settings WHERE userid = ?");
  $statement->execute(array($id));
  while($row = $statement->fetch()) {
     $mode = $row['mode'];
  }
}
?>
