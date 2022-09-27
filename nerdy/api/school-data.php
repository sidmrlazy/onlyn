<?php

include './connection.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

// Create connection
$con = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

//Get All Category from Database 
$query = "SELECT * FROM `users` WHERE `user_type` = '2'";
$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);
$result_array = array();

if ($count > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $result_array[] = array(
            'user_id' => $row['user_id'],
            'user_school_name' => $row['user_school_name'],
        );
    }
    $response = array(
        'error' => 0,
        'status' => 'Success!',
        'userData' => $result_array
    );
} else {
    $response = array(
        'error' => 1,
        'status' => 'Failed!',
        'userData' => $result_array
    );
}

echo json_encode($response);

mysqli_close($con);