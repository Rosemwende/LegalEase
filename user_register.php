<?php
session_start();
include("db_con/dbCon.php");

function generateRandomPassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $password;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = connect();

    $first_Name = isset($_POST['first_Name']) ? mysqli_real_escape_string($conn, $_POST['first_Name']) : '';
    $last_Name = isset($_POST['last_Name']) ? mysqli_real_escape_string($conn, $_POST['last_Name']) : '';
    $contact_number = isset($_POST['contact_number']) ? mysqli_real_escape_string($conn, $_POST['contact_number']) : '';
    $full_address = isset($_POST['full_address']) ? mysqli_real_escape_string($conn, $_POST['full_address']) : '';
    $city = isset($_POST['city']) ? mysqli_real_escape_string($conn, $_POST['city']) : '';
    $zip_code = isset($_POST['zip_code']) ? mysqli_real_escape_string($conn, $_POST['zip_code']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';

    // Check if all required fields are filled
    if (empty($first_Name) || empty($last_Name) || empty($contact_number) || empty($full_address) || empty($city) || empty($zip_code) || empty($email) || $agree !== 'y') {
        echo '<script type="text/javascript">
                alert("Please fill out all fields and agree to the terms and conditions.");
                window.history.back();
              </script>';
        exit;
    }

    // file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($imageName);

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpName, $targetFile)) {
            $newName = basename($imageName);
        } else {
            $newName = '';
        }
    } else {
        $newName = '';
    }

    // Generate a random password of 8 characters
    $password = generateRandomPassword(8);

    // Generate a unique ID for the user
    $u_id = uniqid();

    // SQL queries to insert data into tables
    $sql = "INSERT INTO `participants` (`u_id`, `first_Name`, `last_Name`, `email`, `password`, `status`, `role`) VALUES ('$u_id','$first_Name', '$last_Name', '$email', '$password', 'Active', 'Client');";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    $sql2 = "INSERT INTO `client` (`client_id`, `contact_number`, `full_address`, `city`, `zip_code`, `image`) VALUES ('$u_id', '$contact_number', '$full_address', '$city', '$zip_code', '$newName');";
    $result2 = mysqli_query($conn, $sql2);

    if (!$result2) {
        die('Error: ' . mysqli_error($conn));
    }

    // Show popup message and redirect
    echo '<script type="text/javascript">
            alert("Registered successfully! Your password is: ' . $password . '");
            window.location.href = "login.php";
          </script>';

    $conn->close();
}
?>

   

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media.css">
    <title>Register</title>
    <style>
        .clientregisterform {
            padding: 20px;
        }
        .container {
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            justify-content: center;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Adjusted max-width */
            margin: 0 auto; /* Center container horizontally */
        }

        .header-text {
            text-align: center; /* Center text */
            margin-bottom: 20px; /* Space between text and form */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            border: 1px solid #ccc; /* Add border to file input for consistency */
            padding: 5px; /* Add padding for better appearance */
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="left-nav">
                <li><a href="index.php">LEGALEASE</a></li>
            </ul>
            <ul class="right-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="lawyers.php">Lawyers</a></li>
                <li><a href="login.php">Login</a></li>
                <li class="dropdown">
                    <a href="#">Register &#9662;</a>
                    <div class="dropdown-content">
                        <a href="user_register.php">Register as a User</a>
                        <a href="lawyer_register.php">Register as a Lawyer</a>
                    </div>
                </li>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
    </header>
    <section class="clientregisterform">
        <div class="container">
            <div class="header-text">
                <h1>Hello !!!</h1>
                <h3>Register here to find suitable lawyers </h3>
            </div>
            <form action="user_register.php" method="POST" enctype="multipart/form-data" id="validateForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_Name">First Name</label>
                        <input type="text" name="first_Name" id="first_Name" placeholder="First name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_Name">Last Name</label>
                        <input type="text" name="last_Name" id="last_Name" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email address">
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" placeholder="Contact number">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-row">
                    <label for="address"><small>Put Your address here</small></label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="full_address">Full Address</label>
                        <input type="text" name="full_address" id="full_address" placeholder="Full address">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="city">City</label>
                        <select id="city" name="city">
                            <option value="" selected>Choose...</option>
                            <option value="Nairobi">Nairobi</option>
                            <option value="Mombasa">Mombasa</option>
                            <option value="Kisumu">Kisumu</option>
                            <option value="Nakuru">Nakuru</option>
                            <option value="Eldoret">Eldoret</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" name="zip_code" id="zip_code" placeholder="Zip code">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input id="accept" name="agree" type="checkbox" value="y">
                        <label for="accept"><strong>I Agree with terms & conditions</strong></label>
                        <p>Already have an account? <a href="login.php">Login Here</a></p>
                    </div>
                </div>
                <input name="post" type="submit" class="btn" value="Register">
            </form>
        </div>
    </section>
    <footer>
        <div class="customnav">
            <p>&copy; 2024 LegalEase. All rights reserved.</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
