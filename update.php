<?php
include('db.php');

if (isset($_POST['update'])) {
    $product_id = $_GET['product_id'];
    $current_bid = mysqli_real_escape_string($con, $_POST['current_bid']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);

    $query = "UPDATE `products` SET current_bid='$current_bid', end_date='$end_date' WHERE product_id='$product_id'";
    if (mysqli_query($con, $query)) {
        echo "<div class='form'>
        <h3>Product updated successfully!</h3>
        <p class='link'><a href='myProducts.php'>Back to My Products</a></p>
        </div>";
    } else {
        echo "<div class='form'>
        <h3>Failed to update the product. Please try again.</h3>
        <p class='link'><a href='edit.php?product_id=$product_id'>Go Back</a></p>
        </div>";
    }
}
?>
