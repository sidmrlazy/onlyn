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
    $user_school_name = $_POST["user_school_name"];
    $user_contact = $_POST["user_contact"];
    $user_email = $_POST["user_email"];
    $user_state = $_POST["user_state"];
    $user_city = $_POST["user_city"];
    $user_address = $_POST["user_address"];
    $user_pincode = $_POST["user_pincode"];
    $user_type = "2";
    $user_password = $_POST["user_password"];
    $user_cpassword = $_POST["user_cpassword"];
    $user_plan_amount = $_POST["user_plan_amount"];

    $query = "SELECT * FROM users WHERE user_contact='$user_contact'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
        if (($user_password == $user_cpassword) && $user_exists == false) {
            $hash = password_hash($user_password, PASSWORD_DEFAULT);

            $reg_user = "INSERT INTO `users` ( 
                         `user_school_name`,
                         `user_contact`,
                         `user_email`,
                         `user_state`,
                         `user_city`,
                         `user_address`,
                         `user_pincode`,
                         `user_type`,
                         `user_plan_amount`, 
                         `user_password`, 
                         `user_added_date`) VALUES (
                             '$user_school_name',
                             '$user_contact', 
                             '$user_email',
                             '$user_state',
                             '$user_city',
                             '$user_address',
                             '$user_pincode',
                             '$user_type',
                             '$user_plan_amount',
                             '$hash', 
                             current_timestamp())";

            $reg_user_result = mysqli_query($connection, $reg_user);

            if ($reg_user_result) {
                $fetch_query = "SELECT * FROM users WHERE user_contact = $user_contact";
                $fetch_result = mysqli_query($connection, $fetch_query);
                while ($row = mysqli_fetch_assoc($fetch_result)) {
                    $user_id = $row['user_id'];

                    // Fetch User details from database after registration of users below
                    $user_school_name = $_POST['user_school_name'];
                    $user_contact = $_POST['user_contact'];
                    $user_email = $_POST['user_email'];
                    $user_plan_amount = $_POST['user_plan_amount'];

                    $keyId = 'rzp_test_0WPfYvs2tlQaLU';
                    $keySecret = 'rrPjT8zzOFtK0gSVxNBjCFEE';
                    $api = new Api($keyId, $keySecret);
                    $orderData = [
                        'receipt' => rand(1000, 9999) . 'ORD',
                        'amount' => $user_plan_amount * 100,
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
                        "description" => 'Technology Enlogo.pngabled Schools',
                        "image" => "assets/images/logo/",
                        "prefill" => [
                            "name" => $user_school_name,
                            "email" => $user_email,
                            "contact" => $user_contact,
                        ],
                        "theme" => [
                            "color" => "#44ad40"
                        ],
                        "order_id" => $razorpayOrderId,
                    ];
                    $json = json_encode($data);
                }



                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    } // end if 

    if ($count > 0) {
        $user_exists = "Oops! Looks like you are already registered with us";
    }
}
?>
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

<?php include('main/session-less-header.php') ?>
<div class="container mt-5 d-flex justify-content-center align-items-center">
    <button id="rzp-button1" class="btn btn-primary">Pay with Razorpay</button>
</div>
<?php include('main/footer.php') ?>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="success.php" method="POST">
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