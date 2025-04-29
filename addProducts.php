<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Add Products</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="myProducts.php">My Products</a>&nbsp;&nbsp;</li>
            <li><a href="myBids.php">My Bids</a>&nbsp;&nbsp;</li>
            <li><a href="viewReviews.php">View Reviews</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</header>
<?php
require('db.php');
include('auth.php');

if (isset($_POST['submit'])) {
    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($con, $name);
    $description = stripslashes($_REQUEST['description']);
    $description = mysqli_real_escape_string($con, $description);
    $basePrice = stripslashes($_REQUEST['basePrice']);
    $basePrice = mysqli_real_escape_string($con, $basePrice);
    $start_date = stripslashes($_REQUEST['start_date']);
    $start_date = mysqli_real_escape_string($con, $start_date);
    $end_date = stripslashes($_REQUEST['end_date']);
    $end_date = mysqli_real_escape_string($con, $end_date);
    $username = $_SESSION['username'];
    $imageName = $_FILES['productImg']['name'];
    $destination = 'Products/' . $imageName;
    move_uploaded_file($_FILES['productImg']['tmp_name'], $destination);

    $query = "INSERT INTO `products` (name, username, imageName, current_bid, description, start_date, end_date)
              VALUES ('$name', '$username', '$imageName', '$basePrice', '$description', '$start_date', '$end_date')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<div class='form'>
        <h3>You have added the product successfully</h3><br/>
        <p class='link'>Click here to <a href='home.php'>Products</a> again.</p>
        </div>";
    } else {
        echo "<div class='form'>
        <h3>Error: Could not add the product.</h3><br/>
        <p class='link'>Click here to <a href='addProducts.php'>Add Products</a> again.</p>
        </div>";
    }
} else {
?>
<h1 style="font-size:45px;text-align:center;color:#FF0000">BidnBuy</h1>
<form class="form" action="" method="post" name="addproducts" enctype="multipart/form-data">
    <h3 class="login-title">Add Product</h3>
    <input type="file" class="login-input" name="productImg" placeholder="Product Image" required/>
    <input type="text" class="login-input" name="name" placeholder="Product Name" required/>
    <input type="text" class="login-input" name="basePrice" placeholder="Base Price" required/>
    <input type="text" class="login-input" name="description" placeholder="Description" required/>
    <label for="start_date">Start Date:</label>
    <input type="datetime-local" class="login-input" name="start_date" required/>
    <label for="end_date">End Date:</label>
    <input type="datetime-local" class="login-input" name="end_date" required/>
    <input type="submit" value="Add Product" name="submit" class="login-button"/>
</form>
<?php
}
?>
</body>
</html>
