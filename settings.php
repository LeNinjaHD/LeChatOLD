<?php
session_start();
require("mysql.php");
//Abfrage der Nutzer ID vom Login
if(!isset($_SESSION['userid'])) {
  $logged_in = "false";
  die('PLEASE <a href="login.php">LOGIN</a> FIRST!');
} else {
  $logged_in = "true";
  $userid = $_SESSION['userid'];
  $id = $userid;
}
if(isset($_POST['mode'])) {
  $mode = $_POST['mode'];
  $statement = $pdo->prepare("UPDATE settings SET mode = ? WHERE userid = ?");
  $statement->execute(array($mode, $id));
}
if(isset($_POST['lang'])) {
  $lang = $_POST['lang'];
  $statement = $pdo->prepare("UPDATE settings SET lang = ? WHERE userid = ?");
  $statement->execute(array($lang, $id));
  $sucess = true;
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>LeChat</title>

    <!-- Bootstrap-CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Besondere Stile für diese Vorlage -->
    <style>
      /* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}


/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

body > .container {
  padding: 60px 15px 0;
}
.container .text-muted {
  margin: 20px 0;
}

.footer > .container {
  padding-right: 15px;
  padding-left: 15px;
}

code {
  font-size: 80%;
}
body {
  /*padding-top: 40px;*/
  padding-bottom: 40px;
  /*background-color: #eee;*/
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

    <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="./">LeChat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chat.php">Chat</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="settings.php"><?php echo $settings;?></a>
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu" aria-labelledby="dropdown09">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php
          if($logged_in == "true") {
          ?>
          <li class="nav-item"><a href="settings.php" class="nav-link"><span class="glyphicon glyphicon-user"></span> Account</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link"><span class="glyphicon glyphicon-log-out"></span> Abmelden</a></li>
          <?php
          } else {
          ?>
          <li class="nav-item"><a href="register.php" class="nav-link"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>
          <li class="nav-item"><a href="login.php" class="nav-link"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php
          }
          ?>
      </ul>
    </div>
  </nav>
    <div class="container">
      <div class="jumbotron">
        <button onclick="window.location.href='chat.php'" class="btn btn-sm btn-info" title="Back to Chat!"><span class="glyphicon glyphicon-triangle-left"></span></button>
        <p>
          <?php
          if(isset($sucess)) {
          if($success) {
            echo '<div class="alert alert-success" role="alert"><a href="chat.php"><b>Fertig!</b> Du kannst nun zum Chat zurückkehren!</a></div><p>';
          } else {

          }
        }
          ?>
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
  <select name="mode" disabled>
    <option>THIS IS CURRENTLY NOT AVAILABLE!</option>
    <?php
    #if($mode == "Lightmode") {
      #echo '<option>Darkmode</option>';
      #echo '<option>Lightmode</option>';
    #} else {
      #echo '<option>Lightmode</option>';
      #echo '<option>Darkmode</option>';
    #}
    ?>
  </select>
  <p>
  <!--<button type="submit" ><?php #echo $set; ?></button>-->
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
  <button type="submit" class="btn btn-primary"><?php echo $set; ?></button>
</form>
</div>
</div>
<!-- Bootstrap-JavaScript
================================================== -->
<!-- Am Ende des Dokuments platziert, damit Seiten schneller laden -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
<footer class="footer">
      <div class="container">
        <p class="text-muted">&copy; <a href="https://www.spigotmc.org/resources/authors/leninjahd.698627/">LeNinjaHD</a>, 2020</p>
      </div>
  </footer>
</body>
</html>
