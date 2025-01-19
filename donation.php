<?php
$conn = new mysqli("localhost", "root", "", "project");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['donorid'], $_POST['donorName'], $_POST['contactInfo'], $_POST['donationAmount'], $_POST['donationDate'])) {
    $donorid = $_POST['donorid'];
    $donorName = $_POST['donorName'];
    $contactInfo = $_POST['contactInfo'];
    $donationAmount = $_POST['donationAmount'];
    $donationDate = $_POST['donationDate'];
    $stmt = $conn->prepare("INSERT INTO donation (donorid, donorName, contactInfo, donationAmount, donationDate) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssi", $donorid, $donorName, $contactInfo, $donationAmount, $donationDate);
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close(); 
    } else {
        echo "Error preparing statement: " . $conn->error; 
     }
} else {
    echo "Please fill in all fields."; 
}
$conn->close(); 
?>