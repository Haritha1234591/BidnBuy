<?php
    $product_id=$_GET['product_id'];
    include('db.php');
    $result = mysqli_query($con, "SELECT * from `products` where product_id='$product_id'");
    $row=mysqli_fetch_array($result);
    unlink("Products/".$row['imageName']);
    mysqli_query($con,"delete from `bids` where product_id='$product_id'");
    mysqli_query($con,"delete from `products` where product_id='$product_id'");
    echo "<div class='form'>
    <h3>Deleted succesfully</h3><br/>
    <p class='link'>Click here to see products<a href='myProducts.php'>Products</a></p>
    </div>";
?>