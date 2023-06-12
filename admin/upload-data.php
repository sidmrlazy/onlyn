<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>
<div class="container mt-5 add-user-success">
    <?php
    require('includes/connection.php');
    if (isset($_FILES['csvFile'])) {
        $csvFile = $_FILES['csvFile']['tmp_name'];
        $handle = fopen($csvFile, "r");
        $columnNames = fgetcsv($handle);

        $sql = "INSERT INTO `bora_student` (
        student_id, 
        student_img, 
        student_name,
        student_contact,
        student_father,
        student_mother,
        student_roll,
        student_course,
        student_admission_date,
        student_aadhar_number,
        student_aadhar_file,
        student_aadhar_back_file,
        student_aadhar_address,
        student_comm_address,
        student_added_date,
        student_added_by	
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssssssssssss", $column1, $column2, $column3, $column4, $column5, $column6, $column7, $column8, $column9, $column10, $column11, $column12, $column13, $column14, $column15, $column16);

        while (($data = fgetcsv($handle)) !== false) {
            $column1 = $data[0];
            $column2 = $data[1];
            $column3 = $data[2];
            $column4 = $data[3];
            $column5 = $data[4];
            $column6 = $data[5];
            $column7 = $data[6];
            $column8 = $data[7];
            $column9 = $data[8];
            $column10 = $data[9];
            $column11 = $data[10];
            $column12 = $data[11];
            $column13 = $data[12];
            $column14 = $data[13];
            $column15 = $data[14];
            $column16 = $data[15];

            // Execute the statement
            $stmt->execute();
        }
        fclose($handle);
        $connection->close();

        echo " <lottie-player src='https://assets10.lottiefiles.com/packages/lf20_lk80fpsm.json' background='transparent' speed='1' style='width: 300px; height: 300px;' loop autoplay></lottie-player>
    <p>Student Data Uploaded</p>
    <a href='user-add-student.php' class='go-back-btn'>Go Back</a>";
    }
    ?>
</div>
<?php include('includes/footer.php') ?>