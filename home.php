<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css"/>
    <title>Products</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="addProducts.php">Sell Products</a>&nbsp;&nbsp;</li>
            <li><a href="myProducts.php">My Products</a>&nbsp;&nbsp;</li>
            <li><a href="myBids.php">My Bids</a>&nbsp;&nbsp;</li>
            <li><a href="viewReviews.php">View Reviews</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</header>
<div class="container">
    <h3 class="login-title" style="font-size:50px;text-align:center">Products</h3>
    <?php
    require('db.php');
    include('auth.php');
    $result = mysqli_query($con,"SELECT products.product_id, products.name as product_name, users.name as username, start_date, end_date, current_bid, imageName, phnum FROM products JOIN users ON products.username=users.username");

    echo "<table class='pure-table pure-table-bordered'> 
    <thead>
        <tr>
            <th>Product</th>
            <th>Name</th>
            <th>Seller Name</th>
            <th>Contact Details</th>
            <th>Bid Start Date</th>
            <th>Bid End Date</th>
               <th>Current Bid</th>
            <th>Bid</th>
        </tr>
    </thead>
    <tbody>";

    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td><img src='Products/{$row['imageName']}' width='100'></td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phnum']) . "</td>";
        echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
        echo "<td>$" . number_format($row['current_bid'], 2) . "</td>";

        // Bid Form
        echo "<td>
                <form action='place_bid.php' method='post'>
                    <input type='hidden' name='product_id' value='{$row['product_id']}' />
                    <input type='number' name='bid_amount' min='" . ($row['current_bid'] + 1) . "' placeholder='Enter bid' required />
                    <button type='submit' class='pure-button pure-button-primary'>Place Bid</button>
                </form>
              </td>";

        echo "</tr>";
    }

    echo "</tbody></table>";
    ?>
</div>
</body>
</html>
