<?php
session_start();
include("mysql.php");
#error_reporting(0);
if(!isset($_SESSION['userid'])) {
  $logged_in = "false";
} else {
  $userid = $_SESSION['userid'];
  $id = $userid;
  $logged_in = "true";
}
include("langmanager.php");
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
    if($logged_in == "false") {
      echo '<link rel="stylesheet" href="css/light.css">';
    } else {
    if($mode == "Darkmode") {
      echo '<link rel="stylesheet" href="css/header.css">';
    } else { if($mode == "Lightmode") {
      echo '<link rel="stylesheet" href="css/light.css">';
    }}}
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
      die($loginfirst);
  } else {
  ?>
  <h1><?php echo $welcome; ?></h1>
  <p>
  <a href="chat.php"><?php echo $tochat; ?></a>
<?php
}
?>
