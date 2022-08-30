<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Select Class
            </h3>
            <p class="section-desc">Select class & enter student's roll number to fetch student details</p>
        </div>

        <form method="POST" action="show-student-details.php" class="col-md-6 card p-3">
            <input type="text" name="student_assigned_school" value="<?php echo $session_user_id ?>" hidden>
            <div id='new-input-field' class='mob-flex d-flex justify-content-center align-items-center w-100 mb-3'>
                <div class="form-floating w-100 m-1">
                    <select class="form-select" id="floatingSelect" name="student_assigned_class"
                        aria-label="Floating label select example">
                        <option value="0">Click here</option>
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                        } else {
                            $session_user_id = 0;
                        }

                        $fetch_class = "SELECT * FROM `classes` WHERE `class_added_by` = $session_user_id";
                        $fetch_result = mysqli_query($connection, $fetch_class);

                        while ($row = mysqli_fetch_assoc($fetch_result)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                        ?>
                        <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">Select Class</label>
                </div>

                <div class='form-floating w-100 m-1'>
                    <input type='number' maxlength="10" name='student_roll_number' class='form-control'
                        id='floatingContact' placeholder='Mobile Number'>
                    <label for='floatingContact'>Student Roll Number</label>
                </div>
            </div>

            <button type="submit" name="search" class="btn btn-outline-success mb-3">
                <ion-icon name="search-outline"></ion-icon> SEARCH
            </button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>