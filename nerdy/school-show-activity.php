<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container ">
        <p>Showing all activites uploaded for the selected class</p>

        <?php

        if (isset($_POST['submit'])) {
            $class_name = $_POST['class_name'];

            $results_per_page = 10;
            $fetch_all = "SELECT * FROM activity";
            $result_all = mysqli_query($connection, $fetch_all);
            $number_of_result = mysqli_num_rows($result_all);

            $number_of_page = ceil($number_of_result / $results_per_page);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $page_first_result = ($page - 1) * $results_per_page;

            $query = "SELECT * FROM activity WHERE ac_class_name = '$class_name' AND `ac_status` = 1 LIMIT " . $page_first_result . ',' . $results_per_page;
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 0) { ?>
        <div class="alert alert-danger mb-3" role="alert">
            No activity uploaded for this class
        </div>
        <?php
            } else if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $ac_id = $row['ac_id'];
                    $ac_name = $row['ac_name'];
                    $ac_details = $row['ac_details'];
                    $ac_file = "assets/activities/" . $row['ac_file'];
                    $ac_status = $row['ac_status'];
                    if ($ac_status == 1) {
                        $ac_status_name = "Active";
                    }
                    if ($ac_status == 2) {
                        $ac_status_name = "Disabled";
                    }

                    $ac_file_ext = pathinfo($ac_file, PATHINFO_EXTENSION);

                    if ($ac_file_ext == "pdf") {
                        $ac_file_ext_img = "assets/images/icons/pdf_logo.png";
                    }
                    if ($ac_file_ext == "docx") {
                        $ac_file_ext_img = "assets/images/icons/word_logo.webp";
                    }
                    if ($ac_file_ext == "xlsx") {
                        $ac_file_ext_img = "assets/images/icons/excel_logo.png";
                    }
                    if ($ac_file_ext == "pptx") {
                        $ac_file_ext_img = "assets/images/icons/powerpoint_logo.webp";
                    }
                ?>
        <div class="activity-bar">

            <div class="activity-details">
                <p class="activity-name"><?php echo $ac_name ?></p>
                <p class="activity-details"><?php echo $ac_details ?></p>
            </div>

            <a class="admin-section-file" target="_blank" href="<?php echo $ac_file ?>"><?php echo $ac_file ?>
                <img src="<?php echo $ac_file_ext_img ?>" alt="" class="activity-bar-img">
            </a>


        </div>
        <?php
                }
            } ?>
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation example" class="mt-3">
                <ul class="pagination">

                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {
                        echo '<li class="page-item"><a class="page-link" href = "index2.php?page=' . $page . '">' . $page . ' </a></li>';
                    }
                }
                    ?>

                </ul>
            </nav>
        </div>



    </div>
</div>
<?php include('main/footer.php') ?>