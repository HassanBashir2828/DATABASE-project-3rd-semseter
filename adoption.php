<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST variables are set
if (isset($_POST['adoptionId'], $_POST['animalId'], $_POST['adopterId'], $_POST['adoptionDate'])) {
    
    // Assign POST values to variables
    $adoptionId = $_POST['adoptionId'];
    $animalId = $_POST['animalId'];
    $adopterId = $_POST['adopterId'];
    $adoptionDate = $_POST['adoptionDate'];

    // Prepare and bind (match column names in your database)
    $stmt = $conn->prepare("INSERT INTO adoption (adoptionId, animalId, adoptorId, dateofadoption) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        // Bind parameters (adjust types as necessary)
        $stmt->bind_param("iiis", $adoptionId, $animalId, $adopterId, $adoptionDate);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Your data record is created successfully.";
        } else {
            echo "Error: Could not execute the query.";
        }
        
        $stmt->close(); // Close the statement
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Please fill in all required fields.";
}

$conn->close(); // Close the connection
?>
