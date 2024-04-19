<?php
/* Luke Marinelli ljm43 2/29/24 IT202-006 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "culinary knife set";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $sql = "SELECT k.Code, k.Name AS ProductName, k.description AS Description, k.price AS Price
            FROM CulinaryKnifeSet k
            WHERE k.Code = '$productId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productCode = $row['Code'];
        $productName = $row['ProductName'];
        $productDescription = $row['Description'];
        $productPrice = $row['Price'];
        $productImageFilename = $productCode . ".jpg"; 
    } else {
        echo "No product found with the specified ID.";
    }
} else {
    echo "No product ID provided.";
}

$conn->close();
?>
<script src="product_details.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Knife Set - Product Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/knifeset.jpg" alt="Culinary Knife Set Logo" width="200" height="100">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="shipping.php">Shipping</a></li>
                <li><a href="create_product.php">Add a Product</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Product Details</h1>
        <?php if (isset($productCode)): ?>
            <div class="product-details">
                <p><strong>Product Code:</strong> <?php echo $productCode; ?></p>
                <p><strong>Product Name:</strong> <?php echo $productName; ?></p>
                <p><strong>Description:</strong> <?php echo $productDescription; ?></p>
                <p><strong>Price:</strong> $<?php echo $productPrice; ?></p>
                <img id="productImage" src="images/<?php echo $productImageFilename; ?>" alt="Product Image" onmouseover="changeImage('alternate_image.jpg');" onmouseout="changeImage('<?php echo $productImageFilename; ?>');">
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Culinary Knife Set. All rights reserved.</p>
    </footer>

    <script>
        function changeImage(imageSrc) {
            document.getElementById('productImage').src = 'images/' + imageSrc;
        }
    </script>
</body>
</html>