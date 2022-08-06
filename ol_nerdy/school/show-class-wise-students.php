<div class="container">


    <div class="container section-container table-responsive">
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        if (isset($_POST['submit'])) {
            $class_id = $_POST['class_id'];

            $query = "SELECT * FROM students WHERE student_assigned_class = $class_id";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);
        ?>

            <div class="notification mb-3">
                <p class="m-0">Total students in this class: <span><?php echo $count ?></span></p>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $student_id = $row['student_id'];
                        $student_name = $row['student_name'];
                    ?>
                        <tr>
                            <th scope="row"><?php echo $student_id ?></th>
                            <td><?php echo $student_name ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>


    </div>




</div>