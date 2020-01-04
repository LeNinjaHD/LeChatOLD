<?php
session_start();
include("mysql.php");
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$id = $userid;
if(isset($_POST['mode'])) {
  $mode = $_POST['mode'];
  $statement = $pdo->prepare("UPDATE settings SET mode = ? WHERE userid = ?");
  $statement->execute(array($mode, $id));
}
if(isset($_POST['lang'])) {
  $lang = $_POST['lang'];
  $statement = $pdo->prepare("UPDATE settings SET lang = ? WHERE userid = ?");
  $statement->execute(array($lang, $id));
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
    $logged_in = "false";
} else {
  $logged_in = "true";
}
require("langmanager.php");
$darkmode = "";
;

?>

<p>
<?php
echo $yoursettings;
echo '<br>';
$statement = $pdo->prepare("SELECT * FROM settings WHERE userid = ?");
$statement->execute(array($id));
while($row = $statement->fetch()) {
   $lang = $row['lang'];
   $mode = $row['mode'];
   if($row['mode'] == "") {
     echo $notset;
   } else {
     echo $display_mode;
     echo $mode;
   }
   echo "<p>";
   echo $language;
   if($row['lang'] == "0") {
     echo "$notset";
   } else {
     echo $lang;
   }
 }
?>
<p>
<form action="?modeform=1" method="post">
  <?php echo $changemode; ?><br>
  <select name="mode">
    <?php
    if($mode == "Lightmode") {
      echo '<option>Darkmode</option>';
      echo '<option>Lightmode</option>';
    } else {
      echo '<option>Lightmode</option>';
      echo '<option>Darkmode</option>';
    }
    ?>
  </select>
  <p>
  <button type="submit" ><?php echo $set; ?></button>
</form>
<p>
<form action="?langform=1" method="post">
  <label><b><?php echo $language; ?></b><br>
  <select name="lang">
    <?php
    if($lang == "de_DE") {
    ?>
    <option value="en_EN"><?php echo $en; ?></option>
    <option value="cs_CZ"><?php echo $cz; ?></option>
    <option value="de_DE"><?php echo $de; ?></option>
    <?php
  } else if($lang == "en_EN") {
    ?>
    <option value="cs_CZ"><?php echo $cz; ?></option>
    <option value="de_DE"><?php echo $de; ?></option>
    <option value="en_EN"><?php echo $en; ?></option>
  <?php } else { ?>
    <option value="de_DE"><?php echo $de; ?></option>
    <option value="en_EN"><?php echo $en; ?></option>
    <option value="cs_CZ"><?php echo $cz; ?></option>
  <?php } ?>
  </select><p>
  <button type="submit"><?php echo $set; ?></button>
</form>
</body>
</html>
