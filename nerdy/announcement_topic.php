<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php') ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="megaphone" class="section-heading-icon"></ion-icon>
                Announcement Details
            </h3>
            <p class="section-desc">Enter the subject and details of the
                announcement you want to announce below.</p>
        </div>

        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        $ann_to_type = $_POST['ann_to_type'];
        $ann_to_class = $_POST['ann_to_class'];
        $ann_to_teacher = $_POST['ann_to_teacher'];


        if (isset($_POST['announce'])) {
            $ann_to_type = $_POST['ann_to_type'];
            $ann_to_class = $_POST['ann_to_class'];
            $ann_to_teacher = $_POST['ann_to_teacher'];

            // Individual Class = 1
            if ($ann_to_type == 1) {
                $query = "SELECT * FROM classes WHERE class_id = $ann_to_class";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("ERROR 404: " . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $class_id = $row['class_id'];
                }
                $ann_topic = $_POST['ann_topic'];
                $ann_details = $_POST['ann_details'];
                $ann_to_type = $_POST['ann_to_type'];
                $class_id;
                $ann_status = 1;

                $insert_query = "INSERT INTO `announcement`(
             `ann_topic`, 
             `ann_details`, 
             `ann_to_type`, 
             `ann_to`, 
             `ann_status`, 
             `ann_by`) VALUES (
                 '$ann_topic',
                 '$ann_details',
                 '$ann_to_type',
                 '$class_id',
                 '$ann_status',
                 '$session_user_id')";
                $insert_result = mysqli_query($connection, $insert_query);
                if (!$insert_result) {
                    die("ERROR: " . mysqli_error($connection));
                } else {

                    echo '<script>announced()</script>';
                }
            }
            // All Classes = 2 
            else if ($ann_to_type == 2) {
                $query = "SELECT * FROM classes";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("ERROR 404: " . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $class_id = $row['class_id'];
                }
                $ann_topic = $_POST['ann_topic'];
                $ann_details = $_POST['ann_details'];
                $ann_to_type = $_POST['ann_to_type'];
                $class_id = 0;
                $ann_status = 1;

                $insert_query = "INSERT INTO `announcement`(
             `ann_topic`, 
             `ann_details`, 
             `ann_to_type`, 
             `ann_to`, 
             `ann_status`, 
             `ann_by`) VALUES (
                 '$ann_topic',
                 '$ann_details',
                 '$ann_to_type',
                 '$class_id',
                 '$ann_status',
                 '$session_user_id')";
                $insert_result = mysqli_query($connection, $insert_query);
                if (!$insert_result) {
                    die("ERROR TYPE 2: " . mysqli_error($connection));
                } else {
                    echo '<script>announced()</script>';
                }
            }

            // All Teachers = 3
            else if ($ann_to_type == 3) {
                $query = "SELECT * FROM users WHERE user_type = 3 AND user_added_by = $session_user_id";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("ERROR 404: " . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                }
                $ann_topic = $_POST['ann_topic'];
                $ann_details = $_POST['ann_details'];
                $ann_to_type = $_POST['ann_to_type'];
                $user_id = 0;
                $ann_status = 1;

                $insert_query = "INSERT INTO `announcement`(
             `ann_topic`, 
             `ann_details`, 
             `ann_to_type`, 
             `ann_to`, 
             `ann_status`, 
             `ann_by`) VALUES (
                 '$ann_topic',
                 '$ann_details',
                 '$ann_to_type',
                 '$user_id',
                 '$ann_status',
                 '$session_user_id')";
                $insert_result = mysqli_query($connection, $insert_query);
                if (!$insert_result) {
                    die("ERROR TYPE 3: " . mysqli_error($connection));
                } else {
                    $fetch_schools = "SELECT * FROM `users`";
                    $fetch_schools_res = mysqli_query($connection, $fetch_schools);

                    while ($row = mysqli_fetch_assoc($fetch_schools_res)) {
                        $user_type = $row['user_type'];
                        $user_email = $row['user_email'];

                        if (
                            $user_type == 3 ||
                            $user_type == 6
                        ) {
                            $email_img = "https://onlynus.com/nerdy/assets/images/vectors/ann-vec.png";
                            $email_to = $user_email;
                            $email_subject = "New Announcement";
                            $email_body = "<img src='" . $email_img . "' />";

                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= 'From: <connectonlyn@onlynus.com>' . "\r\n";
                        }
                    }
                    echo '<script>announced()</script>';
                }
            }

            // Individual Teacher = 4
            else if ($ann_to_type == 4) {
                $query = "SELECT * FROM users WHERE user_id = $ann_to_teacher";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("ERROR 404: " . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                }
                $ann_topic = $_POST['ann_topic'];
                $ann_details = $_POST['ann_details'];
                $ann_to_type = $_POST['ann_to_type'];
                $user_id;
                $ann_status = 1;

                $insert_query = "INSERT INTO `announcement`(
             `ann_topic`, 
             `ann_details`, 
             `ann_to_type`, 
             `ann_to`, 
             `ann_status`, 
             `ann_by`) VALUES (
                 '$ann_topic',
                 '$ann_details',
                 '$ann_to_type',
                 '$user_id',
                 '$ann_status',
                 '$session_user_id')";
                $insert_result = mysqli_query($connection, $insert_query);
                if (!$insert_result) {
                    die("ERROR TYPE 4: " . mysqli_error($connection));
                } else {
                    $fetch_schools = "SELECT * FROM `users` WHERE user_id = $user_id";
                    $fetch_schools_res = mysqli_query($connection, $fetch_schools);
                    $user_email = "";
                    while ($row = mysqli_fetch_assoc($fetch_schools_res)) {
                        $user_type = $row['user_type'];
                        $user_email = $row['user_email'];
                    }
                    $email_img = "https://onlynus.com/nerdy/assets/images/vectors/ann-vec.png";
                    $email_to = $user_email;
                    $email_subject = "New Announcement";
                    $email_body = "<img src='" . $email_img . "' />";

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <connectonlyn@onlynus.com>' . "\r\n";


                    echo '<script>announced()</script>';
                }
            }
        }
        ?>

        <form method="POST" action="" class="card mob-card p-5">

            <input type="text" name="ann_to_type" value="<?php echo $ann_to_type; ?>" hidden>
            <input type="text" name="ann_to_class" value="<?php echo $ann_to_class; ?>" hidden>
            <input type="text" name="ann_to_teacher" value="<?php echo $ann_to_teacher; ?>" hidden>

            <div class="form-floating mb-3">
                <input type="text" name="ann_topic" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Topic</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="ann_details" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
            </div>

            <button type="submit" name="announce" class="btn btn-primary">Announce</button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>