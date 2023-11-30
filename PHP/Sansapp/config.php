<?php
$servername = "localhost";
$dbname = "sansapp";
$username = "root";
$password = "";

// Create connection
try {

  $base = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

} catch(PDOException $e) {

  echo "Conexion fallida: " . $e->getMessage() . "<br>";
  die();
  
}
?>