<?php

include 'connection.php';

// Create connection
$con = new mysqli($servername, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$json = json_decode(file_get_contents('php://input'), true);

//Check Mobile AND Password is Empty or Not  
if (!empty($json['mobile'])) {

    //Seacrh User Exist or not in Database
    $Search_User = "SELECT * FROM `users` WHERE `user_contact` = '$json[mobile]'";
    $Check_Search_User = mysqli_fetch_array(mysqli_query($con, $Search_User));

    if (!empty($Check_Search_User)) {
        //Check User Mobile Number and Password and UserType


        $CheckSQL = "SELECT * FROM `users` WHERE `user_contact` = '$json[mobile]'";

        $result = mysqli_fetch_array(mysqli_query($con, $CheckSQL));
        if (!empty($result)) {
            //Success Response
            $SuccesMSG = array(
                'error' => 0,
                'status' => 'Success!',
                'msg' => 'Welcome',
                'user_id' => $result['user_id'],
                'user_name' => $result['user_name'],
            );
            $json = json_encode($SuccesMSG);
            echo $json;
        } else {
            //Failure Response
            $FailureMSG = array(
                'error' => 2,
                'status' => 'Failed!',
                'msg' => 'Unregistered User'
            );
            $json = json_encode($FailureMSG);
            echo $json;
        }
    }
}

mysqli_close($con);