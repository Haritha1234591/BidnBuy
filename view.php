<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Bidder Details</title>
    <link rel="stylesheet" href="style.css"/>
<header>
<div class="container">
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="addProducts.php">Sell Product</a>&nbsp;&nbsp;</li>
            <li><a href="myProducts.php">My Products</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
        
</div>
</header>
</head>
<body>
<div class="form">
<?php
    require('db.php');
    include('auth.php');
    $username = $_REQUEST['username'];
    $query=mysqli_query($con, "SELECT * from users where username='$username'");
    echo "<table border='1'> 
    <tr>
    <th>Details</th>
    </tr>";
    while($row = mysqli_fetch_array($query))
    {
    echo "<tr>";
    echo "<td>Name</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Email</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Phone Number</td>";
    echo "<td>" . $row['phnum'] . "</td>";
    echo "</tr>";
    echo "<td>Address</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "</tr>";
    }
    echo "</table>";
    echo "<p class='link'><a href='home.php'>Back</a></p>";
?>
</div>
</body>
</html>