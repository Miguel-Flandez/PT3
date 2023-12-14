<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Student</title>

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"
                        style="background-image: url('https://images.unsplash.com/photo-1690228835779-8482c60093bf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80');">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Edit Student Information</h1>
                            </div>

                            <?php
                                include("connect.php"); // Include your database connection file

                                // Retrieve individual data to be updated
                                if (isset($_GET['id'])) {
                                    $user_id = $_GET['id'];
                                    $sql = "SELECT * FROM user_tbl WHERE id = '$user_id'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        $email = $row['email'];
                                        $picture = $row['picture'];
                                        $birthdate = $row['birthdate'];
                                        $gender = $row['gender'];
                                        $address = $row['address'];
                                        $contact = $row['contact'];
                                    }
                                }

                                // Check if the update form is submitted
                                if (isset($_POST['submit'])) {
                                    $firstname = $_POST['firstname'];
                                    $lastname = $_POST['lastname'];
                                    $email = $_POST['email'];
                                    $birthdate = $_POST['birthdate'];
                                    $gender = $_POST['gender'];
                                    $address = $_POST['address'];
                                    $contact = $_POST['contact'];
                                    $user_id = $_GET['id']; // Use the user ID from the URL

                                    // Check if a new picture link is provided
                                    if (!empty($_POST['picture'])) {
                                        $picture = $_POST['picture'];
                                        $query = "UPDATE user_tbl SET firstname = '$firstname', lastname = '$lastname', email = '$email', picture = '$picture', gender = '$gender', address = '$address', contact = '$contact' WHERE id = '$user_id'";
                                    } else {
                                        // If no new picture link is provided, skip the picture update
                                        $query = "UPDATE user_tbl SET firstname = '$firstname', lastname = '$lastname', email = '$email', gender = '$gender', address = '$address', contact = '$contact' WHERE id = '$user_id'";
                                    }

                                    $result = $conn->query($query);

                                    if ($result == TRUE) {
                                        echo '<script type="text/javascript">';
                                        echo 'alert("Record successfully updated. . .")';
                                        echo '</script>';
                                        ?>
                                        <script type="text/javascript">
                                            window.location.href = 'admin_dashboard.php';
                                        </script>
                                    <?php
                                    } else {
                                        echo '<script type="text/javascript">';
                                        echo 'alert("Error in updating . .")';
                                        echo '</script>';
                                    }
                                }
                                ?>


                            <!-- EDIT FORM -->
                            <form class="user" action="" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="firstname"
                                            placeholder="First Name" value="<?php echo $firstname; ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="lastname"
                                            placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Email Address" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Profile Picture:</label>
                                    <input type="file" class="form-control-file" name="picture" id="picture">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" name="birthdate"
                                        placeholder="Date of Birth" value="<?php echo $birthdate; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="male" <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male
                                        </option>
                                        <option value="female" <?php echo ($gender == 'female') ? 'selected' : ''; ?>>
                                            Female</option>
                                        <option value="others" <?php echo ($gender == 'others') ? 'selected' : ''; ?>>
                                            Others</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="address"
                                        placeholder="Address" value="<?php echo $address; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" name="contact"
                                        placeholder="Contact No" value="<?php echo $contact; ?>" required>
                                </div>
                                <button type="submit" name="submit"
                                    class="btn btn-primary btn-user btn-block">Submit Changes</button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="admin_dashboard.php">Back to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
