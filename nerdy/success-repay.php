<?php
include('main/config.php');
require('razorpay/Razorpay.php');
session_start();

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
$error = "Payment Failed";
$keyId = "rzp_test_XlQzoAPXt17Eag";
$keySecret = "RmBRy7F186o8bLQhuUC5kf0Y";

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
        $current_date = date("d-m-Y");
        $subscription_date = $current_date;
        $subscription_end_date = date('d-m-Y', strtotime($subscription_date . ' + 30 days'));

        $update_subscription = "UPDATE `subscription` SET `subscription_end_date`= '$subscription_end_date' WHERE `subscription_user_id` = $user_id";
        $update_subscription_res = mysqli_query($connection, $update_subscription);

        if ($update_subscription_res) {
            $update_setup = "UPDATE `setup_status` SET `setup_payment_status`= 1 WHERE `setup_school_id` = $user_id";
            $update_setup_res = mysqli_query($connection, $update_setup);

            if ($update_setup_res) {
                header('location:dashboard.php');
            }
        }
    } else {
        header('location:dashboard.php');
    }
}