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

$vivoSales = mysqli_real_escape_string($connection, $data->vivoSales);
$samsungSales = mysqli_real_escape_string($connection, $data->samsungSales);
$oppoSales = mysqli_real_escape_string($connection, $data->oppoSales);
$realMeSales = mysqli_real_escape_string($connection, $data->realMeSales);
$miSales = mysqli_real_escape_string($connection, $data->miSales);
$honorSales = mysqli_real_escape_string($connection, $data->honorSales);
$otherSales = mysqli_real_escape_string($connection, $data->otherSales);
// $counterSize = mysqli_real_escape_string($connection, $data->counterSize);
$totalSales = mysqli_real_escape_string($connection, $data->totalSales);
$whatsappNumber = mysqli_real_escape_string($connection, $data->whatsappNumber);
$managerName = mysqli_real_escape_string($connection, $data->managerName);
$selectedShop = mysqli_real_escape_string($connection, $data->selectedShop);
$salesBy = mysqli_real_escape_string($connection, $data->salesBy);

$sql = "INSERT INTO sales_data (
    vivo_sales, 
    samsung_sales, 
    oppo_sales, 
    realme_sales, 
    mi_sales, 
    honor_sales, 
    other_sales, 
    total_sales, 
    whatsapp_number, 
    manager_name, 
    selected_shop, 
    sales_data_by) 
        VALUES (
            '$vivoSales', 
            '$samsungSales', 
            '$oppoSales', 
            '$realMeSales',
            '$miSales', 
            '$honorSales', 
            '$otherSales', 
            '$totalSales', 
            '$whatsappNumber', 
            '$managerName', 
            '$selectedShop', 
            '$salesBy')";

if ($connection->query($sql) === TRUE) {
    $response['statusCode'] = 1;
    $response['message'] = "Data inserted successfully";
} else {
    $response['statusCode'] = 2;
    $response['message'] = "Error inserting data: " . $connection->error;
}

$connection->close();

echo json_encode($response); 