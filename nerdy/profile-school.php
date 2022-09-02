<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <?php
        require('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        $fetch_school_details = "SELECT * FROM users WHERE user_id = $session_user_id";
        $fetch_school_details_result = mysqli_query($connection, $fetch_school_details);

        while ($row = mysqli_fetch_assoc($fetch_school_details_result)) {
            $user_id = $row['user_id'];
            $user_school_logo = "assets/images/school-logo/" . $row['user_school_logo'];
            $user_school_name = $row['user_school_name'];
            $user_contact = $row['user_contact'];
            $user_email = $row['user_email'];
            $user_state = $row['user_state'];
            $user_state = $row['user_state'];
            $user_city = $row['user_city'];
            $user_address = $row['user_address'];
            $user_pincode = $row['user_pincode'];
            $user_status = $row['user_status'];
            $user_plan_amount = $row['user_plan_amount'];
            if ($user_plan_amount == 280000) {
                $user_plan_name = "Basic";
            } else if ($user_plan_amount == 360000) {
                $user_plan_name = "Premium";
            } else if ($user_plan_amount == 500000) {
                $user_plan_name = "Pro";
            }
        ?>
        <div class="card p-4">
            <div class="school-profile-card">
                <div>
                    <img class="user-school-logo" src="<?php echo $user_school_logo ?>"
                        alt="<?php echo $user_school_logo ?>">
                </div>
                <div class="school-profile-details">
                    <h4 class="user-school"><?php echo $user_school_name ?></h4>
                    <p class="user-contact">
                        <ion-icon name="phone-portrait-outline"></ion-icon> <?php echo $user_contact ?>
                    </p>
                    <p class="user_email">
                        <ion-icon name="mail-outline"></ion-icon> <?php echo $user_email ?>
                    </p>

                    <p class="user-address">
                        <ion-icon name="location-outline"></ion-icon> <?php echo $user_address ?>
                    </p>
                    <p class="user-city"><?php echo $user_city . ", " . $user_state . "-" . $user_pincode ?></p>
                </div>
                <form action="edit-school-profile.php" method="POST">
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                    <button type="submit" name="edit" class="edit-profile-btn-holder">
                        <ion-icon name="create-outline" class="edit-profile-btn"></ion-icon>
                    </button>
                </form>
            </div>
        </div>

        <div class="card mt-3 p-4">
            <p class="user-profile-label">Subscription Status</p>
            <div class="d-flex justify-content-start align-items-end">
                <p class="user-plan-name"><?php echo $user_plan_name ?></p>
                <p class="plan-status">Active</p>
            </div>

            <div class="card mt-3 p-3">
                <p class="user-profile-label">Subscription End Date</p>
                <?php
                    $get_subscription_details = "SELECT * FROM `subscription` WHERE subscription_user_id = $session_user_id";
                    $get_subscription_result = mysqli_query($connection, $get_subscription_details);
                    $subscription_end_date = "";
                    while ($row = mysqli_fetch_assoc($get_subscription_result)) {
                        $subscription_end_date = $row['subscription_end_date'];
                        // $new_date = explode(" ", $fetched_transaction_date);
                        // $expiry_date = $new_date[0];
                        // $new_expiry = date('d-M-Y', strtotime($new_date[0] . ' + 30 days'));
                    }
                    ?>
                <p class="expiry-date"><?php echo date('d-M-Y', strtotime($subscription_end_date)); ?></p>

            </div>
        </div>
        <?php
        } ?>
    </div>
</div>
<?php include('main/footer.php'); ?>