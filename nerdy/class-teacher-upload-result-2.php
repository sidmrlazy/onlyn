<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="ribbon" class="section-heading-icon"></ion-icon>
                Select Exam | Test
            </h3>
            <p class="section-desc">Caption required</p>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $class_id = $_POST['exam_class_id'];

            $fetch_exam_query = "SELECT * FROM `exam` WHERE `exam_class_id` = '$class_id' AND exam_status = 1";
            $fetch_exam_query_res = mysqli_query($connection, $fetch_exam_query);
            $fetch_exam_count = mysqli_num_rows($fetch_exam_query_res);

            if ($fetch_exam_count == 0) { ?>

        <div class="alert alert-danger" role="alert">
            No exams or tests uploaded for this class!
        </div>
        <?php } elseif ($fetch_exam_count > 0) { ?>
        <form action="class-teacher-upload-result-3.php" method="POST" enctype="multipart/form-data"
            class="card p-4 col-md-4">
            <div class="form-floating mb-3">
                <select class="form-select" name="exam_id" id="examSubject" aria-label="Floating label select example">
                    <option selected>Select Exam | Test</option>
                    <?php while ($row = mysqli_fetch_assoc($fetch_exam_query_res)) {
                                $exam_id = $row['exam_id'];
                                $exam_title = $row['exam_title']; ?>
                    <option value="<?php echo $exam_id ?>"><?php echo $exam_title ?></option>
                    <?php } ?>
                </select>
                <label for="examSubject">Click here to get Exam list</label>
            </div>

            <div class="mb-3">
                <button type="submit" name="mark" class="btn w-100 btn-success">Continue</button>
            </div>
        </form>
        <?php }
        } ?>
    </div>
</div>
<?php include('main/footer.php'); ?>