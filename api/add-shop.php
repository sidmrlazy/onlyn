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

$district = mysqli_real_escape_string($connection, $data->district);
$pincode = mysqli_real_escape_string($connection, $data->pincode);
$dealerCode = mysqli_real_escape_string($connection, $data->dealerCode);
$clusterCode = mysqli_real_escape_string($connection, $data->clusterCode);
$shopName = mysqli_real_escape_string($connection, $data->shopName);
$shopNumber = mysqli_real_escape_string($connection, $data->shopNumber);
$currentLatitude = mysqli_real_escape_string($connection, $data->currentLatitude);
$currentLongitude = mysqli_real_escape_string($connection, $data->currentLongitude);
$empCode = mysqli_real_escape_string($connection, $data->empCode);
$addedBy = mysqli_real_escape_string($connection, $data->addedBy);

// Check if shopNumber already exists
$checkQuery = "SELECT * FROM `add_shop` WHERE `shop_number` = '$shopNumber'";
$result = $connection->query($checkQuery);

if ($result->num_rows > 0) {
    // Shop number already exists, return error response
    $response['statusCode'] = 3;
    $response['message'] = 'Retailer is already registered';
} else {
    // Shop number doesn't exist, proceed with insertion
    $sql = "INSERT INTO `add_shop`(
        `district`,
        `pincode`,
        `dealer_code`,
        `cluster_code`,
        `shop_name`,
        `shop_number`,
        `latitude`,
        `longitude`,
        `emp_code`,
        `added_by`
    )
    VALUES(
        '$district',
        '$pincode',
        '$dealerCode',
        '$clusterCode',
        '$shopName',
        '$shopNumber',
        '$currentLatitude',
        '$currentLongitude',
        '$empCode',
        '$addedBy'
    )";

    if ($connection->query($sql) === TRUE) {
        $response['statusCode'] = 1;
        $response['message'] = "Retailer Added";
    } else {
        $response['statusCode'] = 2;
        $response['message'] = "Error inserting data: " . $connection->error;
    }
}

$connection->close();

echo json_encode($response);
