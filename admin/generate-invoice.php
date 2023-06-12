<?php
include('includes/header.php') ?>
<?php include('components/navbar/user-navbar.php') ?>

<div class="container mt-5 add-user-success">
    <?php
    require('includes/connection.php');
    if (isset($_COOKIE['user_id'])) {
        $user_contact = $_COOKIE['user_id'];
        $fetch_data = "SELECT * FROM `bora_users` WHERE `user_contact` = '$user_contact'";
        $fetch_res = mysqli_query($connection, $fetch_data);
        $user_name = "";
        while ($row = mysqli_fetch_assoc($fetch_res)) {
            $user_name = $row['user_name'];
        }
    }

    if (isset($_POST['generate'])) {
        $bora_receipt_number = $_POST['bora_invoice_number'];
        $bora_invoice_date = $_POST['bora_invoice_date'];
        $bora_invoice_student_id = $_POST['bora_invoice_student_id'];
        $bora_invoice_student = $_POST['bora_invoice_student'];
        $bora_invoice_student_address = $_POST['bora_invoice_student_address'];
        $bora_invoice_student_contact = $_POST['bora_invoice_student_contact'];
        $bora_invoice_student_course = $_POST['bora_invoice_student_course'];
        $bora_invoice_for = $_POST['invoice_for'];
        $bora_invoice_tenure = $_POST['invoice_tenure'];
        $bora_invoice_value = $_POST['invoice_value'];
        $bora_invoice_disc = $_POST['invoice_disc'];
        if (empty($bora_invoice_disc) || $bora_invoice_disc == '0') {
            $bora_invoice_grand_total = $bora_invoice_value;
        } else {
            $bora_invoice_grand_total = $bora_invoice_value - $bora_invoice_disc;
        }

        $query = "INSERT INTO `bora_invoice`(
        `bora_invoice_number`,
        `bora_invoice_date`,
        `bora_invoice_student_id`,
        `bora_invoice_student`,
        `bora_invoice_student_address`,
        `bora_invoice_student_contact`,
        `bora_invoice_student_course`,
        `bora_invoice_for`,
        `bora_invoice_tenure`,
        `bora_invoice_value`,
        `bora_invoice_disc`,
        `bora_invoice_grand_total`,
        `bora_invoice_by`
        )
        VALUES(
        '$bora_receipt_number',
        '$bora_invoice_date',
        '$bora_invoice_student_id',
        '$bora_invoice_student',
        '$bora_invoice_student_address',
        '$bora_invoice_student_contact',
        '$bora_invoice_student_course',
        '$bora_invoice_for',
        '$bora_invoice_tenure',
        '$bora_invoice_value',
        '$bora_invoice_disc',
        '$bora_invoice_grand_total',
        '$user_name'
        )";
        $result = mysqli_query($connection, $query);
        if ($result) {

    ?>
    <form action="invoice-format.php" method="POST">
        <input type="text" name="bora_receipt_number" value="<?php echo $bora_receipt_number ?>" hidden>

        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_lk80fpsm.json" background="transparent"
            speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        <p>Success! Invoice generated.</p>
        <button type="submit" name="invoice" class="w-100 btn btn-success">Download Invoice</button>
    </form>

    <?php
        }
    }

    ?>
</div>
<?php
include('includes/footer.php');
?>