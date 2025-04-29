<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css"/>
    <title>My Bids</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="addProducts.php">Sell Products</a>&nbsp;&nbsp;</li>
            <li><a href="myProducts.php">My Products</a>&nbsp;&nbsp;</li>
            <li><a href="viewReviews.php">View Reviews</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<div class="form">
<h3 class="login-title" style="font-size:50px;text-align:center">My Bids</h3>
<?php
require('db.php');
include('auth.php');

$username = $_SESSION['username'];
$result = mysqli_query($con, "SELECT b.bid_amount, p.name as product_name, b.bid_time FROM bids b JOIN products p ON b.product_id = p.product_id WHERE b.bidder_username='$username'");

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1'> 
    <tr>
        <th>Product Name</th>
        <th>Bid Amount</th>
        <th>Bid Time</th>
    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>$" . htmlspecialchars($row['bid_amount']) . "</td>";
        echo "<td>" . htmlspecialchars($row['bid_time']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No bids found.</p>";
}
?>
</div>
</body>
</html>
