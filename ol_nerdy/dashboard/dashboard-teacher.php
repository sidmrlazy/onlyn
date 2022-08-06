<div class="container ">
    <div class="d-flex">
        <div class="info-pill">
            <p class="info-pill-label">Student's in your class</p>
            <?php
            require_once('main/config.php');
            if (!empty($_SESSION['user_type'])) {
                $session_user_id = $_SESSION['user_id'];
            } else {
                $session_user_id = 0;
            }
            $fetch_teacher_details = "SELECT * FROM classes WHERE class_teacher = $session_user_id";
            $fetch_teacher_details_result = mysqli_query($connection, $fetch_teacher_details);
            while ($row = mysqli_fetch_assoc($fetch_teacher_details_result)) {
                $class_id = $row['class_id'];
            }
            $fetch_student = "SELECT * FROM students WHERE student_added_by = $session_user_id AND student_assigned_class = $class_id";
            $fetch_student_result = mysqli_query($connection, $fetch_student);
            $fetch_student_count = mysqli_num_rows($fetch_student_result);
            ?>
            <p class="info-pill-response"><?php echo $fetch_student_count ?></p>
        </div>

        <div class="info-pill">
            <p class="info-pill-label">You have been assigned class:</p>
            <?php
            require_once('main/config.php');
            if (!empty($_SESSION['user_type'])) {
                $session_user_id = $_SESSION['user_id'];
            } else {
                $session_user_id = 0;
            }

            $query = "SELECT * FROM `classes` WHERE class_teacher = $session_user_id";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $class_id = $row['class_id'];
                $class_name = $row['class_name'];
                $class_section = $row['class_section'];

            ?>
                <p class="info-pill-response"><?php echo $class_name . $class_section; ?></p>
            <?php
            }
            ?>
        </div>
    </div>
</div>