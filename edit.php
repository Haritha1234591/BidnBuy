<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    include('db.php');
    $product_id = $_GET['product_id'];
    $query = mysqli_query($con, "SELECT * FROM `products` WHERE product_id='$product_id'");
    $row = mysqli_fetch_array($query);
?>
<h1 style="font-size:45px;text-align:center;color:#FF0000">BidnBuy</h1>
<form class="form" method="POST" name="edit" action="update.php?product_id=<?php echo $product_id; ?>">
    <h1 class="login-title">Edit Product</h1>
    <label>Price:</label>
    <input type="text" class="login-input" value="<?php echo $row['current_bid']; ?>" name="current_bid" required>
    <label>End Date:</label>
    <input type="datetime-local" class="login-input" value="<?php echo date('Y-m-d\TH:i', strtotime($row['end_date'])); ?>" name="end_date" required>
    <input type="submit" class="login-button" name="update" value="Update">
    <p class="link"><a href="myProducts.php">Back to My Products</a></p>
</form>
</body>
</html>
