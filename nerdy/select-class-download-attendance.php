<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header section-heading-row">
            <div class="section-flex">
                <h3 class="section-heading">
                    <ion-icon name="shield" class="section-heading-icon"></ion-icon>
                    Attendance
                </h3>
                <p class="section-desc">Select options below to download</p>
            </div>
        </div>


        <form action="download-school-attendance-for-student.php" method="POST" class="col-md-5 card p-4">
            <div class="form-floating mb-3">
                <select class="form-select" name="attendance_class_id" id="selectClass"
                    aria-label="Floating label select example">
                    <option selected>Select Class</option>
                    <?php
                    $get_class = "SELECT * FROM `classes` WHERE `class_added_by` = $session_user_id";
                    $get_class_r = mysqli_query($connection, $get_class);
                    while ($row = mysqli_fetch_assoc($get_class_r)) {
                        $class_id = $row['class_id'];
                        $class_name = $row['class_name'];
                        $class_section = $row['class_section'];
                    ?>
                    <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                    <?php } ?>
                </select>
                <label for="selectClass">Click here for options</label>
            </div>

            <div class="d-flex mb-3">
                <div class="form-floating m-1 w-100">
                    <input type="date" class="form-control" name="attendance_from_date" id="fromDate"
                        placeholder="name@example.com">
                    <label for="fromDate">From</label>
                </div>

                <div class="form-floating m-1 w-100">
                    <input type="date" class="form-control" name="attendance_to_date" id="toDate"
                        placeholder="name@example.com">
                    <label for="toDate">To</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="fileType" name="attendance_file_type"
                    aria-label="Floating label select example">
                    <option selected>Type</option>
                    <option value="1">Excel</option>
                    <!-- <option value="2">PDF</option> -->
                </select>
                <label for="fileType">Click here for options</label>
            </div>
            <input type="submit" name="download" class="btn btn-outline-success" value="Download">
            <!-- <button type="submit" name="download" class="btn btn-outline-success">Download</button> -->
        </form>

    </div>
</div>
<?php include('main/footer.php'); ?>