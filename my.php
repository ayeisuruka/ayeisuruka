<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ayeshmidance";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $msg = $_POST["msg"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO feedbacks (full_name, email, phone_number, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $number, $msg);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
