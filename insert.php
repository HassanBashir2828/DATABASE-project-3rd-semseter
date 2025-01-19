<?php
$conn = new mysqli("localhost", "root", "", "project");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['animal_id'], $_POST['animal_name'], $_POST['species'], $_POST['breed'], $_POST['age'])) {
    $animal_id = $_POST['animal_id'];
    $animal_name = $_POST['animal_name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $stmt = $conn->prepare("INSERT INTO animal (animal_id, animal_name, species, breed, age) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssi", $animal_id, $animal_name, $species, $breed, $age);
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