<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST variables are set
if (isset($_POST['adopterid'], $_POST['adopterName'], $_POST['contactInfo'], $_POST['address'])) {
    
    // Assign POST values to variables
    $adopterid = $_POST['adopterid'];
    $adopterName = $_POST['adopterName'];
    $contactInfo = $_POST['contactInfo'];
    $address = $_POST['address'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO adopters (adopterid, name, contactinfo, adress) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        // Bind parameters (adjust types as necessary)
        $stmt->bind_param("isss", $adopterid, $adopterName, $contactInfo, $address);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Show success message only
            echo "Your data record is created successfully.";
        } else {
            // Handle execution error
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close(); // Close the statement
    } else {
        // Handle preparation error
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Inform user to fill all fields
    echo "Please fill in all fields.";
}

$conn->close(); // Close the connection
?>
