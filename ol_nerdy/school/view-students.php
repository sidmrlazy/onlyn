<div class="container section-container mb-5">
    <div class="section-header">
        <h3>View Students</h3>
        <p>Check out all the students in your school.</p>
    </div>


    <div class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Class Teacher</th>
                    <th scope="col">Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }

                $fetch_teachers = "SELECT * FROM users WHERE user_added_by = $session_user_id AND user_type = 3";
                $fetch_teachers_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_teachers_result)) {
                    $teacher_id = $row['user_id'];
                    $teacher_name = $row['user_name'];

                    $fetch_student = "SELECT * FROM students WHERE student_added_by = $teacher_id";
                    $fetch_student_result = mysqli_query($connection, $fetch_student);
                    while ($row = mysqli_fetch_assoc($fetch_student_result)) {
                        $student_id = $row['student_id'];
                        $student_name = $row['student_name'];
                        $student_assigned_class = $row['student_assigned_class'];
                        $student_added_by = $row['student_added_by'];
                        if ($student_added_by == $teacher_id) {
                            $teacher_name;
                        }

                        $fetch_class = "SELECT * FROM classes WHERE class_teacher = $student_added_by";
                        $fetch_class_res = mysqli_query($connection, $fetch_class);
                        while ($row = mysqli_fetch_assoc($fetch_class_res)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                            $student_id;
                            $student_name;
                            $teacher_name;
                            if ($class_id == $student_assigned_class) {
                                $student_class = $class_name . $class_section;
                            }
                ?>
                <tr>
                    <th scope="row"><?php echo $student_id ?></th>
                    <td><?php echo $student_name ?></td>
                    <td><?php echo $teacher_name ?></td>
                    <td><?php echo $student_class ?></td>

                </tr>
                <?php
                        }
                    }
                } ?>
            </tbody>
        </table>
    </div>
</div>