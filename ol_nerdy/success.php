<?php
include('main/config.php');
require('razorpay/Razorpay.php');
session_start();

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
$error = "Payment Failed";
$keyId = "rzp_test_0WPfYvs2tlQaLU";
$keySecret = "rrPjT8zzOFtK0gSVxNBjCFEE";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    print_r($_POST);
    $razorpay_payment_id = mysqli_real_escape_string($connection, $_POST['razorpay_payment_id']);
    $razorpay_signature = mysqli_real_escape_string($connection, $_POST['razorpay_signature']);
    $razorpay_order_id = mysqli_real_escape_string($connection, $_POST['razorpay_order_id']);
    $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
    $user_plan_amount = mysqli_real_escape_string($connection, $_POST['user_plan_amount']);

    $transaction_query = "INSERT INTO `transactions`(
        `transaction_user_id`, 
        `razorpay_payment_id`, 
        `razorpay_signature`, 
        `razorpay_order_id`, 
        `user_plan_amount`) VALUES (
            '$user_id',
            '$razorpay_payment_id',
            '$razorpay_signature',
            '$razorpay_order_id',
            '$user_plan_amount')";
    $result = mysqli_query($connection, $transaction_query);

    if ($result) {
        $user_id = $_POST['user_id'];
        $get_order_query = "SELECT * FROM users WHERE user_id = $user_id";
        $get_order_result = mysqli_query($connection, $get_order_query);
        if ($get_order_result) {
            $update_order_query = "UPDATE `users` SET `user_payment_status`='1', `user_plan_amount`='$user_plan_amount', `user_status`='1' WHERE user_id = $user_id";
            $update_order_result = mysqli_query($connection, $update_order_query);

            if ($update_order_result) {
                $setup_registration_status = 1;
                $setup_class_status = 0;
                $setup_staff_status = 0;
                $setup_subject_status = 0;
                $setup_teacher_status = 0;
                $setup_remove_status = 0;

                $insert_setup_query = "INSERT INTO `setup_status`(
                    `setup_school_id`, 
                    `setup_registration_status`, 
                    `setup_class_status`,
                    `setup_teacher_status`, 
                    `setup_staff_status`, 
                    `setup_subject_status`,
                    `setup_remove_status`) VALUES (
                        '$user_id',
                        '$setup_registration_status',
                        '$setup_class_status',
                        '$setup_teacher_status',
                        '$setup_staff_status',
                        '$setup_subject_status',
                        '$setup_remove_status')";
                $insert_setup_result = mysqli_query($connection, $insert_setup_query);
                if ($insert_setup_result) {
                    $user_payment_status = 1;
                    $user_status = 1;
                    $user_added_by = 1;
                    $update_order_query = "UPDATE `users` SET `user_payment_status`='$user_payment_status', `user_status`='$user_status', `user_added_by`= '$user_added_by' WHERE user_id = $user_id";
                    $update_order_result = mysqli_query($connection, $update_order_query);
                    if (!$update_order_result) {
                        die("PAYMENT FAILED!" . mysqli_error($connection));
                    } else {
                        if ($user_plan_amount == 280000) {
                            $subscription_name = 'Basic';
                            $subscription_teacher_limit = 50;
                            $subscription_parent_limit = 100;
                            $subscription_status = 1;
                        } else if ($user_plan_amount == 360000) {
                            $subscription_name = 'Premium';
                            $subscription_teacher_limit = 100;
                            $subscription_parent_limit = 500;
                            $subscription_status = 1;
                        } else if ($user_plan_amount == 500000) {
                            $subscription_name = 'Pro';
                            $subscription_teacher_limit = 'Unlimited';
                            $subscription_parent_limit = 'Unlimited';
                            $subscription_status = 1;
                        }
                        $current_date = date("d-m-Y");
                        $subscription_date = $current_date;
                        $subscription_end_date = date('d-m-Y', strtotime($subscription_date . ' + 30 days'));

                        $update_subscription_query = "INSERT INTO `subscription`( 
                        `subscription_name`, 
                        `subscription_user_id`, 
                        `subscription_teacher_limit`, 
                        `subscription_parent_limit`, 
                        `subscription_status`,
                        `subscription_date`,
                        `subscription_end_date`) VALUES (
                            '$subscription_name',
                            '$user_id',
                            '$subscription_teacher_limit',
                            '$subscription_parent_limit',
                            '$subscription_status',
                            '$subscription_date',
                            '$subscription_end_date')";
                        $update_subscription_result = mysqli_query($connection, $update_subscription_query);
                        if (!$update_subscription_result) {
                            die(mysqli_error($connection));
                        } else {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["user_contact"] = $user_contact;
                            $_SESSION["user_school_name"] = $user_school_name;
                            $_SESSION["user_type"] = $user_type;
                            header('location: dashboard.php');
                        }
                    }
                } else {
                    $html = "<p>Your payment failed</p>
                             <p>{$error}</p>";
                }
            }
        }
    }
}