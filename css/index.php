<?php
session_start();
include("mysql.php");
error_reporting(0);
if(!isset($_SESSION['userid'])) {
  $logged_in = "false";
} else {
  $userid = $_SESSION['userid'];
  $id = $userid;
}
//Abfrage der Nutzer ID vom Login

?>
<html>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Start</title>
    <?php
    $mode = "";
    $statement = $pdo->prepare("SELECT mode FROM settings WHERE userid = ?");
    $statement->execute(array($id));
    while($row = $statement->fetch()) {
       $mode = $row['mode'];
    }
    if($mode == "Darkmode") {
      echo '<link rel="stylesheet" href="css/header.css">';
    } else {
      echo '<link rel="stylesheet" href="css/light.css">';
    }
    ?>
</head>

<body>
  <div class="header">
    <a href="./index.php" class="logo">LeChat - Start</a>
      <div class="header-right">
        <a class="active" href="../">Start</a>
        <a href="chat.php">Chat</a>
        <a href="login.php">Login</a>
      </div>
  </div>
  <?php
  if($logged_in == "false") {
      die('Bitte zuerst <a href="login.php">einloggen</a>');
  } else {
  ?>
  <h1>Herzlich Wilkommen bei <b>LeChat</b></h1>
  <p>
  <a href="chat.php">Zum Chat</a>
<?php
}
?>
