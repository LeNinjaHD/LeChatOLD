<?php
session_start();
include("mysql.php");
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$id = $userid;
if(isset($_GET['modeform'])) {
  $mode = $_POST['mode'];
  $statement = $pdo->prepare("INSERT INTO settings (userid, mode) VALUES (?, ?)");
  $statement->execute(array($id, $mode));
}
?>
<html>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Einstellungen</title>
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
    <a href="index.php" class="logo">LeChat - Einstellungen</a>
      <div class="header-right">
        <a class="active" href="../">Start</a>
        <a href="chat.php">Chat</a>
        <a href="login.php">Login</a>
      </div>
  </div>
  <?php
  if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
$darkmode = "";
;

?>

<p>
<b>Deine Einstellungen:</b><br>
<?php
$statement = $pdo->prepare("SELECT * FROM settings WHERE userid = ?");
$statement->execute(array($id));
while($row = $statement->fetch()) {

   $mode = $row['mode'];
   echo 'Anzeige-Modus: '.$mode;
   if($row['mode'] == "") {
     echo"KEINE EINSTELLUNG GESETZT!";
   }
 }


?>
<p>
<form action="?modeform=1" method="post">
  <b>Anzeige-Modus ändern:</b><br>
  <select name="mode">
    <option>Darkmode</option>
    <option>Lightmode</option>
  </select>
  <p>
  <button type="submit" value="Einstellen">Einstellen</button>
</form>
