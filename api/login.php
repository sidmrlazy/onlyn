<?php
// $servername = "localhost";
// $username = "root";
// $database = "onlyn";
// $password = "";

// Production
$servername = "127.0.0.1:3306";
$username = "u976956619_nerdy";
$database = "u976956619_nerdy";
$password = "Darthvader@order66";

// Validate Connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Error 404: " . $connection->connect_error);
}

$json_data = file_get_contents("php://input");
$data = json_decode($json_data);

$user_contact = $data->user_contact; 

// SQL query to check if the user exists
$sql = "SELECT * FROM `user` WHERE `user_contact` = '$user_contact'";
$result = $connection->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Assuming user_contact is retrieved from the database and included in the response
    $row = $result->fetch_assoc();
    $response['statusCode'] = 1;
    $response['message'] = "Login successful";
    $response['user_contact'] = $row['user_contact'];
} else {
    $response['statusCode'] = 0; 
    $response['message'] = "User does not exist in the database";
}

$connection->close();

echo json_encode($response); 
