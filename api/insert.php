<?php
$servername = "localhost";
$username = "root";
$database = "onlyn";
$password = "";

// Validate Connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Error 404: " . $connection->connect_error);
}

$json_data = file_get_contents("php://input");
$data = json_decode($json_data);

$vivoSales = mysqli_real_escape_string($connection, $data->vivoSales);
$samsungSales = mysqli_real_escape_string($connection, $data->samsungSales);
$oppoSales = mysqli_real_escape_string($connection, $data->oppoSales);
$realMeSales = mysqli_real_escape_string($connection, $data->realMeSales);
$otherSales = mysqli_real_escape_string($connection, $data->otherSales);
$counterSize = mysqli_real_escape_string($connection, $data->counterSize);
$totalSales = mysqli_real_escape_string($connection, $data->totalSales);
$whatsappNumber = mysqli_real_escape_string($connection, $data->whatsappNumber);
$managerName = mysqli_real_escape_string($connection, $data->managerName);
$salesBy = mysqli_real_escape_string($connection, $data->salesBy);

$sql = "INSERT INTO sales_data (vivo_sales, samsung_sales, oppo_sales, realme_sales, other_sales, counter_size, total_sales, whatsapp_number, manager_name, sales_data_by) 
        VALUES ('$vivoSales', '$samsungSales', '$oppoSales', '$realMeSales', '$otherSales', '$counterSize', '$totalSales', '$whatsappNumber', '$managerName', '$salesBy')";

if ($connection->query($sql) === TRUE) {
    $response['statusCode'] = 1;
    $response['message'] = "Data inserted successfully";
} else {
    $response['statusCode'] = 2;
    $response['message'] = "Error inserting data: " . $connection->error;
}

$connection->close();

echo json_encode($response); 