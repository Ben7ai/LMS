<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "lmsdatabase";

// Establish a connection to the database
$conn = mysqli_connect("localhost", "root", "", "lmsdatabase");

// Check for connection errors
if(mysqli_connect_errno()) {
    exit('Failed to connect to MySQL:' . mysqli_connect_error());
}

// Prepare and execute an SQL INSERT query
if($stmt = $conn->prepare('INSERT INTO user_profile(first_name, middle_name, last_name, suffix, date_of_birth, current_address, city, province_state, zip_code, second_address, second_city, second_province_state, second_zip_code, elementary_school, high_school)  
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
    $stmt->bind_param('sssssssssssssss', $_POST['fn'], $_POST['mn'], $_POST['ln'], $_POST['sx'], $_POST['dob'], $_POST['ca'], $_POST['c'], $_POST['ps'], $_POST['zc'], $_POST['sa'], $_POST['sc'], $_POST['sps'], $_POST['szc'], $_POST['es'], $_POST['hs']);
    $stmt->execute();
    
    // Redirect to a new page after successful insertion
    header('Location: home.html');
}
?>
