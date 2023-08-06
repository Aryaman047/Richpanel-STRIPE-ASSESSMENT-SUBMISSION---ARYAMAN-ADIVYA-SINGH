<?php
$errorMSG = "";
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

if (empty($_POST["email"])) {
    $errorMSG = "Email is required ";
} else {
    $email = $_POST["email"];
}


if (empty($_POST["password"])) {
    $errorMSG = "Password is required ";
} else {
    $password = $_POST["password"];
}

if (empty($_POST["terms"])) {
    $errorMSG = "Terms is required ";
} else {
    $terms = $_POST["terms"];
}

if ($errorMSG == "") {
    // Database connection details
    $servername = "localhost";
    $username = "your_mysql_username";
    $password_db = "your_mysql_password";
    $dbname = "richpanel";

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement for data insertion
    $sql = "INSERT INTO stripe (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Something went wrong :(";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    echo $errorMSG;
}
?>
