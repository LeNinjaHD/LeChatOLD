<?php
session_start();
include("mysql.php");
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
  background-color: #eee;
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

    <!-- Fixierte Navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navigation ein-/ausblenden</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">LeChat</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse ">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Start</a></li>
            <li><a href="chat.php">Chat</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mehr <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Schnellzugriffsleiste</li>
                <li><a href="settings.php"><span class="glyphicon glyphicon-wrench"></span> Einstellungen</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Weiteres</li>
                <li><a href="https://github.com/LeNinjaHD/LeChat">GitHub Repository von LeChat</a></li>
                <li><a href="https://www.spigotmc.org/resources/73863/">SpigotMC Seite von LeChat</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>
            <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  <?php
if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :name");
    $result = $statement->execute(array('name' => $username));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zum <a href="chat.php">Chat</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>
  <?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
<div class="container">
<form class="form-signin" action="?login=1" method="post">
<input type="text" size="40" maxlength="250" name="username" class="form-control" placeholder="Username">
<input type="password" size="40"  maxlength="250" name="passwort" class="form-control" placeholder="Passwort"><br>

<button class="btn btn-lg btn-primary btn-block" type="submit">Absenden <span class="glyphicon glyphicon-send"></span></button>
</form>
</div>
<p><center>
Hast du noch keinen Account? <form action="register.php"><button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-user"></span> Registrieren</button></form></center>
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
