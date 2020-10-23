<?php
session_start();
$userid = "";
$id = "";
$username = "";
//Abfrage der Nutzer ID vom Login
if(!isset($_SESSION['userid'])) {
    $logged_in = "false";
} else {
  $logged_in = "true";
  $userid = $_SESSION['userid'];
  $id = $userid;
}
include("langmanager.php");


error_reporting(E_ERROR | E_PARSE | E_NOTICE);
include('mysql.php');
#$_SESSION['name'] = $_POST['name'];
if($logged_in == true) {
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
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="./">LeChat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./">Home</a>
        </li>
        <li class="nav-item active">
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

      </div><!--/.nav-collapse -->
    </div>
  </nav>
</div>
<?php
#if(isset($_SESSION['name'])) {
?>
<p>
  <div class="container">
  <?php 
  if($logged_in == false) {
    echo "<h1>" .$loginfirst ."</h1>";
  }
  ?>
  <div class="jumbotron">
  <!--<a class='btn btn-default btn-sm' href='javascript:;' onCLick="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});" onLoad="$.ajax({url: './messages.php', type: 'GET', success: function(data){$('.messages').html(data);}});"><?php echo $loadmsg; ?></a>
  <br> -->
  <h2>Chat <a href="settings.php"><svg width="0.75em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
</svg></a></h2>
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
      <button type="submit" value="Senden" class="btn btn-success" onCLick="getMSG();"><?php echo $send; ?></button>
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
<footer class="footer mt-auto py-3">
  <div class="container">
        <p class="text-muted">&copy; <a href="https://www.spigotmc.org/resources/authors/leninjahd.698627/">LeNinjaHD</a>, 2020</p>
      </div>
  </footer>
</body>
</html>
