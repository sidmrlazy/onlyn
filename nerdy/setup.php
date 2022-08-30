<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid mt-4 mb-5">
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    $query = "SELECT * FROM setup_status WHERE setup_school_id = $session_user_id";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $setup_registration_status = $row['setup_registration_status'];
        $setup_class_status = $row['setup_class_status'];
        $setup_teacher_status = $row['setup_teacher_status'];
        $setup_staff_status = $row['setup_staff_status'];
        $setup_subject_status = $row['setup_subject_status'];
        if ($setup_registration_status == 1) {
    ?>

    <!-- ============ PROFILE SETUP START ============ -->
    <a href="profile.php" class="custom-tab">
        <ion-icon class="tab-icon" name="person-add-outline"></ion-icon>
        <p>Profile Setup</p>
        <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
    </a>
    <?php
        }
        if ($setup_registration_status == 2) { ?>
    <div href="profile.php" class="custom-tab-complete">
        <ion-icon class="tab-icon-complete" name="person-add-outline"></ion-icon>
        <p>Profile Setup Complete</p>
        <ion-icon name="checkmark-outline" style="color: green; font-size: 20px; font-weight: bold;"></ion-icon>
    </div>
    <!-- ============ PROFILE SETUP END ============ -->

    <!-- ============ CLASS SETUP START ============ -->
    <?php }
        if ($setup_class_status == 0) { ?>
    <a href="add-class.php" class="custom-tab">
        <ion-icon class="tab-icon" name="clipboard-outline"></ion-icon>
        <p>Create Class</p>
        <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
    </a>
    <?php }
        if ($setup_class_status == 1) { ?>
    <div class="custom-tab-complete">
        <ion-icon class="tab-icon-complete" name="clipboard-outline"></ion-icon>
        <p>Class Creation Complete</p>
        <ion-icon name="checkmark-outline" style="color: green; font-size: 20px; font-weight: bold;"></ion-icon>
    </div>
    <!-- ============ CLASS SETUP END ============ -->

    <!-- ============ TEACHER SETUP START ============ -->
    <?php }
        if ($setup_teacher_status == 0) { ?>
    <a href="add-teacher.php" class="custom-tab">
        <ion-icon class="tab-icon" name="glasses-outline"></ion-icon>
        <p>Generate Teacher ID's</p>
        <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
    </a>
    <?php
        }
        if ($setup_teacher_status == 1) { ?>
    <div class="custom-tab-complete">
        <ion-icon class="tab-icon-complete" name="glasses-outline"></ion-icon>
        <p>Teacher ID's Generated</p>
        <ion-icon name="checkmark-outline" style="color: green; font-size: 20px; font-weight: bold;"></ion-icon>
    </div>
    <!-- ============ TEACHER SETUP END ============ -->

    <!-- ============ STAFF SETUP START ============ -->
    <?php
        }
        if ($setup_staff_status == 0) { ?>
    <a href="add-staff.php" class="custom-tab">
        <ion-icon class="tab-icon" name="people-outline"></ion-icon>
        <p>Generate Staff ID's</p>
        <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
    </a>
    <?php
        }
        if ($setup_staff_status == 1) { ?>
    <div class="custom-tab-complete">
        <ion-icon class="tab-icon-complete" name="people-outline"></ion-icon>
        <p>Staff ID's Generated</p>
        <ion-icon name="checkmark-outline" style="color: green; font-size: 20px; font-weight: bold;"></ion-icon>
    </div>
    <!-- ============ STAFF SETUP END ============ -->

    <!-- ============ SUBJECT SETUP START ============ -->
    <?php }
        if ($setup_subject_status == 0) { ?>
    <a href="add-subject.php" class="custom-tab mb-5">
        <ion-icon class="tab-icon" name="library-outline"></ion-icon>
        <p>Add Subject</p>
        <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
    </a>
    <?php
        }
        if ($setup_subject_status == 1) { ?>
    <div class="custom-tab-complete mb-5">
        <ion-icon class="tab-icon-complete" name="library-outline"></ion-icon>
        <p>Subjects Added</p>
        <ion-icon name="checkmark-outline" style="color: green; font-size: 20px; font-weight: bold;"></ion-icon>
    </div>
    <?php }
    } ?>
    <!-- ============ SUBJECT SETUP END ============ -->


</div>
<?php include('main/footer.php'); ?>