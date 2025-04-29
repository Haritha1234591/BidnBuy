<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
    <title>Bid History</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="myProducts.php">Back to My Products</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <h3 class="login-title" style="font-size:50px;text-align:center">Bid History</h3>

    <?php
    require('db.php');

    // Get product_id from URL
    $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

    if ($product_id > 0) {
        // Fetch bid history for the product
        $result = mysqli_query($con, "
            SELECT 
                bids.bid_amount, 
                bids.bid_time, 
                bids.bidder_username 
            FROM 
                bids 
            WHERE 
                bids.product_id = $product_id
            ORDER BY 
                bids.bid_time DESC
        ");

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table class='pure-table pure-table-bordered'> 
                    <thead>
                        <tr>
                            <th>Bid Amount</th>
                            <th>Bid Time</th>
                            <th>Bidder Name</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>$" . htmlspecialchars($row['bid_amount']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bid_time']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bidder_username']) . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p style='text-align: center;'>No bids found for this product.</p>";
        }
    } else {
        echo "<p style='text-align: center;'>Invalid product ID.</p>";
    }
    ?>
</body>

</html>
