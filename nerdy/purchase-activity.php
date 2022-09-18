<?php
include 'main/config.php';
require('razorpay/src/Api.php');
require('razorpay/Razorpay.php');
session_start();

use Razorpay\Api\Api;

$show_alert = false;
$show_error = false;
$user_exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purchase_activity_id = $_POST['purchase_activity_id'];
    $purchase_user_id = $_POST['purchase_user_id'];
    $purchase_activity_amount = $_POST['purchase_activity_amount'];
    $purchase_status = 1;

    $keyId = "rzp_test_XlQzoAPXt17Eag";
    $keySecret = "RmBRy7F186o8bLQhuUC5kf0Y";
    $api = new Api($keyId, $keySecret);
    $orderData = [
        'receipt' => rand(1000, 9999) . 'ORD',
        'amount' => $purchase_activity_amount * 100,
        'currency' => 'INR',
        'payment_capture' => 1
    ];
    $razorpayOrder = $api->order->create($orderData);
    $razorpayOrderId = $razorpayOrder['id'];
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    $displayAmount = $amount = $orderData['amount'];

    $data = [
        "key" => $keyId,
        "amount" => $amount,
        "name" => 'Onlyn Nerdy',
        "description" => 'Taking your school from Analog to Digital',
        "image" => "assets/images/logo/logo-round.png",
        "prefill" => [
            "name" => $purchase_user_id,
            "email" => $purchase_user_id,
            "contact" => $purchase_user_id,
        ],
        "theme" => [
            "color" => "#610856"
        ],
        "order_id" => $razorpayOrderId,
    ];
    $json = json_encode($data);
}
$showAlert = true;
?>

<!-- ============== ALERT START ============== -->
<?php

if ($show_alert) {

    echo ' <div class="alert alert-success 
alert-dismissible fade show" role="alert">

<strong>Success!</strong> Your account is 
now created and you can login. 
<button type="button" class="close"
    data-dismiss="alert" aria-label="Close"> 
    <span aria-hidden="true"></span> 
</button> 
</div> ';
}

if ($show_error) {

    echo ' <div class="alert alert-danger 
alert-dismissible fade show" role="alert"> 
<strong>Error!</strong> ' . $show_error . '

<button type="button" class="close" 
data-dismiss="alert aria-label="Close">
<span aria-hidden="true">×</span> 
</button> 
</div> ';
}

if ($user_exists) {
    echo ' <div class="alert alert-danger 
alert-dismissible fade show" role="alert">

<strong>Error!</strong> ' . $user_exists . '
<button type="button" class="close" 
data-dismiss="alert" aria-label="Close"> 
<span aria-hidden="true">×</span> 
</button>
</div> ';
}

?>
<!-- ============== ALERT END ============== -->

<?php include('main/session-less-header.php') ?>
<?php include('navbar/navbar.php') ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container">
        <div class="container mt-5 d-flex justify-content-center align-items-center">
            <div>

            </div>
            <button id="rzp-button1" class="btn btn-primary">Pay with Razorpay</button>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>


<!-- ============== SCRIPT START ============== -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="success-repay.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="user_plan_amount" id="user_plan_amount" value="<?php echo $amount; ?>">
</form>
<script>
var options = <?php echo $json ?>;
options.handler = function(response) {
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
    document.razorpayform.submit();

    // console.log(response.razorpay_order_id);
    // console.log(response.razorpay_payment_id);
    // console.log(response.razorpay_signature);
};
var rzp = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
    rzp.open();
    e.preventDefault();
}
</script>
<!-- ============== SCRIPT END ============== -->