<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .image-section {
            flex: 1;
            text-align: center;
            padding-right: 20px;
        }
        .form-section {
            flex: 2;
        }
        .form {
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-button {
            padding: 10px 15px;
            border: none;
            background-color: #FF0000;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-button:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <?php
    require('db.php');
    session_start();
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);   
        $username = mysqli_real_escape_string($con, $username);
        $_SESSION['username'] = $username;
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            header("Location: home.php");
        } else {
            echo "<div class='form'>
                    <h3>Incorrect Username/password.</h3><br/>
                    <p class='link'>Click here to <a href='index.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
    ?>
    <header>
        <div class="container">
            <div class="image-section">
                <img src="bb.jpg" alt="Welcome to BidnBuy" style="max-width: 100%; height: auto; border-radius: 8px;">
            </div>
            <div class="form-section">
                <h1 style="font-size:45px;text-align:center;color:#FF0000">BidnBuy</h1>
                <form class="form" method="post" name="login">
                    <h1 class="login-title">Login</h1>
                    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
                    <input type="password" class="login-input" name="password" placeholder="Password"/>
                    <input type="submit" value="Login" name="submit" class="login-button"/>
                    <p class="link"><a href="register.php">Not a Member</a></p>
                </form>
            </div>
        </div>
    </header>
    <?php
    }
    ?>
</body>
</html>

