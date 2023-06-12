<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Users
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="users.php">Create Sub-Admin</a></li>
                        <li><a class="dropdown-item" href="view-user.php">View Sub-Admin</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Students
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add-student.php">Add Student</a></li>
                        <li><a class="dropdown-item" href="view-students.php">View Student</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Configure
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add-course.php">Add Course</a></li>
                        <li><a class="dropdown-item" href="add-semester.php">Add Semester</a></li>
                        <li><a class="dropdown-item" href="course-settings.php">View all courses</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                </li>

            </ul>
        </div>
    </div>
</nav>