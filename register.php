<?php
    require_once('connect.php');

    if (isset($_POST['submit'])) {
        if($conn){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $picture = $_POST['picture'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $c_password = $_POST['c_password']; 

            if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
                // Get the uploaded file details
                $file_name = $_FILES['picture']['name'];
                $file_tmp = $_FILES['picture']['tmp_name'];
    
                // Define the directory where you want to save the uploaded files
                $upload_directory = 'uploads/';
    
                // Create the directory if it doesn't exist
                if (!is_dir($upload_directory)) {
                    mkdir($upload_directory, 0755, true);
                }
    
                // Generate a unique filename to avoid overwriting
                $unique_filename = time() . '_' . $file_name;
    
                // Move the uploaded file to the desired directory
                $destination = $upload_directory . $unique_filename;
                if (move_uploaded_file($file_tmp, $destination)) {
                    // File uploaded successfully, you can store the $destination in the database
                    // For example: $profile_picture_path = $destination;
                } else {
                    // Error handling for failed file upload
                }
            }

            $query = "INSERT INTO user_tbl (firstname, lastname, email, picture, birthdate, gender, address, contact, username, password, c_password, regs_date)
            VALUES ('$firstname', '$lastname', '$email', '$picture', '$birthdate', '$gender', '$address', '$contact', '$username', '$password', '$c_password', NOW())";

            $result = mysqli_query($conn, $query);

            if($result){
                header("Location: login.html");
                exit(); 
            }else{
                $err[] = 'Registration Failed...'.mysqli_error( $conn );

            }   
            mysqli_close($conn);
        }else{
            die('Connection Failed: '.mysqli_connect_error());
        }         
        }
    ?>