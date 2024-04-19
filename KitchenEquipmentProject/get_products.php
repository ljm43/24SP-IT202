<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "culinary knife set";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT c.CategoryName, k.Code, k.Name AS ProductName, k.description AS Description, k.price AS Price
        FROM CulinaryKnifeSetCategories c
        INNER JOIN CulinaryKnifeSet k ON c.CategoryID = k.CategoryID
        ORDER BY c.CategoryName, k.Name";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Output the product list as JSON
header('Content-Type: application/json');
echo json_encode($products);
exit();