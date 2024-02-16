<?php
// Validate form inputs
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate total declared value
    $declared_value = $_POST["declared_value"];
    if ($declared_value > 1000) {
        $errors[] = "Total declared value must be no more than $1,000.";
    }

    // Validate dimensions
    $length = $_POST["length"];
    $width = $_POST["width"];
    $height = $_POST["height"];
    if ($length > 36 || $width > 36 || $height > 36) {
        $errors[] = "Dimensions of the package cannot exceed 36 inches each.";
    }

    // Additional validation for addresses, states, and zip codes can be added here

    // If no errors, proceed with generating the shipping label
    if (empty($errors)) {
        // Generate shipping label
        $from_address = "250 Central Ave Newark NJ 07102";
        $to_address = $_POST["to_address"];
        $package_dimensions = "$length x $width x $height inches";
        $package_declared_value = "$$declared_value";
        $shipping_company = "UPS"; // Example
        $shipping_class = "Next Day Air"; // Example
        $tracking_number = "1234567890"; // Example
        $order_number = $_POST["order_number"];
        $ship_date = $_POST["ship_date"];

        // Display shipping label
        echo "<h2>Shipping Label</h2>";
        echo "<p><strong>From Address:</strong> $from_address</p>";
        echo "<p><strong>To Address:</strong> $to_address</p>";
        echo "<p><strong>Package Dimensions:</strong> $package_dimensions</p>";
        echo "<p><strong>Package Declared Value:</strong> $package_declared_value</p>";
        echo "<p><strong>Shipping Company:</strong> $shipping_company</p>";
        echo "<p><strong>Shipping Class:</strong> $shipping_class</p>";
        echo "<p><strong>Tracking Number:</strong> $tracking_number</p>";
        echo "<img src='Image/barcode.png' alt='Tracking Number Barcode'>";
        echo "<p><strong>Order Number:</strong> $order_number</p>";
        echo "<p><strong>Ship Date:</strong> $ship_date</p>";
    } else {
        // Display errors
        echo "<div class='error'><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
}
?>
