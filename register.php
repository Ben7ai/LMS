<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "lmsdatabase";



    $con = mysqli_connect("localhost", "root", "", "lmsdatabase");

        
        if(mysqli_connect_errno()){
        exit('Failed to connect to MySQL:' .mysqli_connect_error());
       }

        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        exit('Password must be between 5 and 20 characters long!');
        }

        if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email is not valid!');
        }

        if ($stmt = $con->prepare('SELECT id FROM signup WHERE email = ?')) {
            $stmt->bind_param('s', $_POST['Email']);
            $stmt->execute();
            $stmt->store_result();
        
            if ($stmt->num_rows > 0) {
                exit('Email is already registered. Please use a different email.');
            }
        }    


        if($stmt = $conn->prepare('INSERT INTO signup(Email, password) VALUES (?, ?)')){
             $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
             $stmt->bind_param('ss', $_POST['Email'], $password);
             $stmt->execute();
        }

        else{
            echo 'Error';
        }
 

?>