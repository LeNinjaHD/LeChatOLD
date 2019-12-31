<?php
session_start();
session_destroy();
include("mysql.php");
if(!isset($_SESSION['userid'])) {
    die('Du hast dich bereits abgemeldet!');
}
$userid = $_SESSION['userid'];
$id = $userid;
?>
<html>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Login</title>
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
    <a href="index.php" class="logo">LeChat - Login</a>
      <div class="header-right">
        <a class="active" href="../">Start</a>
        <a href="chat.php">Chat</a>
        <a href="login.php">Login</a>
      </div>
  </div>
