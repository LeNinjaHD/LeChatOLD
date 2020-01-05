<?php
session_start();
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
              <li class="active"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>
              <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
<?php
include("mysql.php");
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $username = $_POST['username'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $lang = $_POST['lang'];

    /*if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }*/
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();

        if($user !== false) {
            echo "<b>This username is already taken! Please choose another one.</b><p>";
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (username, passwort) VALUES (?, ?)");
        $result = $statement->execute(array($username, $passwort_hash));



        if($result) {
            $statement = $pdo->prepare("SELECT * FROM users WHERE username = :name");
            $result = $statement->execute(array('name' => $username));
            $user = $statement->fetch();
            $_SESSION['userid'] = $user['id'];
            $userid = $_SESSION['userid'];
            include("langmanager.php");
            echo $finished;
            $showFormular = false;
            $statement = $pdo->prepare("INSERT INTO settings (userid, mode, lang) VALUES (?, ?, ?)");
            $result = $statement->execute(array($userid, 'Lightmode', $lang));
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
?>
    <div class="container">

      <form class="form-signin" action="?register=1" method="post">
        <h2 class="form-signin-heading">Bitte registriere dich!</h2>
        <label for="username" class="sr-only">Benutzername</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Benutzername" required autofocus>
        <label for="eingabefeldPasswort" class="sr-only">Passwort</label>
        <input type="password" id="eingabefeldPasswort" name="passwort" class="form-control" placeholder="Passwort" required >
        <label for="eingabefeldPasswort2" class="sr-only">Passwort wiederholen</label>
        <input type="password" id="eingabefeldPasswort2" name="passwort2" class="form-control" placeholder="Passwort wiederholen" required>
        <select name="lang" class="form-control">
          <option value="de_DE">Deutsch/German</option>
          <option value="en_EN">Englisch/English</option>
          <option value="cs_CZ">Tschechisch/Czech</option>
        </select><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrieren <span class="glyphicon glyphicon-send"></span></button>
      </form>
      <?php
      } //Ende von if($showFormular)
      ?>
    </div> <!-- /container -->

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
