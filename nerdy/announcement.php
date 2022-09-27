<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="megaphone" class="section-heading-icon"></ion-icon>
                Announcements
            </h3>
            <p class="section-desc">Choose who you want to announce to. Enter the subject and details of the
                announcement you want to announce below.</p>
        </div>

        <form method="POST" action="announcement_topic.php" class="card p-4">
            <div onclick="showDropDown()" class="form-floating mb-3">
                <select id="showClassDropDown" name="ann_to_type" class="form-select" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Announce to?</option>
                    <!-- <option value="1">Send to Individual class</option>
                    <option value="2">Send to all Classes</option> -->
                    <option value="3">Send to all Teachers</option>
                    <option value="4">Send to Individual Teachers</option>
                </select>
                <label for="floatingSelect">Click here for dropdown menu</label>
            </div>

            <!-- <div id="selectClass" class="form-floating mb-3" style="display: none;">
                <select name="ann_to_class" class="form-select" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Select Class</option>
                    <?php
                    $fetch_class = "SELECT * FROM classes WHERE class_added_by = $session_user_id";
                    $fetch_class_result = mysqli_query($connection, $fetch_class);
                    while ($row = mysqli_fetch_assoc($fetch_class_result)) {
                        $class_id = $row['class_id'];
                        $class_name = $row['class_name'];
                        $class_section = $row['class_section'];
                    ?>
                    <option value="<?php echo $class_id; ?>"><?php echo $class_name . $class_section; ?>
                    </option>
                    <?php
                    } ?>
                </select>
                <label for="floatingSelect">Click here for dropdown menu</label>
            </div> -->

            <div id="selectIndividualTeacher" class="form-floating mb-3" style="display: none;">
                <select name="ann_to_teacher" class="form-select" id="floatingSelect"
                    aria-label="Floating label select example">
                    <?php
                    $fetch_teacher = "SELECT * FROM users WHERE user_added_by = $session_user_id AND user_status = 1";
                    $fetch_teacher_result = mysqli_query($connection, $fetch_teacher);
                    while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                        $teacher_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_type = $row['user_type'];

                        if ($user_type == 3 || $user_type == 5) {
                    ?>
                    <option value="<?php echo $teacher_id; ?>"><?php echo $user_name; ?></option>
                    <?php
                        }
                    } ?>
                </select>
                <label for="floatingSelect">Click here for dropdown menu</label>
            </div>


            <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
        </form>

        <div class="section-header mt-5">
            <h3 class="section-heading">
                <ion-icon name="receipt" class="section-heading-icon"></ion-icon>
                Past Announcement
            </h3>
            <p class="section-desc">View past announcements made by you</p>
        </div>
        <div class="ann-grid">
            <?php
            if (!empty($_SESSION['user_type'])) {
                $session_user_id = $_SESSION['user_id'];
            } else {
                $session_user_id = 0;
            }

            if (isset($_POST['delete'])) {
                $ann_id = $_POST['ann_id'];
                $delete = "DELETE FROM `announcement` WHERE `ann_id` = $ann_id";
                $del_r = mysqli_query($connection, $delete);
            }

            $query = "SELECT * FROM announcement WHERE ann_by = $session_user_id ORDER BY ann_id DESC";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $ann_id = $row['ann_id'];
                $ann_topic = $row['ann_topic'];
                $ann_details = $row['ann_details'];
                $ann_to_type = $row['ann_to_type'];
                if ($ann_to_type == 1) {
                    $ann_to_type = "Individual Class";
                } else if ($ann_to_type == 2) {
                    $ann_to_type = "All Classes";
                } else if ($ann_to_type == 3) {
                    $ann_to_type = "All Teachers";
                } else if ($ann_to_type == 4) {
                    $ann_to_type = "Individual Teacher";
                }
                $ann_to = $row['ann_to'];
                if ($ann_to == 0) {
                    $ann_to = "Sent to all";
                }
                $ann_date = $row['ann_date']; ?>
            <form action="" method="POST" class="ann-box">
                <input type="text" name="ann_id" value="<?php echo $ann_id ?>" hidden>
                <div class="ann-inner">
                    <p class="ann-topic"><?php echo $ann_topic ?></p>
                    <p class="ann-date"><?php echo $ann_date ?></p>
                </div>
                <button type="submit" name="delete" class="del-ann-btn">
                    <ion-icon name="trash-outline"></ion-icon>
                </button>
            </form>
            <?php
            } ?>

        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>