<div class="mt-3">
    <div class="tab-pill-grid">
        <div class="tab-pill animate__animated animate__fadeIn">
            <div class="tab-row">
                <ion-icon name="person-outline" id="green-icon" class="tab-pill-icon"></ion-icon>
                <p class="tab-label">All Teachers</p>
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }
                $fetch_teacher = "SELECT * FROM users WHERE user_added_by = $session_user_id";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teacher);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $user_type = $row['user_type'];
                }
                $fetch_teacher_count = "";
                if ($user_type == 3 || $user_type == 5) {
                    $fetch_teacher_count = mysqli_num_rows($fetch_teacher_result);
                }

                ?>
                <p class="tab-top-res"><?php echo $fetch_teacher_count ?></p>
            </div>


            <?php
            $fetch_count = "SELECT * FROM subscription WHERE subscription_user_id = $session_user_id";
            $fetch_count_result = mysqli_query($connection, $fetch_count);
            while ($row = mysqli_fetch_assoc($fetch_count_result)) {
                $subscription_teacher_limit = $row['subscription_teacher_limit']; ?>
            <p class="tab-info">Available Login ID's: <?php echo $subscription_teacher_limit ?></p>
            <?php
            } ?>

        </div>

        <div class="tab-pill animate__animated animate__fadeIn">
            <div class="tab-row">
                <ion-icon name="person-circle-outline" id="red-icon" class="tab-pill-icon"></ion-icon>
                <p class="tab-label">All Students</p>
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }
                $fetch_student = "SELECT * FROM students WHERE student_assigned_school = $session_user_id";
                $fetch_student_result = mysqli_query($connection, $fetch_student);
                $fetch_student_count = mysqli_num_rows($fetch_student_result); ?>
                <p class="tab-top-res"><?php echo $fetch_student_count ?></p>
            </div>


            <?php
            $fetch_parent = "SELECT * FROM subscription WHERE subscription_user_id = $session_user_id";
            $fetch_parent_result = mysqli_query($connection, $fetch_parent);
            while ($row = mysqli_fetch_assoc($fetch_parent_result)) {
                $subscription_parent_limit = $row['subscription_parent_limit']; ?>
            <p class="tab-info" id="green">Available Login ID's: <?php echo $subscription_parent_limit ?></p>
            <?php
            } ?>

        </div>
    </div>
</div>