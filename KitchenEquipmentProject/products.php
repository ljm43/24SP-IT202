/*Luke Marinelli ljm43 2/29/24 IT202-006*/
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "culinary knife set";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $productCode = $_POST["delete"]; 
    
  
    $deleteSql = "DELETE FROM CulinaryKnifeSet WHERE Code = '$productCode'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$sql = "SELECT c.CategoryName, k.Code, k.Name AS ProductName, k.description AS Description, k.price AS Price
        FROM CulinaryKnifeSetCategories c
        INNER JOIN CulinaryKnifeSet k ON c.CategoryID = k.CategoryID
        ORDER BY c.CategoryName, k.Name";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Knife Set - Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/knifeset.jpg" alt="Culinary Knife Set Logo"width="200" height="100">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="shipping.php">Shipping</a></li>
                <li><a href="Selectionform.php">Add a Product</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Our Products</h1>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>" . $row["CategoryName"] . "</h2>";
                echo "<p><strong>Product Code:</strong> " . $row["Code"] . "</p>";
                echo "<p><strong>Product Name:</strong> " . $row["ProductName"] . "</p>";
                echo "<p><strong>Description:</strong> " . $row["Description"] . "</p>";
                echo "<p><strong>Price:</strong> $" . $row["Price"] . "</p>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='delete' value='" . $row["Code"] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No products available.";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Culinary Knife Set. All rights reserved.</p>
    </footer>
</body>
</html>
