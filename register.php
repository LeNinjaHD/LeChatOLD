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
    <link href="https://getbootstrap.com/docs/4.5/examples/floating-labels/floating-labels.css" rel="stylesheet">

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
            echo "finished";
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
    <form class="form-signin" method="post" action="?register=1">
  <div class="text-center mb-4">
    <h1 class="h3 mb-3 font-weight-normal">LeChat</h1>
    <p>Here you can create an Account.</p>
  </div>

  <div class="form-label-group">
    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
    <label for="username">Username</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="passwort" id="passwort" class="form-control" placeholder="Password" required>
    <label for="passwort">Password</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="passwort2" id="passwort2" class="form-control" placeholder="Repeat Password" required>
    <label for="passwort2">Repeat Password</label>
  </div>

  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="lang">Language</label>
  </div>
  <select class="custom-select" id="lang" name="lang">
    <option value="de_DE">German</option>
    <option value="en_EN">English</option>
    <option value="cs_CZ">Czech</option>
  </select>
</div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
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
