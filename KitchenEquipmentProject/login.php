<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>

    <?php
    
    $db = new PDO("mysql:host=localhost;dbname=culinary knife set", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $email = $_POST['email'];
        $password = $_POST['password'];

       
        $query = "SELECT * FROM culinaryknifemanagers WHERE emailAddress = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

       
        if ($user && password_verify($password, $user['password'])) {
           
            $_SESSION['email'] = $user['emailAddress'];
            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            
          
            header("Location: index.php"); 
            exit();
        } else {
            echo "<p>Invalid email or password.</p>";
        }
    }
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header("Location: login.php");
    exit();
}
    ?>
</body>
</html>
