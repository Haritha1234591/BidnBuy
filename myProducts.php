<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
    <title>My Products</title>
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

    <h3 class="login-title" style="font-size:50px;text-align:center">My Products</h3>

    <?php
    require('db.php');
    include('auth.php');

    // Fetch products added by the logged-in user
    $username = $_SESSION['username'];
    $result = mysqli_query($con, "
        SELECT 
            products.product_id, 
            products.name, 
            products.imageName, 
            products.current_bid, 
            products.description, 
            products.end_date, 
            bids.bidder_username 
        FROM 
            products 
        LEFT JOIN 
            bids 
        ON 
            products.product_id = bids.product_id 
        WHERE 
            products.username = '$username'
        ORDER BY 
            bids.bid_time DESC
            LIMIT 1
    ");

    // Check if there are any products to display
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table class='pure-table pure-table-bordered'> 
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Current Bid</th>
                        <th>Description</th>
                        <th>Bidder Name</th>
                        <th>End Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>View History</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td><img src='Products/{$row['imageName']}' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>$" . htmlspecialchars($row['current_bid']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";

            // If there is a bidder, make the bidder's username a clickable link to bidderDetails.php
            echo "<td>";
            if ($row['bidder_username']) {
                echo "<a href='bidderDetails.php?username=" . urlencode($row['bidder_username']) . "'>" . htmlspecialchars($row['bidder_username']) . "</a>";
            } else {
                echo 'No Bids';
            }
            echo "</td>";

            echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
            echo "<td><a href='edit.php?product_id=" . urlencode($row['product_id']) . "'>Edit</a></td>";
            echo "<td><a href='delete.php?product_id=" . urlencode($row['product_id']) . "'>Delete</a></td>";
            echo "<td><a href='history.php?product_id=" . urlencode($row['product_id']) . "'>View History</a></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p style='text-align: center;'>No products found.</p>";
    }
    ?>
</body>

</html>
