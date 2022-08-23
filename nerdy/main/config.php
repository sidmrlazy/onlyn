<?php
// Production
// $servername = "localhost";
// $username = "u976956619_doctor_moringa";
// $database = "u976956619_doctor_moringa";
// $password = "Darthvader@order66";

// Development
$servername = "localhost";
$username = "root";
$database = "ol_nerdy";
$password = "";

// Validate Connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Error 404: " . $connection->connect_error);
}