<div class="container section-container mb-5">
    <div class="section-header">
        <h3>Announcement</h3>
        <p>Select announcement being sent to</p>
    </div>

    <form method="POST" action="announcement_topic.php" class="card p-5">
        <div onclick="showDropDown()" class="form-floating mb-3">
            <select id="showClassDropDown" name="ann_to_type" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option>Announce to?</option>
                <option value="1">Send to Individual class</option>
                <option value="2">Send to all Classes</option>
                <option value="3">Send to all Teachers</option>
                <option value="4">Send to Individual Teachers</option>
            </select>
            <label for="floatingSelect">Click here for dropdown menu</label>
        </div>

        <div id="selectClass" class="form-floating mb-3" style="display: none;">
            <select name="ann_to_class" class="form-select" id="floatingSelect" aria-label="Floating label select example">
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
        </div>

        <div id="selectIndividualTeacher" class="form-floating mb-3" style="display: none;">
            <select name="ann_to_teacher" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <!-- <option>Select Individual Teacher</option> -->
                <?php
                $fetch_teacher = "SELECT * FROM users WHERE user_added_by = $session_user_id AND user_type = 3 AND user_status = 1";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teacher);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $teacher_id = $row['user_id'];
                    $user_name = $row['user_name'];
                ?>
                    <option value="<?php echo $teacher_id; ?>"><?php echo $user_name; ?></option>
                <?php
                } ?>
            </select>
            <label for="floatingSelect">Click here for dropdown menu</label>
        </div>


        <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
    </form>
</div>