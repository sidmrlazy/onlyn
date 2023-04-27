<?php
require('database/connection.php');

$query = "SELECT * FROM `feedback` WHERE `feedback_status` = '1'";
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);

if ($count > 0) {

?>
<div class="container homepage-section-6">
    <div class="col-md-4 homepage-section-6-heading">
        <h6><span>Here's the buzz on us:</span> What they're saying!</h6>
        <p>Word on the street? They're talking about us! See what they're saying about the best software company in
            india
            with just a click - discover our reputation.</p>
    </div>

    <div class="col-md-8 scroller">
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $feedback_name = $row['feedback_name'];
                $feedback_company = $row['feedback_company'];
                $feedback_details = $row['feedback_details'];
                $feedback_date = date('d M Y', strtotime($row['feedback_date']));

            ?>
        <div class="feedback-tab">
            <img src="assets/webp/quote.webp" alt="Onlyn Feedback Quote">
            <p class="feedback-details"><?php echo $feedback_details ?></p>
            <p class="feedback_name"><?php echo $feedback_name ?></p>
            <p><?php echo $feedback_company ?></p>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>