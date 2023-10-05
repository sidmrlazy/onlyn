<?php
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

$sql = "SELECT * FROM `add_shop`";

$response = array();

$result = $connection->query($sql);

if ($result !== false) {
    if ($result->num_rows > 0) {
        $response['statusCode'] = 1;
        $response['message'] = "Data fetched successfully";
        $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $response['statusCode'] = 2;
        $response['message'] = "No data found";
    }
} else {
    $response['statusCode'] = 3;
    $response['message'] = "Error fetching data: " . $connection->error;
}

$connection->close();

echo json_encode($response);
?>
