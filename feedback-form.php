    <?php include('database/connection.php') ?>
    <?php include('components/header.php') ?>

    <div class="container mt-5 mb-5 ">
        <div class="feedback-form">
            <h1>Share your <span>love</span>, spread the word</h1>
            <p>Leave us a glowing review and help us shine brighter!</p>

            <?php
            if (isset($_POST['submit'])) {
                $feedback_name = mysqli_real_escape_string($connection, $_POST['feedback_name']);
                $feedback_company = mysqli_real_escape_string($connection, $_POST['feedback_company']);
                $feedback_details = mysqli_real_escape_string($connection, $_POST['feedback_details']);
                $feedback_status = "2";

                $query = "INSERT INTO `feedback`(
                    `feedback_name`,
                    `feedback_company`,
                    `feedback_details`,
                    `feedback_status`
                )
                VALUES(
                    '$feedback_name',
                    '$feedback_company',
                    '$feedback_details',
                    '$feedback_status'
                )";

                $result = mysqli_query($connection, $query);

                if ($result) { ?>
            <div class="alert alert-success mt-3 mb-3" role="alert">
                Your feedback is the fuel that keeps us going - Thank You for powering our progress with your valuable
                insights!
            </div>

            <?php
                }
            }

            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                    <input type="text" name="feedback_name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Dsignation</label>
                    <input type="text" class="form-control" name="feedback_company" id="exampleFormControlInput1"
                        placeholder="Your Designation">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Share your story - Leave a testimonial
                        today!</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="feedback_details"
                        rows="3"></textarea>
                </div>
                <button type="submit" name="submit" class="feedback-btn">Share</button>
            </form>
        </div>
    </div>
    <?php include('components/footer-feedback.php') ?>