<?php
echo "<!-- langmanager -->";
include("mysql.php");
if(isset($logged_in)) {
if($logged_in == "false") {
  include("languages/de_DE.php");
} else {
$sql = "SELECT lang FROM settings WHERE userid=$userid;";
foreach ($pdo->query($sql) as $row) {
  $langintern = $row['lang'];
  if($langintern == "de_DE") {
    include("languages/de_DE.php");
  } else if($langintern == "en_EN") {
    include("languages/en_EN.php");
  } else if($langintern == "cs_CZ") {
    include("languages/cs_CZ.php");
  }
}
}
}
?>
