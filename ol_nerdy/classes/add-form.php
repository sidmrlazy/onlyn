<div class="container section-container">

    <div class="section-header">
        <h3>Add Class</h3>
        <p>Mention details below to add class and setup your school</p>
    </div>
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    if (isset($_POST['complete'])) {
        $complete_profile_query = "UPDATE `setup_status` SET `setup_class_status`= 1 WHERE setup_school_id = $session_user_id";
        $complete_profile_result = mysqli_query($connection, $complete_profile_query);
        if (!$complete_profile_result) {
            die(mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>
            Class creation complete!
          </div>";
        }
    }

    if (isset($_POST['submit'])) {
        $class_name = $_POST['class_name'];
        $class_section = $_POST['class_section'];
        $class_added_by = $session_user_id;
        $class_status = 1;

        $query = "INSERT INTO `classes`(
            `class_name`, 
            `class_section`, 
            `class_added_by`, 
            `class_status`) VALUES (
                '$class_name',
                '$class_section',
                '$class_added_by',
                '$class_status')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Oops! Classes could not be added!" . mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>
                 $class_name $class_section has been added!
               </div>";
        }
    }
    ?>



    <form method="POST" action="" class="card p-5">
        <div id='new-input-field' class='d-flex justify-content-center align-items-center w-100'>
            <div class='form-floating mb-3 w-100 m-1'>
                <input type='text' name='class_name' class='form-control' id='floatingInput'
                    placeholder='name@example.com'>
                <label for='floatingInput'>Class Name</label>
            </div>
            <div class='form-floating mb-3 w-100 m-1'>
                <input type='text' name='class_section' class='form-control' id='floatingPassword'
                    placeholder='Password'>
                <label for='floatingPassword'>Section</label>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-outline-warning mb-3 mt-3">Add Class</button>
        <button type="submit" name="complete" class="btn btn-primary">Complete
            Class
            Creation</button>
    </form>
</div>