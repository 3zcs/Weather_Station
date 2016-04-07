<?php
function getDB() {
$dbhost="localhost";
$dbuser="saleh_team";
$dbpass="Saleh123";
$dbname="weather_station";
$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser,$dbpass); 
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $dbConnection;
}
?>
