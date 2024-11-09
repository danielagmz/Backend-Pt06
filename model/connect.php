<!-- Daniela Gamez -->
<?php
$servername = SERVER;
$user_bd = USER_DB;
$pass_bd = PASS_DB;
$DB = DATABASE;

try {
  $conn = new PDO("mysql:host=$servername;dbname=$DB;charset=utf8", $user_bd, $pass_bd);
} catch(PDOException $e) {
  $conn = null;
}

if ($conn == null) {
  echo '<script>alert("No hi ha cap BD conectada");</script>';
  echo '<script>window.location="index.php?page=1";</script>';
}
?>