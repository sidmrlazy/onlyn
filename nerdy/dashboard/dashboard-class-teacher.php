<div class="container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard">
        <p class="mb-3">
            <ion-icon id="light-blue-icon" name="home"></ion-icon> Dashboard
        </p>
        <div class="tab-pill-grid animate__animated animate__fadeIn">


            <div class="tab-pill">
                <div class="tab-row">
                    <ion-icon name="person-outline" id="green-icon" class="tab-pill-icon"></ion-icon>
                    <p class="tab-label">Students in your class</p>
                    <?php
                    require_once('main/config.php');

                    $fetch_teacher = "SELECT * FROM students WHERE student_added_by = $session_user_id";
                    $fetch_teacher_result = mysqli_query($connection, $fetch_teacher);
                    $fetch_teacher_count = mysqli_num_rows($fetch_teacher_result); ?>
                    <p class="tab-top-res"><?php echo $fetch_teacher_count ?></p>
                </div>
            </div>
            <div class="d-none tab-pill"></div>
        </div>


        <div class="mt-4 animate__animated animate__fadeIn">
            <?php
            require_once('main/config.php');
            $fetch_user_details = "SELECT * FROM users WHERE user_id = $session_user_id";
            $fetch_user_res = mysqli_query($connection, $fetch_user_details);

            $user_added_by = "";
            while ($row = mysqli_fetch_assoc($fetch_user_res)) {
                $user_added_by = $row['user_added_by'];
            }

            $query = "SELECT * FROM announcement WHERE ann_to = $session_user_id OR ann_to_type = 3 AND ann_by = $user_added_by";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $ann_topic = $row['ann_topic'];
                $ann_status = $row['ann_status'];
                if ($ann_status == 1) { ?>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <div class="alert alert-danger d-flex align-items-center animate__animated animate__headShake animate__infinite infinite"
                role="alert">
                <div class="announcement-card-dashboard">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>

                    <p class="ann-topic-holder-dashboard"><?php echo $ann_topic ?></p>
                    <a class="btn btn-sm btn-outline-danger" href="announcement-teacher.php">Read</a>
                </div>
            </div>

            <?php } else if ($ann_status == 2) { ?>
            <div class="announcement-card d-none ">
                <p class="ann-topic-holder"><?php echo $ann_topic ?></p>
                <a class="btn btn-sm btn-outline-success" href="announcement-teacher.php">Read More</a>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- =================== SUBJECTS ASSIGNED START =================== -->
        <div class="section-header animate__animated animate__fadeIn">
            <h3 class="section-heading-dashboard">
                <ion-icon name="calendar-outline" class="section-heading-icon"></ion-icon>
                Subjects Assigned
            </h3>
        </div>
        <div class="mt-4 animate__animated animate__fadeIn">
            <div class="tab-wrap-view mb-3">
                <?php
                $get_subejcts = "SELECT * FROM `teacher_class_assignment` WHERE `teacher_assigned` = $session_user_id";
                $get_subject_res = mysqli_query($connection, $get_subejcts);

                while ($row = mysqli_fetch_assoc($get_subject_res)) {
                    $teacher_assigned_subject = $row['teacher_assigned_subject'];
                    $teacher_assigned_class = $row['teacher_assigned_class'];

                    $fetch_class = "SELECT * FROM classes WHERE class_id = '$teacher_assigned_class'";
                    $fetch_class_res = mysqli_query($connection, $fetch_class);

                    $class_name = "";
                    $class_section = "";
                    while ($row = mysqli_fetch_assoc($fetch_class_res)) {
                        $class_name = $row['class_name'];
                        $class_section = $row['class_section'];
                    } ?>

                <div class="dashboard-tabs">
                    <p class="dashboard-tab-label"><?php echo $teacher_assigned_subject ?> |</p>
                    <p class="dashboard-tab-subject">Class <?php echo $class_name . $class_section ?></p>
                    <!-- <p><?php echo $tt_time . " (" . $tt_day . ")" ?></p> -->
                </div>

                <?php
                }

                ?>
            </div>
        </div>


        <!-- =================== TEACHING SCHEDULE START =================== -->
        <p class="mb-3">
            <ion-icon id="pale-orange" name="calendar"></ion-icon> Your teaching schedule
        </p>

        <!-- <div class="section-header animate__animated animate__fadeIn">
            <h3 class="section-heading-dashboard">
                <ion-icon name="calendar-outline" class="section-heading-icon"></ion-icon>
                Your teaching schedule
            </h3>
        </div> -->
        <div class="mt-4 animate__animated animate__fadeIn">
            <div class="tab-wrap-view">
                <?php
                $date_today = date('D');
                $select_query = "SELECT * FROM `time_table` WHERE tt_teacher = '$session_user_id' ORDER BY `tt_time` ASC";
                $select_query_res = mysqli_query($connection, $select_query);
                while ($row = mysqli_fetch_assoc($select_query_res)) {
                    $tt_class = $row['tt_class'];
                    $tt_subject = $row['tt_subject'];
                    $tt_time = $row['tt_time'];
                    $tt_day = $row['tt_day'];

                    if ($tt_day == 1) {
                        $tt_day = "Mon";
                    }
                    if ($tt_day == 2) {
                        $tt_day = "Tue";
                    }
                    if ($tt_day == 3) {
                        $tt_day = "Wed";
                    }
                    if ($tt_day == 4) {
                        $tt_day = "Thur";
                    }
                    if ($tt_day == 5) {
                        $tt_day = "Fri";
                    }
                    if ($tt_day == 6) {
                        $tt_day = "Sat";
                    }
                    if ($tt_day == 7) {
                        $tt_day = "Sun";
                    }
                    if ($tt_day == $date_today) {
                        if ($tt_class) {
                            $fetch_class = "SELECT * FROM classes WHERE class_id = $tt_class";
                            $fetch_class_res = mysqli_query($connection, $fetch_class);
                            $class_name = "";
                            $class_section = "";
                            while ($row = mysqli_fetch_assoc($fetch_class_res)) {
                                $class_name = $row['class_name'];
                                $class_section = $row['class_section'];
                            }
                            $tt_class = $class_name . $class_section;
                        }
                ?>
                <div class="dashboard-tabs">
                    <p class="dashboard-tab-label">Class <?php echo $tt_class ?> |</p>
                    <p class="dashboard-tab-subject"><?php echo $tt_subject ?></p>
                    <p><?php echo $tt_time . " (" . $tt_day . ")" ?></p>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <!-- =================== TEACHING SCHEDULE END =================== -->
    </div>
</div>