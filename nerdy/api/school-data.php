<?php

include 'connection.php';

// Create connection
$connection = new mysqli($host_name, $host_user, $host_password, $host_db);

if ($connectionn->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$json = json_decode(file_get_contents('php://input'), true);
$ProfileData = array();
$search_user = "SELECT * FROM `users` WHERE `user_type` = 2";
$search_user_res = mysqli_query($connection, $search_user);
$user_count = mysqli_num_rows($search_user_res);

if ($user_count > 0) {
    while ($row = mysqli_fetch_assoc($search_user_res)) {
        $user_data[] = array(
            'user_school_name' => $row['user_school_name'],
        );
    }
    $response = array(
        'Error' => 0,
        'Status' => 'Success!',
        'Message' => 'User details found',
        'userData' => $user_data,
    );
} else {
    $response = array(
        'Error' => 1,
        'Status' => 'Failed!',
        'Message' => 'User Not Found',
        'userData' => $user_data
    );
}
echo json_encode($response);
mysqli_close($connection);