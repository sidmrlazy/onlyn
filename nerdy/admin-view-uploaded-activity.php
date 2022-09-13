<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container ">
        <p>Select class to show all uploaded activities</p>

        <div class="tab-wrap-view">
            <?php


            $get = "SELECT * FROM `classes` GROUP BY `class_name`";
            $show = mysqli_query($connection, $get);

            while ($row = mysqli_fetch_assoc($show)) {
                $class_name = $row['class_name'];

            ?>
            <form action="admin-show-activity.php" method="POST">
                <input type="text" name="class_name" value="<?php echo $class_name ?>" hidden>
                <button type="submit" name="submit" class="att-carrot">
                    <p><?php echo $class_name ?></p>
                </button>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>