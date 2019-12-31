<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
include("modemanager.php");
#error_reporting(0);
include('mysql.php');
  #$_SESSION['name'] = $_POST['name'];
  $sql = 'SELECT username FROM users WHERE id = '.$userid .';';
  foreach ($pdo->query($sql) as $row) {
    $username = $row['username'];
  }
$name = $username;
if(isset($_GET['msg'])) {
  $msg = $_POST['msg'];
  $statement = $pdo->prepare("INSERT INTO messages (name, msg) VALUES (?,?)");
  $statement->execute(array($name, $msg));
}
?>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Start</title>
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

    <script type='text/javascript' src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
    <script>
      window.onload = function () {
        $.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});
      }
    </script>
</head>
<body>
  <div class="header">
  <a href="index.php" class="logo">LeChat - Chat</a>
  <div class="header-right">
  <a class="active" href="../">Start</a>
  <a href="chat.php">Chat</a>
  <a href="login.php">Login</a>
  </div>
</div>
<?php
#if(isset($_SESSION['name'])) {
?>
<p>
  <a class='btn btn-default btn-sm' href='javascript:;' onCLick="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" onLoad="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});">Nachrichten laden</a>
  <br>
  <a href="settings.php">Einstellungen</a>
  <p>
  <div class="messages"></div>
  <p>
    <br>
    <form action="?msg=1" method="post">
      <input type="text" name="msg" id="msg" class="msg" minlength="3" maxlength="200" required></input>
      <button type="submit" value="Senden" onCLick="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" onLoad="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" >Senden</button>
    </form>
<?php
/*} else {
  ?>
  <form action="#" method="post">
    Username: <input type="text" name="name" id="name" minlength="3" maxlength="10" required></input>
    <button type="submit">SENDEN</button>
  </form>
  <?php
}*/
?>
