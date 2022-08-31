<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container mt-3">
        <p>Onboarded Schools</p>

        <div>
            <?php
            $query = "SELECT * FROM users WHERE user_type = 2 AND user_added_by = 0";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $user_school_logo = "assets/images/school-logo/" . $row['user_school_logo'];
                $user_school_name = $row['user_school_name'];
                $user_contact = $row['user_contact'];
                $user_added_date = $row['user_added_date'];
                $user_payment_status = $row['user_payment_status'];
                $user_status = $row['user_status'];
            ?>

            <div class="admin-school-details">
                <div class="school-logo">
                    <img src="<?php echo $user_school_logo ?>" alt="">
                </div>
                <div class="admin-school-details-row">
                    <div class="admin-school-content">
                        <p class="school-name"><?php echo $user_school_name ?></p>
                        <p class="school-contact"><?php echo $user_contact ?></p>
                    </div>

                    <div class="admin-school-content">
                        <!-- ========== PAYMENT STATUS START ==========  -->
                        <?php if ($user_payment_status == 1) { ?>
                        <p class="pay-success">Payment Successful</p>
                        <?php }
                            if ($user_payment_status == 2) { ?>
                        <p>Payment Unscuccessful</p>
                        <?php } ?>
                        <!-- ========== PAYMENT STATUS END ==========  -->
                        <p class="added-date"><?php echo $user_added_date ?></p>
                    </div>

                    <!-- ========== USER STATUS START ==========  -->
                    <?php
                        if ($user_status == 1) { ?>
                    <p>Active</p>
                    <?php }
                        if ($user_status == 2) { ?>
                    <p>Inactive</p>
                    <?php } ?>
                    <!-- ========== USER STATUS END ==========  -->
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>