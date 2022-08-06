<div class="container section-container">

    <div class="section-header">
        <h5>Add Subject</h5>
        <p>Enter subject name below</p>
    </div>
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    if (isset($_POST['complete'])) {
        $setup_subject_status = 1;
        $setup_remove_status = 1;
        $update_table = "UPDATE `setup_status` SET `setup_subject_status`='$setup_subject_status', `setup_remove_status`='$setup_remove_status' WHERE setup_school_id = $session_user_id";
        $update_table_result = mysqli_query($connection, $update_table);
        if (!$update_table_result) {
            die(mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>Subject Addition completed!</div>";
        }
    }

    if (isset($_POST['submit'])) {
        $subject_name = $_POST['subject_name'];
        $subject_added_by = $session_user_id;
        $subject_status = 1;

        if ($subject_name == "") {
            echo "<div class='alert alert-danger' role='alert'>Oops! Looks like you forgot to mention the subjects name.</div>";
        } else {
            $query = "INSERT INTO `subjects`(
            `subject_name`,
            `subject_added_by`, 
            `subject_status`) VALUES (
                '$subject_name',
                '$subject_added_by',
                '$subject_status')";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("<div class='alert alert-danger' role='alert'>ERROR 404!</div>" . mysqli_error($connection));
            } else {
                echo "<div class='alert alert-success' role='alert'>$subject_name has been added!</div>";
            }
        }
    }

    ?>
    <form method="POST" action="" class="card p-5">
        <div class="btn-row w-100">
            <div class="form-floating mb-3 w-100">
                <input type="text" name="subject_name" class="w-100 form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Subject Name</label>
            </div>
        </div>


        <button type="submit" name="submit" class="btn btn-outline-warning mb-3">ADD SUBJECT</button>
        <button type="submit" name="complete" class="btn btn-primary">COMPLETE SUBJECT ADDITION</button>
    </form>


</div>