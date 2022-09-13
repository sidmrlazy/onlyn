<?php include('main/header.php') ?>
<?php include('main/web-navbar.php') ?>
<div class="container section-container mt-5 mb-5">
    <div class="register">
        <div class="col-md-4 reg-login-background">
            <img src="assets/images/vectors/vec-1.png" alt="" class="reg-login-img">
        </div>

        <div class="col-md-8 section-form">
            <p class="text-center">Upgrade your school to a digital platform with Onlyn Nerdy</p>
            <form action="pay.php" method="POST" class="mt-4 reg-form login-form">
                <div class="d-flex mob-flex w-100 mb-1">
                    <div class="col-md-6 m-2">
                        <div class="d-flex mob-flex w-100 mb-2">
                            <div class="form-floating m-1 w-100">
                                <select required class="form-select" name="user_type" id="userType"
                                    aria-label="Floating label select example">
                                    <option selected>Type</option>
                                    <option value="2">School</option>
                                    <option value="6">University</option>
                                    <option value="7">Pre-School</option>
                                    <option value="8">College</option>
                                    <option value="9">High School</option>
                                </select>
                                <label for="userType">Click here</label>
                            </div>
                            <div class="form-floating m-1 w-100">
                                <select required class="form-select" name="user_board" id="userBoard"
                                    aria-label="Floating label select example">
                                    <option selected>Board</option>
                                    <option value="1">UPSC</option>
                                    <option value="2">CBSE</option>
                                    <option value="3">ICSE</option>
                                    <option value="4">ISC</option>
                                    <option value="5">International Board</option>
                                    <option value="0">None</option>
                                </select>
                                <label for="userBoard">Click here</label>
                            </div>
                        </div>
                        <div class="d-flex mob-flex w-100 mb-2">
                            <div class="form-floating m-1 w-100">
                                <input type="text" name="user_school_name" required class="form-control" id="instName"
                                    placeholder="School Name">
                                <label for="instName">Institution's Name</label>
                            </div>

                            <div class="form-floating m-1 w-100">
                                <input type="number" name="user_contact" required maxlength="10" class="form-control"
                                    id="contactNumber" placeholder="+91XXXXXXXXXX">
                                <label for="contactNumber">Mobile Number</label>
                            </div>
                        </div>
                        <div class="d-flex mob-flex w-100 mb-2">
                            <div class="form-floating m-1 w-100">
                                <input type="password" autocomplete="on" name="user_password" required
                                    class="form-control" id="passWord" placeholder="**********">
                                <label for="password">Password</label>
                            </div>

                            <div class="form-floating m-1 w-100">
                                <input type="password" autocomplete="on" name="user_cpassword" required
                                    class="form-control" id="confirmPass" placeholder="**********">
                                <label for="confirmPass">Confirm Password</label>
                            </div>
                        </div>

                        <div class="form-floating mb-3 w-100">
                            <input type="email" name="user_email" class="form-control" id="emailId"
                                placeholder="abs@xyz.com">
                            <label for="emailId">Email ID</label>
                        </div>

                    </div>

                    <div class="col-md-6 m-2">
                        <div class="d-flex mob-flex w-100 mb-2">
                            <div class="form-floating w-100 m-1">
                                <select name="user_state" class="form-select" id="userState"
                                    aria-label="Floating label select example">
                                    <option selected>State</option>
                                    <?php
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/states',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_HTTPHEADER => array(
                                            'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                                        ),
                                    ));
                                    $response = curl_exec($curl);
                                    curl_close($curl);
                                    $response_json = json_decode($response);
                                    foreach ($response_json as $key) {
                                        $user_state =  $key->name; ?>
                                    <option value="<?php echo $user_state; ?>"><?php echo $user_state; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="userState">Click here</label>
                            </div>

                            <div class="form-floating w-100 m-1">
                                <select name="user_city" class="form-select" id="userCity"
                                    aria-label="Floating label select example">
                                    <option selected>City</option>
                                    <?php
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_HTTPHEADER => array(
                                            'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                                        ),
                                    ));
                                    $response = curl_exec($curl);
                                    curl_close($curl);
                                    $response_json = json_decode($response);
                                    foreach ($response_json as $key) {
                                        $user_city =  $key->name; ?>

                                    <option value="<?php echo $user_city; ?>"><?php echo $user_city; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="userCity">Click here</label>
                            </div>
                        </div>

                        <div class="form-floating mb-2 w-100">
                            <textarea class="form-control" name="user_address" placeholder="Leave a comment here"
                                id="schoolAddress" style="height: 80px"></textarea>
                            <label for="schoolAddress">School Address</label>
                        </div>



                        <div class="form-floating mb-2 w-100">
                            <input type="text" maxlength="6" required name="user_pincode" class="form-control"
                                id="userPinCode" placeholder="abs@xyz.com">
                            <label for="userPinCode">Pincode</label>
                        </div>

                        <div class="form-floating mb-2 w-100">
                            <select name="user_plan_amount" class="form-select" id="userPlan"
                                aria-label="Floating label select example">
                                <option selected>Open this menu</option>
                                <option value="2800">Basic (₹2800/-)</option>
                                <option value="3600">Premium (₹3600/-)</option>
                                <option value="5000">Pro (₹5000/-)</option>
                            </select>
                            <label for="userPlan">Select Subscription Plan</label>
                        </div>

                        <input type="submit" name="register" value='Sign-Up' class="login-button w-100">
                    </div>
                </div>
                <hr>
                <!-- <div class="line section-form"></div> -->
                <div class="text-center register-text">
                    <p>Already a member?<a href="index.php"> Click here </a>to Sign-In to your account</p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>