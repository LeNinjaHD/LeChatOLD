<?php
session_start();
//Abfrage der Nutzer ID vom Login
if(!isset($_SESSION['userid'])) {
    die("<b>PLEASE LOGIN FIRST!");
    $logged_in = "false";
} else {
  $logged_in = "true";
  $userid = $_SESSION['userid'];
  $id = $userid;
}
include("langmanager.php");


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
.messages {
  font-size: 18px;
}
body {
  /*padding-top: 40px;*/
  padding-bottom: 40px;
  /*background-color: #eee;*/
  margin-bottom: 60px;
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
.send {
    border: solid 1px green;
    position: relative;
}
.send input[type=text] {
    border: none;
    width: 100%;
    padding-right: 123px;
}
.input-group-prepend {
  position: absolute;
  right: 6px;
  top: 50%;
  transform: translateY(-50%);
}
</style>

  <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
    <script>
        window.onload = function () {
          $.get('messages.php', function(data){
              $("#msg").html(data);
          });
        }
        $(function(){
          setInterval (function() {
            $.get('messages.php', function(data){
                $("#msg").html(data);
            });
          }, 5000);
        })
        function getMSG() {
          $.get('messages.php', function(data){
              $("#msg").html(data);
          });
        }
    </script>
</head>
<body>
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
          <li class="active"><a href="chat.php">Chat</a></li>
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
          <?php
          if($logged_in == "true") {
          ?>
          <li><a href="settings.php"><span class="glyphicon glyphicon-user"></span> Account</a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Abmelden</a></li>
          <?php
          } else {
          ?>
          <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php
          }
          ?>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
</div>
<?php
#if(isset($_SESSION['name'])) {
?>
<p>
  <div class="container">
  <div class="jumbotron">
  <!--<a class='btn btn-default btn-sm' href='javascript:;' onCLick="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" onLoad="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});"><?php echo $loadmsg; ?></a>
  <br> -->
  <a href="settings.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo $settings; ?></a>
  <p>
  <div class="container messages" id="msg"></div>
  <p>
    <br>
    <div class="container">
      <center>
    <form action="?msg=1" method="post">
      <div class="col-lg-6">
      <div class="input-group">
      <input type="text" class="form-control" name="msg" id="msg" minlength="1" maxlength="200" required placeholder="Message">
      <span class="input-group-btn">
      <button type="submit" value="Senden" class="btn btn-default" onCLick="getMSG();"><?php echo $send; ?> <span class=" glyphicon glyphicon-send"></span></button>
    </span>
  </div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
    </form>
    </center>
  </div>
</div>
</div>
</div>
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
