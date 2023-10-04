<?php
// $servername = "localhost";
// $username = "root";
// $database = "onlyn";
// $password = "";

// Production
$servername = "localhost";
$username = "u976956619_onlyn";
$database = "u976956619_onlyn";
$password = "Sid12asthana";

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
$currentLatitude = mysqli_real_escape_string($connection, $data->currentLatitude);
$currentLongitude = mysqli_real_escape_string($connection, $data->currentLongitude);
$empCode = mysqli_real_escape_string($connection, $data->empCode);
$addedBy = mysqli_real_escape_string($connection, $data->addedBy);

$sql = "INSERT INTO `add_shop`(
    `district`,
    `pincode`,
    `dealer_code`,
    `cluster_code`,
    `shop_name`,
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
    '$currentLatitude',
    '$currentLongitude',
    '$empCode',
    '$addedBy'
)";

$response = array();

if ($connection->query($sql) === TRUE) {
    $response['statusCode'] = 1;
    $response['message'] = "Data inserted successfully";
} else {
    $response['statusCode'] = 2;
    $response['message'] = "Error inserting data: " . $connection->error;
}

$connection->close();

echo json_encode($response);
