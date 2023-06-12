<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>

<div class="container user-form-container">
    <div class="page-marker">
        <a href="add-student.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Bulk Upload Student Data</h5>
    </div>
    <a href="assets/format/bora_student.csv" class="download-form-btn">Download Format <ion-icon
            name="download-outline"></ion-icon></a>
    <p>Note: Insert data into the columns of this .CSV file.
    <ul>
        <li>Do not insert any data in "student_id" column</li>
        <li>Do not insert any data in "student_img" column</li>
        <li>Do not insert any data in "student_aadhar_file" column</li>
        <li>Do not insert any data in "student_aadhar_back_file" column</li>
        <li>Do not insert any data in "student_added_date" column</li>
        <li>In the "student_added_by" column, kindly enter your name in Camel Case.</li>
    </ul>
    </p>


    <form class="add-user-form" method="POST" action="upload-data.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFile" class="form-label">Upload File</label>
            <input class="form-control" name="csvFile" type="file" id="formFile">
        </div>
        <button type="submit" name="submit" class="btn btn-outline-success w-100">Upload</button>
    </form>
</div>

<?php include('includes/footer.php') ?>