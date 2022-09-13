<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container ">
        <p>Upload Activity</p>

        <?php
        if (isset($_POST['upload'])) {
            $activity_class = $_POST['activity_class'];
            $activity_name = $_POST['activity_name'];
            $ac_details = mysqli_real_escape_string($connection, $_POST['ac_details']);

            $activity_file = $_FILES["activity_file"]["name"];
            $activity_file_temp = $_FILES["activity_file"]["tmp_name"];
            $folder = "assets/activities/" . $activity_file;

            $activity_thumbnail_file = $_FILES["activity_thumbnail_file"]["name"];
            $activity_thumbnail_file_temp = $_FILES["activity_thumbnail_file"]["tmp_name"];
            $folder2 = "assets/activities/" . $activity_thumbnail_file;

            $activity_status = 1;

            $insert_query = "INSERT INTO `activity`(
                `ac_class_name`,
                `ac_name`,
                `ac_details`,
                `ac_file`,
                `ac_thumbnail_file`,
                `ac_status`
            )
            VALUES(
                '$activity_class',
                '$activity_name',
                '$ac_details',
                '$activity_file',
                '$activity_thumbnail_file',
                '$activity_status'
                )";
            $insert_result = mysqli_query($connection, $insert_query);
            if (!$insert_result) {
                die(mysqli_error($connection));
            } else {
                if (move_uploaded_file($activity_file_temp, $folder)) {
                    if (move_uploaded_file($activity_thumbnail_file_temp, $folder2)) {
                        echo "<div class='alert alert-success mb-3' role='alert'>$activity_name uploaded successfully!</div>";
                    }
                } else {
                    echo "<div class='alert w-100 alert-danger mb-3' role='alert'>There was some error</div>";
                }
            }
        }
        ?>

        <form class="card p-3 col-md-6" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Activity Thumbnail (jpeg | jpg | png )</label>
                <input class="form-control" type="file" name="activity_thumbnail_file" id="formFile">
            </div>
            <div class="form-floating mb-3">
                <select required class="form-select" name="activity_class" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Select Class</option>
                    <?php
                    $query = "SELECT * FROM `classes` GROUP BY class_name";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $class_name = $row['class_name'];
                    ?>
                    <option value="<?php echo $class_name ?>"><?php echo $class_name ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Click here to get list of classes</label>
            </div>

            <div class="form-floating mb-3">
                <input required type="text" class="form-control" name="activity_name" id="floatingInput"
                    placeholder="Activity Name">
                <label for="floatingInput">Activity Name</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="ac_details" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Details</label>
            </div>

            <div class="mb-4">
                <label for="formFile" class="form-label">Upload File (jpeg | jpg | png | pdf | word )</label>
                <input class="form-control" type="file" name="activity_file" id="formFile">
            </div>

            <div class="mb-3">
                <button type="submit" name="upload" class="btn btn-outline-success w-100">Upload</button>
            </div>
        </form>
    </div>
</div>
<?php include('main/footer.php') ?>