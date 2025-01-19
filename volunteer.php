<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST variables are set
if (isset($_POST['volunteerName'], $_POST['contactInfo'], $_POST['availability'], $_POST['taskAssigned'])) {
    
    // Assign POST values to variables
    $volunteerName = $_POST['volunteerName'];
    $contactInfo = $_POST['contactInfo'];
    $availability = $_POST['availability'];
    $taskAssigned = $_POST['taskAssigned'];

    // Prepare and bind statement with correct column names
    $stmt = $conn->prepare("INSERT INTO volunteer (volunteerName, contactInfo, availability, taskAssigned) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        // Bind parameters (adjust types as necessary)
        $stmt->bind_param("ssss", $volunteerName, $contactInfo, $availability, $taskAssigned);
        
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
