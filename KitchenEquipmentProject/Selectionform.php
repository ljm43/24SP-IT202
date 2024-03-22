/*Luke Marinelli ljm43 3/22/24 IT202-006*/
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "culinary knife set";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function checkProductCodeExists($conn, $code) {
    $sql = "SELECT * FROM culinaryknifeset WHERE code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

   
    $errors = array();

   
    if (checkProductCodeExists($conn, $code)) {
        $errors[] = "Product code already exists.";
    }

   
    $maxPrice = 1000; 
    if ($price <= 0 || $price > $maxPrice) {
        $errors[] = "Price must be a positive value and not exceed $maxPrice.";
    }


    if (empty($errors)) {
        $sql = "INSERT INTO culinaryknifeset (categoryID, code, name, description, price, dateCreated)
                VALUES ((SELECT categoryID FROM culinaryknifesetcategories WHERE categoryName = ?), ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssd", $category, $code, $name, $description, $price);
        if ($stmt->execute()) {
            echo "Product added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
   
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}


$sql = "SELECT categoryName FROM culinaryknifesetcategories";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="reset"] {
            background-color: #f44336;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>Create Product</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <option value="<?php echo $row['categoryName']; ?>"><?php echo $row['categoryName']; ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label for="code">Code:</label>
        <input type="text" name="code" id="code" required>
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required>
        <br><br>

        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>
</html>