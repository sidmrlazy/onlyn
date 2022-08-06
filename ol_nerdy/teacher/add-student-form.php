<div class="container section-container mb-5">
    <div class="section-header">
        <h3>Add Student</h3>
        <p>Enter details below to generate student ID. Please note the parent can login to their Onlyn Nerdy Parent
            Panel via Father's Mobile Number. The password to login will be sent on the email ID of the father.</p>
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
    if (isset($_POST['add'])) {
        $student_name = $_POST['student_name'];
        $student_father_name = $_POST['student_father_name'];
        $student_father_contact = $_POST['student_father_contact'];
        $student_father_email = $_POST['student_father_email'];
        $student_mother_name = $_POST['student_mother_name'];
        $student_mother_contact = $_POST['student_mother_contact'];
        $student_mother_email = $_POST['student_mother_email'];
        $student_address = $_POST['student_address'];
        $student_state = $_POST['student_state'];
        $student_city = $_POST['student_city'];
        $student_pincode = $_POST['student_pincode'];
        $student_assigned_class = $_POST['student_assigned_class'];
        $student_status = 1;

        $add_student_query = "INSERT INTO `students`(
            `student_name`, 
            `student_father_name`, 
            `student_father_contact`,
             `student_father_email`,
             `student_mother_name`,
             `student_mother_contact`,
             `student_mother_email`,
             `student_address`,
             `student_state`,
             `student_city`,
             `student_pincode`,
             `student_added_by`,
             `student_assigned_class`,
             `student_status`) VALUES (
                '$student_name',
             '$student_father_name',
             '$student_father_contact',
             '$student_father_email',
             '$student_mother_name',
             '$student_mother_contact',
             '$student_mother_email',
             '$student_address',
             '$student_state',
             '$student_city',
             '$student_pincode',
             '$session_user_id',
             '$student_assigned_class',
             '$student_status')";
        $add_student_result = mysqli_query($connection, $add_student_query);
        if (!$add_student_result) {
            die("ERROR 404: " . mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success mb-3 mt-2' role='alert'>
            Student Added!
          </div>";
        }
    }
    ?>

    <form action="" method="POST" class="card p-5">
        <div class="form-floating mb-3">
            <input type="text" name="student_name" class="form-control" id="floatingInput"
                placeholder="name@example.com">
            <label for="floatingInput">Student's Full Name</label>
        </div>
        <div class="w-100 d-flex mb-3">
            <div class="w-100 form-floating m-1 ">
                <input type="text" name="student_father_name" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Father's Name</label>
            </div>
            <div class="w-100 form-floating m-1 ">
                <input type="number" name="student_father_contact" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Father's Mobile Number</label>
            </div>
            <div class="w-100 form-floating m-1 ">
                <input type="email" name="student_father_email" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Father's Email Address</label>
            </div>
        </div>

        <div class="w-100 d-flex mb-3">
            <div class="w-100 form-floating m-1 ">
                <input type="text" name="student_mother_name" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Mother's Name</label>
            </div>
            <div class="w-100 form-floating m-1 ">
                <input type="number" name="student_mother_contact" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Mother's Mobile Number</label>
            </div>
            <div class="w-100 form-floating m-1 ">
                <input type="email" name="student_mother_email" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Mother's Email Address</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" name="student_address" placeholder="Leave a comment here"
                id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Full Address</label>
        </div>

        <div class="w-100 d-flex mb-3">
            <div class="form-floating m-1 w-100">
                <select class="form-select" name="student_state" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Click here to open list of States</option>
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
                <label for="floatingSelect">State</label>
            </div>

            <div class="form-floating m-1 w-100">
                <select class="form-select" name="student_city" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Click here to open list of Cities</option>
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
                <label for="floatingSelect">City</label>
            </div>

            <div class="form-floating m-1 w-100">
                <input type="number" name="student_pincode" maxlength="6" class="form-control" id="floatingInput"
                    placeholder="XXXXXX">
                <label for="floatingInput">Pincode</label>
            </div>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" name="student_assigned_class" id="floatingSelect"
                aria-label="Floating label select example">
                <option selected>Open this select menu</option>
                <?php
                $fetch_class = "SELECT * FROM classes where class_teacher = $session_user_id";
                $fetch_result = mysqli_query($connection, $fetch_class);
                while ($row = mysqli_fetch_assoc($fetch_result)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];
                ?>
                <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                <?php
                } ?>
            </select>
            <label for="floatingSelect">Assign Class</label>
        </div>

        <button type="submit" name="add" class="btn btn-outline-success p-3 mt-3">Add Student</button>
    </form>
</div>