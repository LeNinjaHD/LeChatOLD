<?php
session_start();
require("mysql.php");
if(!isset($_SESSION['userid'])) {
  $logged_in = "false";
} else {
  $userid = $_SESSION['userid'];
  $id = $userid;
  $logged_in = "true";
}
include("langmanager.php");
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
        <li class="nav-item active">
          <a class="nav-link" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chat.php">Chat</a>
        </li>
        <li class="nav-item">
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


    <!-- Seiteninhalt -->
    <div class="container">
      <div class="page-header">
        <h1><?php
        if($logged_in == "false") {
            die($loginfirst);
        } else {
        ?>Wilkommen Bei <b>LeChat!</b></h1>
      </div>
      <div class="jumbotron">
      <p class="lead">Installationsanleitung:</p>
        <p class="container lead">Importiere die db.sql in deine Datenbank.<br> Stelle nun die mysql.php ein. <br><b>FERTIG!</b></p>
      </div>
    </div>

    <?php
    }
    ?>
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
