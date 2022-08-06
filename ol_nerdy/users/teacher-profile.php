<div class="container section-container mb-5">
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    $fetch_school_details = "SELECT * FROM users WHERE user_id = $session_user_id AND user_type = 3";
    $fetch_school_details_result = mysqli_query($connection, $fetch_school_details);

    while ($row = mysqli_fetch_assoc($fetch_school_details_result)) {
        // $user_school_logo = "assets/images/school-logo/" . $row['user_school_logo'];
        $user_name = $row['user_name'];
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
    ?>
    <div class="card p-4">
        <form action="" method="POST" class="school-profile-card">
            <!-- <div>
                <img class="user-school-logo" src="<?php echo $user_school_logo ?>"
                    alt="<?php echo $user_school_logo ?>">
            </div> -->
            <div class="school-profile-details">
                <h4 class="user-school"><?php echo $user_name ?></h4>
                <p class="user-contact">
                    <ion-icon name="phone-portrait-outline"></ion-icon> <?php echo $user_contact ?>
                </p>
                <p class="user_email">
                    <?php
                        if ($user_email == "") {
                            $user_email = "Not Found";
                        }
                        ?>
                    <ion-icon name="mail-outline"></ion-icon> <?php echo $user_email ?>
                </p>

                <p class="user-address">
                    <?php
                        if ($user_address == "") {
                            $user_address = "Not Found";
                        }
                        ?>
                    <ion-icon name="location-outline"></ion-icon> <?php echo $user_address ?>
                </p>


                <p class="user-city"><?php echo $user_city . ", " . $user_state . "-" . $user_pincode ?></p>
            </div>
        </form>
    </div>


    <?php
    } ?>
</div>