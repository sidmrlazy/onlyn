<?php include('main/header.php') ?>
<?php include('navbar/navbar.php') ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container">
        <?php
        if (isset($_POST['purchase'])) {
            $purchase_activity_id = $_POST['purchase_activity_id'];
            $purchase_user_id = $_POST['purchase_user_id'];
            $purchase_activity_amount = $_POST['purchase_activity_amount'];
            $purchase_status = 1;
        }

        if (isset($_POST['submit'])) {
            $class_name = $_POST['class_name'];

            $query = "SELECT * FROM activity WHERE ac_class_name = '$class_name' AND `ac_status` = 1 ";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 0) { ?>
        <div class="alert alert-danger mb-3" role="alert">
            No activity uploaded for this class
        </div>
        <?php
            } elseif ($count > 0) { ?>

        <div class="tab-wrap-view">
            <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ac_id = $row['ac_id'];
                        $ac_name = $row['ac_name'];
                        $ac_details = $row['ac_details'];
                        $ac_file = "assets/activities/" . $row['ac_file'];
                        $ac_thumbnail_file = "assets/activities/" . $row['ac_thumbnail_file'];
                        $ac_status = $row['ac_status'];
                        $ac_price = $row['ac_price'];
                        if ($ac_status == 1) {
                            $ac_status_name = "Active";
                        }
                        if ($ac_status == 2) {
                            $ac_status_name = "Disabled";
                        }

                        $ac_file_ext = pathinfo($ac_file, PATHINFO_EXTENSION);
                        $ac_thumbnail_file_ext = pathinfo($ac_thumbnail_file, PATHINFO_EXTENSION);

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

                        $fetch_cart = "SELECT * FROM `purchase` WHERE `purchase_user_id` = '$session_user_id' AND purchase_activity_id = $ac_id";
                        $fetch_cart_r = mysqli_query($connection, $fetch_cart);
                        $fetch_cart_count = mysqli_num_rows($fetch_cart_r);

                        if ($fetch_cart_count == 0) {
                    ?>
            <form action="purchase-activity.php" method="POST" class="school-activity-section">
                <input type="text" name="purchase_activity_id" value="<?php echo $ac_id ?>" hidden>
                <input type="text" name="purchase_user_id" value="<?php echo $session_user_id ?>" hidden>
                <input type="text" name="purchase_activity_amount" value="<?php echo $ac_price ?>" hidden>
                <div>
                    <?php if (
                                        $ac_thumbnail_file_ext == "png" ||
                                        $ac_thumbnail_file_ext == "jpg" ||
                                        $ac_thumbnail_file_ext == "jpeg" ||
                                        $ac_thumbnail_file_ext == "webp"
                                    ) { ?>
                    <img src="<?php echo $ac_thumbnail_file ?>" alt="" class="school-activity-img">
                    <?php } elseif ($ac_thumbnail_file_ext == "mp4") { ?>
                    <video class="school-activity-video" autoplay loop controls>
                        <source src="<?php echo $ac_thumbnail_file ?>" type="video/ogg">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>

                    <?php } ?>
                </div>
                <div class="school-act-content-section">
                    <div>
                        <p class="school-act-name"><?php echo $ac_name ?></p>
                        <div class="add-btn-row mb-3 mt-3">
                            <p class="school-act-price">₹<?php echo $ac_price ?></p>
                            <button type="submit" name="purchase" class="add-to-cart-btn">Purchase</button>
                        </div>
                    </div>
                    <button class="act-btn-details">Details</button>
                </div>
            </form>
            <?php
                        } else if ($fetch_cart_count > 0) { ?>
            <div class="school-activity-section">
                <div>
                    <?php if (
                                        $ac_thumbnail_file_ext == "png" ||
                                        $ac_thumbnail_file_ext == "jpg" ||
                                        $ac_thumbnail_file_ext == "jpeg" ||
                                        $ac_thumbnail_file_ext == "webp"
                                    ) { ?>
                    <img src="<?php echo $ac_thumbnail_file ?>" alt="" class="school-activity-img">
                    <?php } elseif ($ac_thumbnail_file_ext == "mp4") { ?>
                    <video class="school-activity-video" autoplay loop controls>
                        <source src="<?php echo $ac_thumbnail_file ?>" type="video/ogg">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>

                    <?php } ?>
                </div>
                <div class="school-act-content-section">
                    <div>
                        <p class="school-act-name"><?php echo $ac_name ?></p>
                    </div>
                    <a class="act-btn-details btn-outline-success">Download</a>
                </div>
            </div>
            <?php
                        }
                    }
                }
            } ?>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>