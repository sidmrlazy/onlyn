<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header section-heading-row">
            <div class="section-flex">
                <h3 class="section-heading">
                    <ion-icon name="print" class="section-heading-icon"></ion-icon>
                    Fee Receipt
                </h3>
                <p class="section-desc">Enter the details given below and the registered mobile number through which the
                    parent sign's in the Onlyn Nerdy Panel</p>
            </div>
        </div>
        <form action="show-receipt.php" method="POST" class="col-md-5 card p-4">
            <div class="form-floating mb-3 w-100">
                <input type="month" class="form-control" name="fee_month" id="fromDate" placeholder="MM">
                <label for="fromDate">For the month</label>
            </div>

            <div class="form-floating mb-3 ">
                <input type="number" class="form-control" name="fee_contact" id="toDate" placeholder="+91XXXXXXXXXX">
                <label for="toDate">Registered Mobile Number</label>
            </div>

            <button type="submit" name="submit" class="btn btn-outline-success">Download</button>
        </form>

    </div>
</div>
<?php include('main/footer.php'); ?>