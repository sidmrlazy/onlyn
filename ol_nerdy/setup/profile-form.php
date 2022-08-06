<div class="container section-container mb-5">
    <div class="section-header">
        <h3>Complete Profile</h3>
        <p>Enter details below to complete your profile</p>
    </div>
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    // QUERY TO UPLOAD SCHOO LOGO
    if (isset($_POST['update-img'])) {
        $user_school_logo = $_FILES["user_school_logo"]["name"];
        $user_school_logo_temp = $_FILES["user_school_logo"]["tmp_name"];
        $folder = "assets/images/school-logo/" . $user_school_logo;

        $update_query = "UPDATE `users` SET `user_school_logo`='$user_school_logo' WHERE `user_id` = $session_user_id";
        $update_result = mysqli_query($connection, $update_query);
        if (!$update_result) {
            echo mysqli_error($connection);
        } else {
            if (move_uploaded_file($user_school_logo_temp, $folder)) {
                $msg = "School Logo Updated";
                echo "<div class='alert w-100 alert-success' role='alert'>$msg</div>";
            } else {
                $msg = "School Logo Could not be Uploaded";
                echo "<div class='alert w-100 alert-danger' role='alert'>$msg</div>";
            }
        }
    }


    // QUERY TO FETCH SCHOOL LOGO
    $get_image_query = "SELECT * FROM users WHERE user_id = $session_user_id";
    $get_image_result = mysqli_query($connection, $get_image_query);
    while ($row = mysqli_fetch_assoc($get_image_result)) {
        $user_school_logo = "assets/images/school-logo/" . $row['user_school_logo'];

        if ($user_school_logo == "") {
    ?>
    <form action="" enctype="multipart/form-data" method="POST">
        <div class="card p-3 mb-3 profile-logo-section">
            <ion-icon class="profile-logo-section-icon" name="image-outline"></ion-icon>
            <div class="mb-3 w-100">
                <label for="formFile" class="form-label">Upload School Logo</label>
                <input class="form-control" type="file" name="user_school_logo" id="formFile">
            </div>
            <button type="submit" name="update-img" class="btn btn-outline-primary">Update School Logo</button>
        </div>
    </form>

    <?php
        } else { ?>
    <form action="" enctype="multipart/form-data" method="POST">
        <div class="card p-3 mb-3 profile-logo-section">
            <img src="<?php echo $user_school_logo ?>" alt="">
            <!-- <ion-icon class="profile-logo-section-icon" name="image-outline"></ion-icon> -->
            <div class="mb-3 w-100">
                <label for="formFile" class="form-label">Upload School Logo</label>
                <input class="form-control" type="file" name="user_school_logo" id="formFile">
            </div>
            <button type="submit" name="update-img" class="btn btn-outline-primary">Update School Logo</button>
        </div>
    </form>
    <?php }
    } ?>

    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    // QUERY TO UPDATE REGISTRATION PROCESS
    if (isset($_POST['submit'])) {
        $complete_profile_query = "UPDATE `setup_status` SET `setup_registration_status`= 2 WHERE setup_school_id = $session_user_id";
        $complete_profile_result = mysqli_query($connection, $complete_profile_query);
        if (!$complete_profile_result) {
            die(mysqli_error($connection));
        }
    }


    // QUERY TO UPDATE SCHOOL'S OTHER INFORMATION
    if (isset($_POST['update'])) {
        $user_school_name = $_POST['user_school_name'];
        $user_email = $_POST['user_email'];
        $user_state = $_POST['user_state'];
        $user_city = $_POST['user_city'];
        $user_address = $_POST['user_address'];
        $user_pincode = $_POST['user_pincode'];

        $update_query = "UPDATE `users` SET 
        `user_school_name`='$user_school_name',
        `user_email`='$user_email',
        `user_state`='$user_state',
        `user_city`='$user_city',
        `user_address`='$user_address',
        `user_pincode`='$user_pincode'
        WHERE `user_id` = $session_user_id";

        $update_result = mysqli_query($connection, $update_query);
        if (!$update_query) {
            die("<div class='alert alert-danger' role='alert'>
            Data could not be updated!
          </div>" . mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>
            Profile Saved!
          </div>";
        }
    }

    // QUERY TO FETCH USER DETAILS
    $query = "SELECT * FROM users WHERE user_id = $session_user_id";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $user_school_name = $row['user_school_name'];
        $user_contact = $row['user_contact'];
        $user_email = $row['user_email'];
        $user_state = $row['user_state'];
        $user_city = $row['user_city'];
        $user_address = $row['user_address'];
        $user_pincode = $row['user_pincode'];
        $user_plan_amount = $row['user_plan_amount']; ?>

    <form method="POST" action="" class="card p-5">
        <input type="text" hidden name="user_id" value="<?php echo $user_id; ?>">
        <div class="mb-3">
            <label for="schoolName" class="form-label">School Name</label>
            <input type="text" name="user_school_name" value="<?php echo $user_school_name; ?>" class="form-control"
                placeholder="<?php echo $user_school_name; ?>" id="schoolName" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <fieldset disabled>
                <label for="disabledTextInput" class="form-label">Registered Mobile Number</label>
                <input type="text" name="user_contact" id="disabledTextInput" value="<?php echo $user_contact; ?>"
                    class="form-control" placeholder="<?php echo $user_contact; ?>">
            </fieldset>
        </div>

        <div class="mb-3">
            <label for="schoolEmail" class="form-label">Email ID</label>
            <input type="email" name="user_email" value="<?php echo $user_email; ?>" class="form-control"
                placeholder="<?php echo $user_email; ?>" id="schoolEmail" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="schoolState" class="form-label">State</label>
            <select class="form-select" name="user_state" aria-label="Default select example">
                <option><?php echo $user_state; ?></option>
                <?php
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/states',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => array(
                            'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $response_json = json_decode($response);
                    foreach ($response_json as $key) {
                        $user_state =  $key->name; ?>
                <option value="<?php echo $user_state; ?>"><?php echo $user_state; ?></option>
                <?php
                    }
                    ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="schoolState" class="form-label">City</label>
            <select class="form-select" name="user_city" aria-label="Default select example">
                <option><?php echo $user_city; ?></option>
                <?php
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => array(
                            'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $response_json = json_decode($response);
                    foreach ($response_json as $key) {
                        $user_city =  $key->name; ?>
                <option value="<?php echo $user_city; ?>"><?php echo $user_city; ?></option>
                <?php
                    }
                    ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="schoolPincode" class="form-label">Pincode</label>
            <input type="text" name="user_pincode" value="<?php echo $user_pincode; ?>" class="form-control"
                placeholder="<?php echo $user_pincode; ?>" id="schoolPincode" aria-describedby="emailHelp">
        </div>


        <div class="mb-3">
            <label for="schoolAddress" class="form-label">Address</label>
            <input type="text" name="user_address" class="form-control" value="<?php echo $user_address; ?>"
                placeholder="<?php echo $user_address; ?>" id="schoolAddress" aria-describedby="emailHelp">
        </div>

        <button type="submit" name="update" class="p-2 mt-3 mb-3 btn btn-outline-warning">Save Form</button>
        <button type="submit" name="submit" class="p-2 btn btn-outline-success">Complete Profile</button>
    </form>
    <?php
    } ?>
</div>