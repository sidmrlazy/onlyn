<div class="container user-form-container">
    <div class="page-marker">
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Add Course</h5>
    </div>
    <form class="add-user-form" method="POST" action="add-course-success.php">
        <div class="mb-3">
            <label for="courseName" class="form-label">Course Name</label>
            <input type="text" name="course_name" required class="form-control" id="courseName" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="courseTenure" class="form-label">Course Tenure (in Years)</label>
            <select class="form-select" name="course_tenure" aria-label="Default select example">
                <option selected>Click here to open options</option>
                <option value="1 Year Course">1 Year Course</option>
                <option value="2 Year Course">2 Year Course</option>
                <option value="3 Year Course">3 Year Course</option>
                <option value="4 Year Course">4 Year Course</option>
                <option value="1 Month Course">1 Month Course</option>
                <option value="2 Month Course">2 Month Course</option>
                <option value="3 Month Course">3 Month Course</option>
                <option value="4 Month Course">4 Month Course</option>
                <option value="5 Month Course">5 Month Course</option>
                <option value="6 Month Course">6 Month Course</option>
                <option value="7 Month Course">7 Month Course</option>
                <option value="8 Month Course">8 Month Course</option>
                <option value="9 Month Course">9 Month Course</option>
                <option value="10 Month Course">10 Month Course</option>

            </select>
        </div>
        <!-- <div class="mb-3">
            <label for="courseSem" class="form-label">Semesters Name</label>
            <input type="text" name="course_semester_name" required class="form-control" id="courseSem">
        </div> -->
        <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
    </form>
</div>