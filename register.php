<?php
session_start();
include("mysql.php");
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
    <a href="https://localhost/chat/alpha" class="logo">LeChat - Registrieren</a>
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
              echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
              $error = true;
          }
      }

      //Keine Fehler, wir können den Nutzer registrieren
      if(!$error) {
          $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

          $statement = $pdo->prepare("INSERT INTO users (username, passwort) VALUES (?, ?)");
          $result = $statement->execute(array($username, $passwort_hash));

          if($result) {
              echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
              $showFormular = false;
          } else {
              echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
          }
      }
  }

  if($showFormular) {
  ?>

  <form action="?register=1" method="post">
  Username:<br>
  <input type="text" size="40" maxlength="250" name="email"><br><br>

  Dein Passwort:<br>
  <input type="password" size="40"  maxlength="250" name="passwort"><br>

  Passwort wiederholen:<br>
  <input type="password" size="40" maxlength="250" name="passwort2"><br><br>

  <input type="submit" value="Abschicken">
  </form>

  <?php
  } //Ende von if($showFormular)
  ?>

  </body>
  </html>
