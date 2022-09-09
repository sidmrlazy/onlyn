<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="easel" class="section-heading-icon"></ion-icon>
                Showing all Homework
            </h3>
            <p class="section-desc">Caption required</p>
        </div>

        <div class="tab-wrap-view">
            <?php
            if (isset($_POST['continue'])) {
                $hw_class = $_POST['hw_class'];
                $hw_date = $_POST['hw_date'];

                $query = "SELECT * FROM `home_work` WHERE `hw_class` = '$hw_class' AND `hw_date` = '$hw_date'";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);

                if ($count == 0) { ?>
            <div class="alert alert-danger" role="alert">No homework found for this class on this date!</div>
            <?php
                } else if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $hw_id = $row['hw_id'];
                        $hw_class = $row['hw_class'];
                        $hw_title = $row['hw_title'];
                        $hw_date = $row['hw_date'];
                    ?>
            <form action="" method="POST" class="hw-card">
                <button type="submit" name="open" class="hw-btn">
                    <input type="text" name="hw_id" value="<?php echo $hw_id ?>" hidden>
                    <p class="hw-card-title"><?php echo $hw_title ?></p>
                    <p class="hw-card-date"><?php echo $hw_date ?></p>
                </button>
            </form>
            <?php }
                }
            }
            if (isset($_POST['open'])) {
                $hw_id = $_POST['hw_id'];
                echo "<script>hwModal()</script>";
            }
            ?>

        </div>

        <!-- ============== HOMEWORK MODAL START ============== -->
        <div class="modal fade" id="hwModalOpen" tabindex="-1" aria-labelledby="hwModalOpenLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hwModalOpenLabel">Homework Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?php
                    $modal_query = "SELECT * FROM `home_work` WHERE `hw_id` = $hw_id";
                    $modal_res = mysqli_query($connection, $modal_query);
                    if ($modal_res) {
                        while ($row = mysqli_fetch_assoc($modal_res)) {
                            $hw_id = $row['hw_id'];
                            $hw_title = $row['hw_title'];
                            $hw_details = $row['hw_details'];
                            $hw_subject = $row['hw_subject'];
                            $hw_file = "assets/hw/" . $row['hw_file'];
                            $hw_date = $row['hw_date'];

                            $hw_file_ext = pathinfo($hw_file, PATHINFO_EXTENSION);

                            if ($hw_file_ext == "pdf") {
                                $hw_file_img = "assets/images/icons/pdf_logo.png";
                            }
                            if ($hw_file_ext == "docx") {
                                $hw_file_img = "assets/images/icons/word_logo.webp";
                            }
                            if ($hw_file_ext == "xlsx") {
                                $hw_file_img = "assets/images/icons/excel_logo.png";
                            }

                            if ($hw_file_ext == "pptx") {
                                $hw_file_img = "assets/images/icons/powerpoint_logo.webp";
                            }

                            $get_subject = "SELECT * FROM subjects WHERE subject_id = $hw_subject";
                            $get_res = mysqli_query($connection, $get_subject);
                            $subject_name = "";
                            while ($row = mysqli_fetch_assoc($get_res)) {
                                $subject_name = $row['subject_name'];
                            }
                        }
                    }

                    ?>
                    <div class="modal-body">
                        <input type="text" name="hw_id" value="<?php echo $hw_id ?>" hidden>
                        <p class="hw-modal-title"><?php echo $hw_title; ?></p>
                        <p class="mb-3">Subject: <?php echo $subject_name; ?></p>
                        <p class="hw-modal-details"><?php echo $hw_details; ?></p>
                        <p class="hw-modal-date"><?php echo $hw_date ?></p>
                        <a href="<?php echo $hw_file ?>" target="_blank" class="hw-modal-doc">
                            <img src="<?php echo $hw_file_img ?>" alt="">
                        </a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="submit" name="del" class="btn btn-primary">Delete</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ============== HOMEWORK MODAL END ============== -->

    </div>

</div>
<?php include('main/footer.php'); ?>