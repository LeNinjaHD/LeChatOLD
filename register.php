<?php
session_start();
include("mysql.php");
?>
<html>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Login</title>
    <link rel="stylesheet" href="css/light.css">
</head>

<body>
  <div class="header">
    <a href="index.php" class="logo">LeChat - Registrieren</a>
      <div class="header-right">
        <a class="active" href="../">Start</a>
        <a href="chat.php">Chat</a>
        <a href="login.php">Login</a>
      </div>
  </div>
  <?php
  $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

  if(isset($_GET['register'])) {
      $error = false;
      $username = $_POST['email'];
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

  <form action="?register=1" method="post">
  Username:<br>
  <input type="text" size="40" maxlength="250" name="email"><p>
  Dein Passwort:<br>
  <input type="password" size="40"  maxlength="250" name="passwort"><br>
  Passwort wiederholen:<br>
  <input type="password" size="40" maxlength="250" name="passwort2"><p>
  Sprache/Language:<br>
  <select name="lang">
    <option value="de_DE">Deutsch/German</option>
    <option value="en_EN">Englisch/English</option>
    <option value="cs_CZ">Tschechisch/Czech</option>
  </select><p>
  <input type="submit" value="Abschicken">
  </form>

  <?php
  } //Ende von if($showFormular)
  ?>

  </body>
  </html>
