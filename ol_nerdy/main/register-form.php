<div class="container section-container mt-5">
    <div class="card p-5 mb-5 section-form">
        <h1>Register</h1>
        <p>Enter your school details to register yourself as an Onlyn Nerdy Powered School</p>
        <form action="pay.php" method="POST" class="w-100">
            <div class="form-floating mb-3">
                <input type="text" name="user_school_name" class="form-control" id="floatingInput"
                    placeholder="School Name">
                <label for="floatingInput">School Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="user_contact" maxlength="10" class="form-control" id="floatingInput"
                    placeholder="+91 XXXXX XXXXX">
                <label for="floatingInput">Mobile Number</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="user_email" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Email ID</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="user_state" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Click here to open list of States</option>
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
                <label for="floatingSelect">State</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="user_city" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Click here to open list of Cities</option>
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
                <label for="floatingSelect">City</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="user_address" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" name="user_pincode" maxlength="6" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Pincode</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="user_password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="user_cpassword" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Confirm Password</label>
            </div>

            <div class="form-floating mb-3">
                <select name="user_plan_amount" class="form-select" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Open this menu</option>
                    <option value="2800">Basic (₹2800/-)</option>
                    <option value="3600">Premium (₹3600/-)</option>
                    <option value="5000">Pro (₹5000/-)</option>
                </select>
                <label for="floatingSelect">Select Subscription Plan</label>
            </div>
            <!-- <button type="submit" class="register-button btn btn-danger w-100">Register</button> -->
            <input class="checkout-btn register-button" type="submit" name="register" value='Register' />

            <div class="line"></div>

            <a href="index.php" class="login-button register-anchor text-center w-100">Already a user? Click here to go
                back to
                login.</a>
        </form>
    </div>
</div>