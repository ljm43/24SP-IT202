/*Luke Marinelli ljm43 4/19/24 IT202-006*/
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $productCode = $_POST["delete"];
    $deleteSql = "DELETE FROM CulinaryKnifeSet WHERE Code = '$productCode'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
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
            <img src="images/knifeset.jpg" alt="Culinary Knife Set Logo" width="200" height="100">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="shipping_details.html">Shipping</a></li>
                <li><a href="create_product.php">Add a Product</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Our Products</h1>
        <a href="create_product.php">Create Product</a>
        <div id="productList"></div>
    </main>

    <footer>
        <p>&copy; 2024 Culinary Knife Set. All rights reserved.</p>
    </footer>

    <script>
        function confirmDelete(productCode) {
            if (confirm("Are you sure you want to delete product with code " + productCode + "?")) {
                return true;
            } else {
                return false;
            }
        }

        function loadProducts() {
            fetch('get_products.php')
                .then(response => response.json())
                .then(data => {
                    const productList = document.getElementById('productList');
                    productList.innerHTML = '';

                    data.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product');

                        const categoryName = document.createElement('h2');
                        categoryName.textContent = product.CategoryName;
                        productDiv.appendChild(categoryName);

                        const productCode = document.createElement('p');
                        productCode.innerHTML = `<strong>Product Code:</strong> <a href='products_details.php?product_id=${product.Code}'>${product.Code}</a>`;
                        productDiv.appendChild(productCode);

                        const productName = document.createElement('p');
                        productName.innerHTML = `<strong>Product Name:</strong> ${product.ProductName}`;
                        productDiv.appendChild(productName);

                        const description = document.createElement('p');
                        description.innerHTML = `<strong>Description:</strong> ${product.Description}`;
                        productDiv.appendChild(description);

                        const price = document.createElement('p');
                        price.innerHTML = `<strong>Price:</strong> $${product.Price}`;
                        productDiv.appendChild(price);

                        const deleteForm = document.createElement('form');
                        deleteForm.method = 'post';
                        deleteForm.onsubmit = () => confirmDelete(product.Code);
                        const deleteInput = document.createElement('input');
                        deleteInput.type = 'hidden';
                        deleteInput.name = 'delete';
                        deleteInput.value = product.Code;
                        deleteForm.appendChild(deleteInput);
                        const deleteButton = document.createElement('input');
                        deleteButton.type = 'submit';
                        deleteButton.value = 'Delete';
                        deleteForm.appendChild(deleteButton);
                        productDiv.appendChild(deleteForm);

                        productList.appendChild(productDiv);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

       
        window.addEventListener('DOMContentLoaded', loadProducts);
    </script>
</body>
</html>