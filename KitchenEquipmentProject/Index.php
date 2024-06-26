/*Luke Marinelli ljm43 2/29/24 IT202-006*/
<?php

session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php"); 
    exit;
}


$db = new PDO("mysql:host=localhost;dbname=culinary knife set", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


function display_welcome_message() {
    if (isset($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email'])) {
        echo "Welcome {$_SESSION['firstName']} {$_SESSION['lastName']} ({$_SESSION['email']})";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Home</h2>
   
    <?php display_welcome_message(); ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Knife Set - Home</title>
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
                <li><a href="shipping_details.html">Shipping</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="?logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Welcome to Culinary Knife Set</h1>
        <p>Explore our selection of high-quality knives!</p>
        <a href="products.php">View Products</a>
    </main>
    <footer>
        <p>&copy; 2024 Culinary Knife Set. All rights reserved.</p>
    </footer>
</body>
</html>
