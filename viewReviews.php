<!DOCTYPE html>
<html>
<head>
    <title>View Reviews</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="addProducts.php">Sell Products</a>&nbsp;&nbsp;</li>
            <li><a href="myProducts.php">My Products</a>&nbsp;&nbsp;</li>
            <li><a href="myBids.php">My Bids</a>&nbsp;&nbsp;</li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <?php
    require('db.php');

    $result = mysqli_query($con, "SELECT username, review_text, rating FROM reviews ORDER BY created_at DESC");

    echo "<h3 style='text-align:center;'>Reviews</h3>";

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table class='pure-table pure-table-bordered'>
                <thead>
                    <tr>
                        <th>Reviewer</th>
                        <th>Rating</th>
                        <th>Review</th>
                    
                    </tr>
                </thead>
                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rating']) . "/5</td>";
            echo "<td>" . htmlspecialchars($row['review_text']) . "</td>";
  
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p style='text-align:center;'>No reviews yet.</p>";
    }
    ?>
        <p class='link'><a href='addReviews.php'>Click here to add Review</a></p>
  
</body>
</html>
