<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard w-100">
        <p>Showing all activites uploaded for the selected class</p>
        <?php
        if (isset($_POST['enable'])) {
            $ac_id = $_POST['ac_id'];
            $ac_status = $_POST['ac_status'];

            $update = "UPDATE `activity` SET `ac_status`= '$ac_status' WHERE `ac_id` = $ac_id";
            $update_res = mysqli_query($connection, $update);

            if (!$update_res) {
                echo "<div class='alert alert-danger mb-3' role='alert'>
                Error !
            </div>";
            } else {
                echo "<div class='alert alert-success mb-3' role='alert'>
                Activity Enabled!
            </div>";
            }
        }

        if (isset($_POST['disable'])) {
            $ac_id = $_POST['ac_id'];
            $ac_status = $_POST['ac_status'];

            $update = "UPDATE `activity` SET `ac_status`= '$ac_status' WHERE `ac_id` = $ac_id";
            $update_res = mysqli_query($connection, $update);

            if (!$update_res) {
                echo "<div class='alert alert-danger mb-3' role='alert'>
                Error !
            </div>";
            } else {
                echo "<div class='alert alert-danger mb-3' role='alert'>
                Activity Disabled!
            </div>";
            }
        }

        if (isset($_POST['delete'])) {
            $ac_id = $_POST['ac_id'];

            $delete = "DELETE FROM `activity` WHERE ac_id = '$ac_id'";
            $delete_res = mysqli_query($connection, $delete);

            if (!$delete_res) {
                echo "<div class='alert alert-danger mb-3' role='alert'>Error !</div>";
            } else {
                echo "<div class='alert alert-danger mb-3' role='alert'>Activity Deleted!</div>";
            }
        }


        if (isset($_POST['submit'])) {
            $class_name = $_POST['class_name'];

            $results_per_page = 8;
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

            $query = "SELECT * FROM activity WHERE ac_class_name = '$class_name' LIMIT " . $page_first_result . ',' . $results_per_page;
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 0) { ?>

        <div class="alert alert-danger mb-3" role="alert">
            No activity uploaded for this class
        </div>

        <?php } elseif ($count > 0) { ?>
        <div class="tab-wrap-view">
            <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ac_id = $row['ac_id'];
                        $ac_name = $row['ac_name'];
                        $ac_details = $row['ac_details'];
                        $ac_file = "assets/activities/" . $row['ac_file'];
                        $ac_thumbnail_file = "assets/activities/" . $row['ac_thumbnail_file'];
                        $ac_status = $row['ac_status'];
                        $ac_added_date = $row['ac_added_date'];

                        $ac_thumbnail_file_ext = pathinfo($ac_thumbnail_file, PATHINFO_EXTENSION);
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

                        if ($ac_thumbnail_file_ext == "png") {
                            $ac_thumb_file_ext_img = "assets/images/icons/pdf_logo.png";
                        }
                        if ($ac_thumbnail_file_ext == "jpg") {
                            $ac_thumb_file_ext_img = "assets/images/icons/word_logo.webp";
                        }
                        if ($ac_thumbnail_file_ext == "jpeg") {
                            $ac_thumb_file_ext_img = "assets/images/icons/excel_logo.png";
                        }
                        if ($ac_thumbnail_file_ext == "webp") {
                            $ac_thumb_file_ext_img = "assets/images/icons/powerpoint_logo.webp";
                        }
                        if ($ac_thumbnail_file_ext == "mp4") {
                            $ac_thumb_file_ext_img = "assets/images/icons/powerpoint_logo.webp";
                        }
                    ?>
            <div class="activity-holder">
                <div class="activity-media-holder">
                    <?php if (
                                    $ac_thumbnail_file_ext == "png" ||
                                    $ac_thumbnail_file_ext == "jpg" ||
                                    $ac_thumbnail_file_ext == "jpeg" ||
                                    $ac_thumbnail_file_ext == "webp"
                                ) { ?>
                    <img src="<?php echo $ac_thumbnail_file ?>" alt="" class="activity-img">

                    <?php } elseif ($ac_thumbnail_file_ext == "mp4") { ?>
                    <video class="activity-video" autoplay loop controls>
                        <source src="<?php echo $ac_thumbnail_file ?>" type="video/ogg">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    <?php } ?>
                </div>

                <div class="activity-details-holder">

                    <p class="activity-name"><?php echo $ac_name ?></p>
                    <p class="m-0 activity-date"><?php echo $ac_added_date ?></p>

                    <form action="" method="POST" class="activity-btn-holder">
                        <input type="text" name="ac_id" value="<?php echo $ac_id ?>" hidden>
                        <a target="_blank" href="<?php echo $ac_file ?>" class="activity-download-file m-1">
                            <ion-icon name="download-outline"></ion-icon>
                        </a>
                        <?php if ($ac_status == 1) { ?>
                        <input type="text" name="ac_status" value="2" hidden>
                        <button type="submit" name="disable"
                            class="activity-btn btn btn-outline-danger m-1">Disable</button>
                        <?php } elseif ($ac_status == 2) { ?>
                        <input type="text" name="ac_status" value="1" hidden>
                        <button type="submit" name="enable"
                            class="activity-btn btn btn-outline-success m-1">Enable</button>
                        <?php } ?>
                        <button class="activity-btn btn btn-outline-primary m-1">Know more</button>


                        <button type="submit" name="delete" class="activity-del-btn m-1">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>

                </div>
            </div>
            <!-- <div class="pagination-holder">
                <nav aria-label="Page navigation example" class="mt-3">
                    <ul class="pagination">
                        <?php
                        for ($page = 1; $page <= $number_of_page; $page++) {
                            echo '<li class="page-item"><a class="page-link" href = "admin-show-activity.php?page=' . $page . '">' . $page . ' </a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div> -->
            <?php }
                }
            } ?>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>