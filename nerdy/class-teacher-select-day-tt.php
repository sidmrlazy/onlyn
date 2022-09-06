<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Select Day
            </h3>
            <p class="section-desc">Caption Required</p>
        </div>

        <form method="POST" action="teacher-set-time-table.php" class="col-md-6 card p-3">
            <input type="text" name="student_assigned_school" value="<?php echo $session_user_id ?>" hidden>
            <div id='new-input-field' class='mob-flex d-flex justify-content-center align-items-center w-100 mb-3'>
                <div class="form-floating w-100 m-1">
                    <select class="form-select" id="floatingSelect" name="tt_day"
                        aria-label="Floating label select example">
                        <option value="0">Click here</option>
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                        <option value="7">Sunday</option>
                    </select>
                    <label for="floatingSelect">Select Day</label>
                </div>
            </div>

            <button type="submit" name="set" class="btn btn-outline-success mb-3">
                <ion-icon name="search-outline"></ion-icon> Continue
            </button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>