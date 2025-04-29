<!DOCTYPE html>
<html>
<head>
    <title>Add Review</title>
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
            <li><a href="viewReviews.php">View Reviews</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
            </ul>
        </nav>
    </header>

    <?php
    require('db.php');
    include('auth.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_SESSION['username'];
        $review_text = mysqli_real_escape_string($con, $_POST['review_text']);
        $rating = intval($_POST['rating']);

        $query = "INSERT INTO reviews (username, review_text, rating) VALUES ('$username', '$review_text', '$rating')";
        if (mysqli_query($con, $query)) {
            echo "<p style='text-align:center; color:green;'>Review added successfully!</p>";
        } else {
            echo "<p style='text-align:center; color:red;'>Error adding review. Please try again.</p>";
        }
    }
    ?>

    <h3 style="text-align:center;">Add Your Review</h3>
    <form method="POST" class="form">
        <label for="review_text">Review:</label><br>
        <textarea name="review_text" id="review_text" rows="5" cols="50" required></textarea><br><br>
        <label for="rating">Rating (1-5):</label><br>
        <input type="number" name="rating" id="rating" min="1" max="5" required><br><br>
        <input type="submit" value="Submit Review">
    </form>
</body>
</html>
