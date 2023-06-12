<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>

<?php
require('includes/connection.php');
if (isset($_POST['view'])) {
    $student_id = $_POST['student_id'];

    $query = "SELECT * FROM `bora_student` WHERE `student_id` = '$student_id'";
    $res = mysqli_query($connection, $query);

    $student_id = "";
    $student_name = "";
    $student_aadhar_file = "";
    $student_aadhar_back_file = "";

    while ($row = mysqli_fetch_assoc($res)) {
        $student_id = $row['student_id'];
        $student_name = $row['student_name'];
        $student_aadhar_file = "assets/student_aadhar_image/" . $row['student_aadhar_file'];
        $student_aadhar_back_file = "assets/student_aadhar_image/" . $row['student_aadhar_back_file'];
    }
}

?>
<div class="container user-form-container">
    <div class="page-marker">
        <a href="view-students.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Aadhaar Card Images</h5>
    </div>
    <div class="doc-row w-100">
        <div class="col-md-6 doc-img">
            <form action="aadhar-image-update.php" method="POST" enctype="multipart/form-data" class="">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                <img src="<?php echo $student_aadhar_file ?>" alt="">
                <p>Front Image</p>
                <div class="mb-3">
                    <input class="form-control" name="student_aadhar_file" type="file" id="formFile">
                </div>
                <button type="submit" name="front" class="w-100 btn btn-outline-success">Change/Upload Image</button>
            </form>
        </div>

        <div class="col-md-6 doc-img">
            <form action="aadhar-back-image-update.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                <img src="<?php echo $student_aadhar_back_file ?>" alt="">
                <p>Back Image</p>
                <div class="mb-3">
                    <input class="form-control" name="student_aadhar_back_file" type="file" id="formFile">
                </div>
                <button type="submit" name="back" class="w-100 btn btn-outline-success">Change/Upload Image</button>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>