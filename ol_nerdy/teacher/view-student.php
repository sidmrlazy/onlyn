<div class="container section-container mb-5">
    <div class="section-header">
        <h3>View Student</h3>
        <p>View all students added by you</p>
    </div>

    <div class="tab-wrap-view">
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        $fetch_teachers = "SELECT * FROM `students` WHERE student_added_by = $session_user_id";
        $fetch_tacher_result = mysqli_query($connection, $fetch_teachers);
        while ($row = mysqli_fetch_assoc($fetch_tacher_result)) {
            $student_id = $row['student_id'];
            $student_name = $row['student_name'];
            $student_assigned_class = $row['student_assigned_class'];
            $student_status = $row['student_status'];
        ?>
        <form action="edit-student.php" method="POST" class="inner-tab-student">
            <input type="text" name="student_id" value="<?php echo $student_id; ?>" hidden>
            <p class="profile-teacher-name"><?php echo $student_name; ?></p>
            <p>Class: <?php echo $student_assigned_class; ?></p>

            <button type="submit" name="edit" class="mb-3 btn btn-outline-warning">Edit Student</button>
        </form>
        <?php
        } ?>
    </div>
</div>