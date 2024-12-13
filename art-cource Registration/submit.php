<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $course = htmlspecialchars($_POST['course']);
    $dob = htmlspecialchars($_POST['dob']);
    $experience = htmlspecialchars($_POST['experience']);
    $comments = htmlspecialchars($_POST['comments']);

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($course) || empty($dob) || empty($experience)) {
        echo "All fields are required!";
        exit;
    }

    // Database connection details
    $servername = "localhost";
    $username = "root"; // Default username for local setups
    $password = "";     // Default password for local setups
    $dbname = "registration_db";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the table
    $stmt = $conn->prepare("INSERT INTO registrations (fullname, email, phone, course, dob, experience, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $course, $dob, $experience, $comments);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful!</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Course:</strong> $course</p>";
        echo "<p><strong>Date of Birth:</strong> $dob</p>";
        echo "<p><strong>Experience Level:</strong> $experience</p>";
        echo "<p><strong>Comments:</strong> $comments</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
