<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    
    <script>
        function validation() {
            var name = document.forms["register"]["name"].value;
            var email = document.forms["register"]["email"].value;
            var phone = document.forms["register"]["phonenum"].value;
            var password = document.forms["register"]["password"].value;

            var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; // Email Validation
            var regPhone = /^\d{10}$/; // Phone Number Validation
            var regName = /\d+$/g; // Name Validation

            // Name Validation
            if (name == "" || regName.test(name)) {
                alert("Please enter a valid name without numbers.");
                return false;
            }

            // Email Validation
            if (email == "" || !regEmail.test(email)) {
                alert("Please enter a valid e-mail address.");
                return false;
            }

            // Password Validation
            if (password == "") {
                alert("Please enter your password.");
                return false;
            }
            if (password.length < 6) {
                alert("Password should be at least 6 characters long.");
                return false;
            }

            // Phone Number Validation
            if (phone == "" || !regPhone.test(phone)) {
                alert("Please enter a valid phone number.");
                return false;
            }

            return true;
        }
    </script>
    
</head>
<body>
<?php
require('db.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // removes backslashes
    $name = stripslashes($_REQUEST['name']);
    //escapes special characters in a string
    $name = mysqli_real_escape_string($con, $name);
    $phonenum = stripslashes($_REQUEST['phonenum']);
    $phonenum = mysqli_real_escape_string($con, $phonenum);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $address  = stripslashes($_REQUEST['address']);
    $address  = mysqli_real_escape_string($con, $address);
    $city     = stripslashes($_REQUEST['city']);
    $city     = mysqli_real_escape_string($con, $city);
    $state    = stripslashes($_REQUEST['state']);
    $state    = mysqli_real_escape_string($con, $state);
    $zip      = stripslashes($_REQUEST['zip']);
    $zip      = mysqli_real_escape_string($con, $zip);

    $query    = "INSERT INTO `users` (name, phnum, email, username, password, address, city, state, zip)
                 VALUES ('$name', '$phonenum', '$email', '$username', '$password', '$address', '$city', '$state', '$zip')";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
             <h3>You are registered successfully.</h3><br/>
             <p class='link'>Click here to <a href='index.php'>Login</a></p>
             </div>";
    } else {
        echo "<div class='form'>
             <h3>Required fields are missing.</h3><br/>
             <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
             </div>";
    }
} else {
?>
    <div class="container">
       
        <div class="form-section">
            <h1 style="font-size:45px;text-align:center;color:#FF0000">BidnBuy</h1>
            <form class="form" action="" onsubmit="return validation()" method="post" name="register">
                <h1 class="login-title">Registration</h1>
                <input type="text" class="login-input" name="name" placeholder="Name" required />
                <input type="text" class="login-input" name="email" placeholder="Email" required />
                <input type="text" class="login-input" name="phonenum" placeholder="Mobile Number" required />
                <input type="text" class="login-input" name="username" placeholder="Username" required />
                <input type="password" class="login-input" name="password" placeholder="Password" required />
                <input type="text" class="login-input" name="address" placeholder="Address" required />
                <input type="text" class="login-input" name="city" placeholder="City" required />
                <select name="state" id="state" class="login-input" required>
                    <option value="" selected>Select a State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
                </select>
                <input type="text" class="login-input" name="zip" placeholder="Zip" required />
                <input type="submit" value="Submit" class="login-button" />
                <p class="link"><a href="index.php">Login</a></p>
            </form>
        </div>
    </div>
<?php
}
?>
</body>
</html>
