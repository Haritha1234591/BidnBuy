<?php
require('db.php');
include('auth.php');

// Check if a username is passed in the URL
if (isset($_GET['username'])) {
    $bidder_username = mysqli_real_escape_string($con, $_GET['username']);

    // Query to fetch the bidder's contact information
    $query = "SELECT * FROM users WHERE username = '$bidder_username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);
    } else {
        echo "No details found for the bidder.";
        exit;
    }
} else {
    echo "No bidder selected.";
    exit;
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
    <title>Bidder Details</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="addProducts.php">Sell Products</a></li>
                <li><a href="myBids.php">My Bids</a>&nbsp;&nbsp;</li>
                <li><a href="viewReviews.php">View Reviews</a>&nbsp;&nbsp;</li>
                <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
            </ul>
        </nav>
    </header>

    <h3 class="login-title" style="font-size:50px;text-align:center">Bidder Contact Information</h3>

    <div style="text-align: center; padding: 20px;">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phnum']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        <p><strong>City:</strong> <?php echo htmlspecialchars($user['city']); ?></p>

        <br>
        <a href="myProducts.php" class="pure-button pure-button-primary">Back to My Products</a>
    </div>
</body>

</html>
