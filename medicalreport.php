<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST variables are set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST); // Debugging: Print POST data
    echo "</pre>";

    if (isset($_POST['MedicalRecordId'], $_POST['animalId'])) {
        // Assign POST values to variables
        $MedicalRecordId = $_POST['MedicalRecordId'];
        $animalId = $_POST['animalId'];
        $vaccinationStatus = $_POST['vaccinationStatus'] ?? null; // Optional
        $healthHistory = $_POST['healthHistory'] ?? null;         // Optional

        // Prepare and bind statement with correct column names
        $stmt = $conn->prepare("INSERT INTO medicalreport (MedicalRecordId, animalId, vaccinationStatus, healthHistory) VALUES (?, ?, ?, ?)");
        
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("iiss", $MedicalRecordId, $animalId, $vaccinationStatus, $healthHistory);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "Medical record has been successfully submitted.";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close(); // Close the statement
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

$conn->close(); // Close the connection
?>
