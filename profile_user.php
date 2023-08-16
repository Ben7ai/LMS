<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "lmsdatabase";

    $conn = mysqli_connect("localhost", "root", "", "lmsdatabase");

        if(mysqli_connect_errno()){
        exit('Failed to connect to MySQL:'.mysqli_connect_error());
        }

        if (!filter_var($_POST['em'], FILTER_VALIDATE_EMAIL)) {
        exit('Email is not valid!');
        }

        if($stmt = $conn->prepare('INSERT INTO user_profile(first_name, middle_name, last_name, suffix, email, date_of_birth, current_address, city, province_state, zip_code, second_address, second_city, second_province_state, second_zip_code, elementary_school, high_school)  
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')){
            $stmt->bind_param('ssssssssssssssss', $_POST['fn'], $_POST['mn'], $_POST['ln'], $_POST['sx'], $_POST['em'], $_POST['dob'], $_POST['ca'], $_POST['c'], $_POST['ps'], $_POST['zc'], $_POST['sa'], $_POST['sc'], $_POST['sps'], $_POST['szc'], $_POST['es'], $_POST['hs']);
            $stmt->execute();
            header('Location: home.html');
       }

