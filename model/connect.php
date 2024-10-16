<!-- Daniela Gamez -->
<?php
$servername = "localhost";
$user_bd = "root";
$password = "";
$DB = "pt04_daniela_gamez";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$DB", $user_bd, $password);
} catch(PDOException $e) {
  $conn = null;
}

if ($conn == null) {
  echo '<script>alert("No hi ha cap BD conectada");</script>';
}
?>