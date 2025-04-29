<?php
require('db.php');
include('auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $bidAmount = $_POST['bid_amount'];
    $username = $_SESSION['username'];

    // Get current bid for validation
    $result = mysqli_query($con, "SELECT current_bid FROM products WHERE product_id='$productId'");
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        $currentBid = $product['current_bid'];

        // Check if the bid is higher than the current bid
        if ($bidAmount > $currentBid) {
            // Update the current bid in the products table
            mysqli_query($con, "UPDATE products SET current_bid='$bidAmount' WHERE product_id='$productId'");

            // Insert the bid into the bids table
            mysqli_query($con, "INSERT INTO bids (product_id, bid_amount, bidder_username) VALUES ('$productId', '$bidAmount', '$username')");

            echo "<p>Bid placed successfully!</p>";
        } else {
            echo "<p>Your bid must be higher than the current bid of $" . number_format($currentBid, 2) . ".</p>";
        }
    } else {
        echo "<p>Product not found.</p>";
    }
}
?>

<a href="home.php">Back to Home</a>
