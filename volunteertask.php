<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST variables are set
if (isset($_POST['taskId'], $_POST['volunteerId'], $_POST['taskDescription'], $_POST['dateAssigned'])) {
    
    // Assign POST values to variables
    $taskId = $_POST['taskId'];
    $volunteerId = $_POST['volunteerId'];
    $taskDescription = $_POST['taskDescription'];
    $dateAssigned = $_POST['dateAssigned'];

    // Prepare and bind statement with correct column names
    $stmt = $conn->prepare("INSERT INTO volunteertask (taskId, volunteerId, taskDescription, dateAssigned) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("iiss", $taskId, $volunteerId, $taskDescription, $dateAssigned);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Show success message only
            echo "Task has been successfully assigned.";
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
