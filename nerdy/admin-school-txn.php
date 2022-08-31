<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container mt-3">
        <p>Transactions</p>

        <div>
            <?php
            $query = "SELECT * FROM `transactions`";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $transaction_user_id = $row['transaction_user_id'];
                $payment_id = $row['razorpay_payment_id'];
                $payment_amount = $row['user_plan_amount'] / 100;
                $payment_date = $row['transaction_date'];

                $data = "SELECT * FROM users WHERE user_id = $transaction_user_id";
                $res = mysqli_query($connection, $data);

                $user_school_name = "";
                while ($row = mysqli_fetch_assoc($res)) {
                    $user_school_name = $row['user_school_name'];
                }
            ?>
            <div class="admin-txn-tab">
                <p class="txn-school-name"><?php echo $user_school_name ?></p>

                <div class="admin-txn-flex">
                    <?php
                        if ($payment_amount == 2800) {
                            $payment_amount_name = "Basic (₹2800/-)";
                        }
                        if ($payment_amount == 3600) {
                            $payment_amount_name = "Premium (₹3600/-)";
                        }
                        if ($payment_amount == 5000) {
                            $payment_amount_name = "Pro (₹5000/-)";
                        }
                        ?>
                    <p class="plan-name"><?php echo $payment_amount_name ?></p>
                    <p class="m-0"><?php echo $payment_id ?></p>
                </div>
                <p><?php echo $payment_date ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>