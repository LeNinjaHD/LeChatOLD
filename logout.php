<?php
session_start();
session_destroy();
include("mysql.php");
header("location: ./");
?>