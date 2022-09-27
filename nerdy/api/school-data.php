<?php

include 'connection.php';

// Create connection
$connection = new mysqli($host_name, $host_user, $host_password, $host_db);

if ($connectionn->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$json = json_decode(file_get_contents('php://input'), true);
$ProfileData = array();
$search_user = "SELECT * FROM `users` WHERE `user_type` = '2'";
$search_user_res = mysqli_query($connection, $search_user);
$user_count = mysqli_num_rows($search_user_res);

if ($user_count > 0) {
    while ($row = mysqli_fetch_assoc($search_user_res)) {
        $user_data[] = array(
            'user_school_name' => $row['user_school_name'],
        );
    }
    $response = array(
        'error' => 0,
        'status' => 'Success!',
        'msg' => 'User details found',
        'ProfileData' => $user_data,
    );
} else {
    $response = array(
        'error' => 1,
        'status' => 'Failed!',
        'msg' => 'Dealer Id not registered with us!',
        'ProfileData' => $ProfileData
    );
}
echo json_encode($response);
mysqli_close($connection);