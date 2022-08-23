<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>

<div class="container section-container mb-5">
    <div class="section-header">
        <h3 class="section-heading">
            <ion-icon name="construct-outline" class="section-heading-icon"></ion-icon>
            Add Staff
        </h3>
        <p class="section-desc">Enter staff details below to generate staff ID.</p>
    </div>
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    if (isset($_POST['complete'])) {
        $setup_staff_status = 1;
        $update_table = "UPDATE `setup_status` SET `setup_staff_status`='$setup_staff_status' WHERE setup_school_id = $session_user_id";
        $update_table_result = mysqli_query($connection, $update_table);
        if (!$update_table_result) {
            die(mysqli_error($connection));
        } else {
            echo '<script>staffAddComplete()</script>';
        }
    }

    if (isset($_POST['submit'])) {
        $staff_name = $_POST['staff_name'];
        $staff_contact = $_POST['staff_contact'];
        $staff_type = $_POST['staff_type'];
        $session_user_id;
        $staff_active_status = 1;

        $insert_staff_query = "INSERT INTO `staff`(
            `staff_name`, 
            `staff_contact`, 
            `staff_type`, 
            `staff_added_by`, 
            `staff_active_status`) VALUES (
                '$staff_name',
                '$staff_contact',
                '$staff_type',
                '$session_user_id',
                '$staff_active_status')";
        $insert_staff_result = mysqli_query($connection, $insert_staff_query);
        if ($insert_staff_result) {
            echo '<script>staffAdded()</script>';
        } else {
            die("<div class='alert alert-danger' role='alert'>Staff ID could not be generated!</div>" . mysqli_error($connection));
        }
    }

    ?>
    <form method="POST" action="" class="card p-5">
        <div class='d-flex justify-content-center align-items-center w-100 mb-3'>
            <div class='form-floating w-100 m-1'>
                <input type='text' name='staff_name' class='form-control' id='floatingInput' placeholder='Full Name'>
                <label for='floatingInput'>Staff Full Name</label>
            </div>
            <div class='form-floating w-100 m-1'>
                <input type='number' maxlength="10" name='staff_contact' class='form-control' id='floatingContact'
                    placeholder='Mobile Number'>
                <label for='floatingContact'>Contact Number</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" name="staff_type" id="floatingSelect"
                aria-label="Floating label select example">
                <option selected>Open this menu</option>
                <option value="Aaya">Aaya</option>
                <option value="Peon">Peon</option>
                <option value="Sweeper">Sweeper</option>
                <option value="Security Guard">Security Guard</option>
                <label for="floatingSelect">Staff Type</label>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-outline-warning mb-3">Generate Staff ID</button>
        <button type="submit" name="complete" class="btn btn-primary">Complete</button>
    </form>
</div>

<?php include('main/footer.php'); ?>