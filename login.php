<?php
session_start();
include("mysql.php");
?>
<html>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Login</title>
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
  <div class="header">
    <a href="https://localhost/chat/alpha" class="logo">LeChat - Start</a>
      <div class="header-right">
        <a class="active" href="../">Start</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
      </div>
  </div>
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
<form action="?login=1" method="post">
Username:<br>
<input type="text" size="40" maxlength="250" name="username"><br><br>

Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>

<input type="submit" value="Abschicken">
</form>
</body>
</html>
