/*Luke Marinelli ljm43 4/19/24 IT202-006*/
<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "culinary knife set";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST["code"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];


    $errors = array();

    if (empty($code)) {
        $errors[] = "Code field is required.";
    } elseif (strlen($code) < 4 || strlen($code) > 10) {
        $errors[] = "Code must be between 4 and 10 characters long.";
    }

    if (empty($name)) {
        $errors[] = "Name field is required.";
    } elseif (strlen($name) < 10 || strlen($name) > 100) {
        $errors[] = "Name must be between 10 and 100 characters long.";
    }

    if (empty($description)) {
        $errors[] = "Description field is required.";
    } elseif (strlen($description) < 10 || strlen($description) > 255) {
        $errors[] = "Description must be between 10 and 255 characters long.";
    }

    if (empty($price)) {
        $errors[] = "Price field is required.";
    } elseif ($price <= 0 || $price > 100000) {
        $errors[] = "Price must be a positive value less than or equal to 100000.";
    }

    
    if (empty($errors)) {
        $sql = "INSERT INTO CulinaryKnifeSet (Code, Name, description, price, CategoryID)
        VALUES ('$code', '$name', '$description', '$price', '$category_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Product created successfully.";
            header("Location: products.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Knife Set - Create Product</title>
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
        <h1>Create Product</h1>
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <h3>Please fix the following errors:</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form id="createForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm();">
            <label for="code">Code:</label>
            <input type="text" id="code" name="code" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" min="0.01" required>

            <label for="category_id">Category ID:</label>
            <input type="number" id="category_id" name="category_id" min="1" required>

            <input type="submit" value="Create Product">
            <input type="button" value="Reset" onclick="resetForm();">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Culinary Knife Set. All rights reserved.</p>
    </footer>

    <script>
        function validateForm() {
          
            return true;
        }

        function resetForm() {
            document.getElementById('createForm').reset();
        }
    </script>
</body>
</html>
