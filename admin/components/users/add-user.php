<div class="container user-form-container">
    <div class="page-marker">
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Add User</h5>
    </div>
    <form class="add-user-form" method="POST" action="add-user-success.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full Name</label>
            <input type="text" name="user_name" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="contactNumber" class="form-label">Contact Number</label>
            <input type="number" name="user_contact" maxlength="10" required class="form-control" id="contactNumber">
        </div>
        <div class="mb-3">
            <label for="userPassword" class="form-label">Password</label>
            <input type="password" name="user_password" class="form-control" required id="userPassword">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Generate User ID</button>
    </form>
</div>