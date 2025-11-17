<?php

$host = "localhost";
$username = "root"; 
$password = "";     
$dbname = "sports_shop";

// Connect to MySQL
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$table = "orders";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sport VARCHAR(50) NOT NULL,
    product VARCHAR(100) NOT NULL,
    quantity INT(3) NOT NULL,
    address VARCHAR(255) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table '$table' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Get form data
$customer_name = $_POST['customer_name'];
$email = $_POST['email'];
$sport = $_POST['sport'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$address = $_POST['address'];

// Insert form data into the table
$sql = "INSERT INTO $table (customer_name, email, sport, product, quantity, address)
        VALUES ('$customer_name', '$email', '$sport', '$product', '$quantity', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
