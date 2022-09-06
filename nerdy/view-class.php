<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container section-container mb-5">
    <div class="section-header">
        <h3>View Classes</h3>
        <p>Check out all the classes added by you.</p>
    </div>
    <?php
    require_once('main/config.php');

    // Query to Disable Class
    if (isset($_POST['disable'])) {
        $class_id = $_POST['class_id'];
        $query = "UPDATE `classes` SET `class_status`= 2 WHERE class_id = $class_id";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<div class='alert alert-danger' role='alert'>
            Class Disabled!
          </div>";
        } else {
            die("<div class='alert alert-danger' role='alert'>
            ERROR 404!
          </div>" . mysqli_error($connection));
        }
    }

    // Query to Enable Class
    if (isset($_POST['enable'])) {
        $class_id = $_POST['class_id'];
        $query = "UPDATE `classes` SET `class_status`= 1 WHERE class_id = $class_id";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<div class='alert alert-success' role='alert'>
            Class Enabled!
          </div>";
        } else {
            die("<div class='alert alert-danger' role='alert'>
            ERROR 404!
          </div>" . mysqli_error($connection));
        }
    }

    // Query to fetch classes
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }
    $query = "SELECT * FROM `classes` WHERE class_added_by = $session_user_id";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $class_id = $row['class_id'];
        $class_name = $row['class_name'];
        $class_section = $row['class_section'];
        $class_added_date = $row['class_added_date'];
        $class_status = $row['class_status']; ?>


    <form action="" method="POST" class="view-tabs card p-5 mb-3">

        <!-- ============== HIDDEN VALUES BEING SENT TO CHANGE CLASS STATUS  ============== -->
        <input type="text" name="class_id" hidden value="<?php echo $class_id; ?>">
        <!-- ============== HIDDEN VALUES BEING SENT TO CHANGE CLASS STATUS  ============== -->

        <!-- If Class status is 1 -->
        <?php if ($class_status == 1) { ?>

        <!-- The Show Active Pill -->
        <p class="active-pill">Active</p>

        <!-- If Class status is 2 -->
        <?php } else if ($class_status == 2) { ?>

        <!-- Then Show Disabled Pill -->
        <p class="disabled-pill">Disabled</p>
        <?php } ?>


        <!-- Class Details Start -->
        <h2><?php echo $class_name; ?><?php echo "(" . $class_section . ")"; ?></h2>
        <p><?php echo $class_added_date; ?></p>
        <!-- Class Details End -->

        <div class="btn-row">
            <button type="submit" name="edit" class="btn m-1 btn-warning">Edit</button>

            <!-- If Class Status is 2 -->
            <?php if ($class_status == 2) { ?>

            <!-- The show Enable Button -->
            <button type="submit" name="enable" class="btn m-1 btn-success">Enable</button>

            <!-- If Class Status is 1 -->
            <?php } else if ($class_status == 1) { ?>

            <!-- Then Show Disable Button -->
            <button type="submit" name="disable" class="btn m-1 btn-danger">Disable</button>
            <?php } ?>
        </div>
    </form>
    <?php
    }
    ?>
</div>
<?php include('main/footer.php'); ?>