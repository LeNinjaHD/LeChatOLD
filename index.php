<?php
session_start();
error_reporting(0);
include('mysql.php');
if(isset($_POST['name'])) {
  $_SESSION['name'] = $_POST['name'];
  $name = $_SESSION['name'];
}
$name = $_SESSION['name'];
if(isset($_GET['msg'])) {
  $msg = $_POST['msg'];
  $statement = $pdo->prepare("INSERT INTO messages (name, msg) VALUES (?,?)");
  $statement->execute(array($name, $msg));
}
?>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Start</title>
    <link rel="stylesheet" href="css/header.css">
    <script type='text/javascript' src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
    <script>
      window.onload = function () {
        $.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});
      }
    </script>
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
if(isset($_SESSION['name'])) {
?>
<p>
  <a class='btn btn-default btn-sm' href='javascript:;' onCLick="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" onLoad="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});">Nachrichten laden</a>
  <p>
  <div class="messages"></div>
  <p>
    <br>
    <form action="?msg=1" method="post">
      <input type="text" name="msg" id="msg" class="msg" minlength="3" maxlength="200" required></input>
      <button type="submit" value="Senden" onCLick="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" onLoad="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" >Senden</button>
    </form>
<?php
} else {
  ?>
  <form action="#" method="post">
    Username: <input type="text" name="name" id="name" minlength="3" maxlength="10" required></input>
    <button type="submit">SENDEN</button>
  </form>
  <?php
}
?>
