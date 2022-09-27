<?php

include './connection.php';

// Create connection
$con = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

//Get All Category from Database 
$Search_Category = "SELECT * FROM `users` WHERE `user_type` = '2'";
$Check_Search_Category = mysqli_query($con, $Search_Category);
$categoryList = array();
if ($Check_Search_Category->num_rows > 0) {
    while ($row = mysqli_fetch_array($Check_Search_Category)) {
        $categoryList[] = array(
            'user_school_name' => $row['user_school_name'],
        );
    }
    $Response = array(
        'error' => 0,
        'status' => 'Success!',
        'CategoryList' => $categoryList
    );
} else {
    $Response = array(
        'error' => 1,
        'status' => 'Failed!',
        'CategoryList' => $categoryList
    );
}

echo json_encode($Response);

mysqli_close($con);