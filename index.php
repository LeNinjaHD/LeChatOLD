<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
?>
<html>
<head>
  <meta charset="utf-8"></meta>
    <title>LeChat - Start</title>
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
  <div class="header">
    <a href="./index.php" class="logo">LeChat - Start</a>
      <div class="header-right">
        <a class="active" href="../">Start</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
      </div>
  </div>
  <h1>Herzlich Wilkommen bei <b>LeChat</b></h1>
  <p>
  <a href="chat.php">Zum Chat</a>
