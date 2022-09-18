<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Edit Student
            </h3>
            <p class="section-desc">Update student information below</p>
        </div>

        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
            $session_user_contact = $_SESSION['user_contact'];
            $session_user_type = $_SESSION['user_type'];
        } else {
            $session_user_id = 0;
        }

        if (isset($_POST['update'])) {
            $student_id = $_POST['student_id'];
            $student_roll_number = $_POST['student_roll_number'];
            $student_name = $_POST['student_name'];
            $student_father_name = $_POST['student_father_name'];
            $student_father_email = $_POST['student_father_email'];
            $student_mother_name = $_POST['student_mother_name'];
            $student_mother_contact = $_POST['student_mother_contact'];
            $student_mother_email = $_POST['student_mother_email'];
            $student_address = $_POST['student_address'];
            $student_state = $_POST['student_state'];
            $student_city = $_POST['student_city'];
            $student_pincode = $_POST['student_pincode'];
            $student_status = $_POST['student_status'];

            $update_data = "UPDATE `students` SET 
        `student_roll_number`= '$student_roll_number',
        `student_name`= '$student_name',
        `student_father_name`= '$student_father_name',
        `student_father_email`= '$student_father_email',
        `student_mother_name`='$student_mother_name',
        `student_mother_contact`= '$student_mother_contact',
        `student_mother_email`= '$student_mother_email',
        `student_address`='$student_address',
        `student_state`='$student_state',
        `student_city`='$student_city',
        `student_pincode`='$student_pincode',
        `student_added_by`='$session_user_id',
        `student_status`='$student_status' WHERE student_id = $student_id";
            $update_data_result = mysqli_query($connection, $update_data);
            if (!$update_data_result) {
                die("ERROR 404: " . mysqli_error($connection));
            } else {
                echo "<div class='alert alert-success mb-3 mt-2' role='alert'>
            Student Data Updated!
          </div>";
            }
        }

        if (isset($_POST['edit'])) {
            $student_id = $_POST['student_id'];
            $fetch_data = "SELECT * FROM students WHERE student_id = $student_id";
            $data_result = mysqli_query($connection, $fetch_data);
            while ($row = mysqli_fetch_assoc($data_result)) {
                $student_roll_number = $row['student_roll_number'];
                $student_name = $row['student_name'];
                $student_father_name = $row['student_father_name'];
                $student_father_contact = $row['student_father_contact'];
                $student_father_email = $row['student_father_email'];
                $student_mother_name = $row['student_mother_name'];
                $student_mother_contact = $row['student_mother_contact'];
                $student_mother_email = $row['student_mother_email'];
                $student_address = $row['student_address'];
                $student_state = $row['student_state'];
                $student_city = $row['student_city'];
                $student_pincode = $row['student_pincode'];
                $student_assigned_class = $row['student_assigned_class'];
                $student_status = $row['student_status'];

        ?>

        <form action="" method="POST" class="card p-5">
            <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
            <div class="mb-3">
                <label for="studentFullName" class="form-label">Student Roll Number</label>
                <input type="text" name="student_roll_number" value="<?php echo $student_roll_number ?>"
                    placeholder="<?php echo $student_roll_number ?>" class="form-control" id="studentFullName"
                    aria-describedby="fullName">
            </div>
            <div class="mb-3">
                <label for="studentFullName" class="form-label">Student Full Name</label>
                <input type="text" name="student_name" value="<?php echo $student_name ?>"
                    placeholder="<?php echo $student_name ?>" class="form-control" id="studentFullName"
                    aria-describedby="fullName">
            </div>
            <div class="w-100 d-flex mob-flex mb-3">
                <div class="w-100 m-1">
                    <label for="studentFullName" class="form-label">Father's Full Name</label>
                    <input type="text" name="student_father_name" placeholder="<?php echo $student_father_name ?>"
                        value="<?php echo $student_father_name ?>" class="form-control" id="studentFullName"
                        aria-describedby="fullName">
                </div>
                <div class="w-100 m-1">
                    <label for="studentFullName" class="form-label">Father's Contact</label>
                    <input disabled type="number" placeholder="<?php echo $student_father_contact ?>"
                        value="<?php echo $student_father_contact ?>" name="student_father_contact" class="form-control"
                        id="studentFullName" aria-describedby="fullName">
                </div>
                <div class="w-100 m-1">
                    <label for="studentFullName" class="form-label">Father's Email</label>
                    <input type="text" name="student_father_email" value="<?php echo $student_father_email ?>"
                        placeholder="<?php echo $student_father_email ?>" class="form-control" id="studentFullName"
                        aria-describedby="fullName">
                </div>
            </div>

            <div class="w-100 d-flex mob-flex mb-3">
                <div class="w-100 m-1">
                    <label for="studentFullName" class="form-label">Mother's Full Name</label>
                    <input type="text" name="student_mother_name" value="<?php echo $student_mother_name ?>"
                        placeholder="<?php echo $student_mother_name ?>" class="form-control" id="studentFullName"
                        aria-describedby="fullName">
                </div>
                <div class="w-100 m-1">
                    <label for="studentFullName" class="form-label">Mother's Contact</label>
                    <input type="number" name="student_mother_contact" value="<?php echo $student_mother_contact ?>"
                        placeholder="<?php echo $student_mother_contact ?>" class="form-control" id="studentFullName"
                        aria-describedby="fullName">
                </div>
                <div class="w-100 m-1">
                    <label for="studentFullName" class="form-label">Mother's Email</label>
                    <input type="text" name="student_mother_email" value="<?php echo $student_mother_email ?>"
                        placeholder="<?php echo $student_mother_email ?>" class="form-control" id="studentFullName"
                        aria-describedby="fullName">
                </div>
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                <input type="text" name="student_address" value="<?php echo $student_address ?>"
                    placeholder="<?php echo $student_address ?>" class="form-control" id="studentFullName"
                    aria-describedby="fullName">
            </div>

            <div class="w-100 d-flex mob-flex mb-3">
                <div class="m-1 w-100">
                    <label for="exampleFormControlInput1" class="form-label">State</label>
                    <select class="form-select" name="student_state" aria-label="Default select example">
                        <option><?php echo $student_state; ?></option>
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

                <div class="m-1 w-100">
                    <label for="exampleFormControlInput1" class="form-label">City</label>
                    <select class="form-select" name="student_city" aria-label="Default select example">
                        <option><?php echo $student_city; ?></option>
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

                <div class="m-1 w-100">
                    <label for="exampleFormControlInput1" class="form-label">Pincode</label>
                    <input type="number" maxlength="6" class="form-control" id="exampleFormControlInput1"
                        name="student_pincode" value="<?php echo $student_pincode; ?>"
                        placeholder="<?php echo $student_pincode; ?>">
                </div>


            </div>


            <div class="w-100 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Student ID Status</label>

                <select class="form-select" name="student_status" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">Activate</option>
                    <option value="2">Disable</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-outline-success p-3 mt-3">Update Student Details</button>
        </form>
        <?php   }
        } ?>
    </div>
</div>
<?php include('main/footer.php'); ?>