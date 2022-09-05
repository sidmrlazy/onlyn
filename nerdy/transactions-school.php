<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>


<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="shield-checkmark" class="section-heading-icon"></ion-icon>
                Transactions
            </h3>
            <p class="section-desc">View your transaction history below</p>
        </div>

        <?php
        require_once('main/config.php');
        require('razorpay/Razorpay.php');

        use Razorpay\Api\Api;
        use Razorpay\Api\Invoice;
        use Razorpay\Api\Errors\SignatureVerificationError;





        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        $fetch_records = "SELECT * FROM `transactions` WHERE transaction_user_id = $session_user_id";
        $fetch_result = mysqli_query($connection, $fetch_records);
        while ($row = mysqli_fetch_assoc($fetch_result)) {
            $transaction_user_id = $row['transaction_user_id'];
            $transaction_id = $row['razorpay_payment_id'];
            $amount = $row['user_plan_amount'];
            $transaction_date = $row['transaction_date'];
            if ($amount) {
                $transaction_amount = $amount / 100;

                $keyId = "rzp_test_XlQzoAPXt17Eag";
                $keySecret = "RmBRy7F186o8bLQhuUC5kf0Y";

                $api = new Api($keyId, $keySecret);
                $api->invoice->create(array(
                    'type' => 'invoice',
                    'date' => date($transaction_date),
                    'customer_id' => $transaction_user_id,
                    'line_items' =>
                    array(array(
                        'item_id' => $transaction_id
                    ))
                ));

                // echo $api;

        ?>
        <div class="transaction-card">
            <p class="transaction-amount">₹<?php echo $transaction_amount ?></p>
            <div class="tran-row">
                <p class="tran-id"><?php echo $transaction_id ?></p>
                <p><?php echo date('d | M | Y', strtotime($transaction_date)) ?></p>
                <button class="download-btn">
                    <ion-icon name="download-outline"></ion-icon>
                </button>
            </div>
        </div>
        <?php }
        } ?>
    </div>
</div>
<?php include('main/footer.php'); ?>