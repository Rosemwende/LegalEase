<?php
session_start();

include("db_con/dbCon.php");

// Function to generate a random password
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
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $university_College = isset($_POST['university_College']) ? mysqli_real_escape_string($conn, $_POST['university_College']) : '';
    $degree = isset($_POST['degree']) ? mysqli_real_escape_string($conn, $_POST['degree']) : '';
    $passing_year = isset($_POST['passing_year']) ? mysqli_real_escape_string($conn, $_POST['passing_year']) : '';
    $full_address = isset($_POST['full_address']) ? mysqli_real_escape_string($conn, $_POST['full_address']) : '';
    $city = isset($_POST['city']) ? mysqli_real_escape_string($conn, $_POST['city']) : '';
    $zip_code = isset($_POST['zip_code']) ? mysqli_real_escape_string($conn, $_POST['zip_code']) : '';
    $practise_Length = isset($_POST['practise_Length']) ? mysqli_real_escape_string($conn, $_POST['practise_Length']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $speciality = isset($_POST['speciality']) ? mysqli_real_escape_string($conn, $_POST['speciality']) : '';

    $case_handle = isset($_POST['case_handle']) ? $_POST['case_handle'] : [];
    $case_handle_string = implode(', ', $case_handle);

    if (empty($first_Name) || empty($last_Name) || empty($contact_number) || empty($email) ||
        empty($university_College) || empty($degree) || empty($passing_year) || empty($full_address) ||
        empty($city) || empty($zip_code) || empty($practise_Length) || empty($speciality) ||
        !isset($_POST['agree'])) {
        echo '<script type="text/javascript">
                alert("Please fill all the required fields and agree to the terms.");
                window.location.href = "lawyer_register.php";
              </script>';
    } else {
        // Handle file upload
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

        $password = generateRandomPassword(8);

        $u_id = uniqid();

        $sql = "INSERT INTO participants (u_id, first_Name, last_Name, email, password, status, role) VALUES ('$u_id', '$first_Name', '$last_Name', '$email', '$password', 'Active', 'Lawyer')";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($result) {
            $sql2 = "INSERT INTO lawyer (lawyer_id, contact_Number, university_College, degree, passing_year, full_address, city, zip_code, practise_Length, case_handle, speciality, image) 
                     VALUES ('$u_id', '$contact_number', '$university_College', '$degree', '$passing_year', '$full_address', '$city', '$zip_code', '$practise_Length', '$case_handle_string', '$speciality', '$newName')";

            $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

            if ($result2) {
                // Show popup message with the password and redirect
                echo '<script type="text/javascript">
                        alert("Registered successfully! Your password is: ' . $password . '");
                        window.location.href = "login.php";
                      </script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        $conn->close();
    }
}
?>


   


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media.css">
    <title>Register</title>
    <style>
        .has-error .help-block {
            color: red;
        }

        .container {
            width: 30%; /* Adjust as needed */
            margin: 0 auto; /* Center container horizontally */
            padding: 20px;
            background-color: #f9f9f9; /* Light background for contrast */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .lawyer-register-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .lawyer-register-form h1, 
        .lawyer-register-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .row {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .col-md-6 {
            width: 100%;
            padding: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .has-error .form-input {
            border-color: red;
        }

        .has-error .help-block {
            color: red;
            margin-top: 5px;
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
    <section class="lawyer-register-form">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Hello Lawyer <i class="fas fa-user-tie"></i> !!</h1>
                    <h2>Please register yourself here <i class="fas fa-hand-point-right"></i></h2>
                </div>
                <div class="col-md-6">
                    <form action="lawyer_register.php" method="post" enctype="multipart/form-data" id="validateForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-input" id="first_Name" name="first_Name" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-input" id="lname" name="last_Name" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="num">Contact Number</label>
                            <input type="text" class="form-input" name="contact_number" id="contact_number" placeholder="Contact Number">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-input" id="email" name="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="num">Image</label>
                            <input type="file" class="form-input" name="image" id="image" oninput="CheckValue(this);">
                        </div>
                        <div class="form-row"><label for="edu"><small>Put Your Last Education</small></label></div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="institute">University / College Name</label>
                                <input type="text" class="form-input" id="institute" name="university_College" placeholder="Institute Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="degree">Degree</label>
                                <select id="degree" name="degree" class="form-input">
                                    <option value="" selected>Choose...</option>
                                    <option value="LLB">LLB</option>
                                    <option value="LLM">LLM</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="pyear">Passing Year</label>
                                <select id="passing_year" name="passing_year" class="form-input">
                                    <option value="" selected>Choose...</option>
                                  	<option value="2000">2000</option>
									<option value="2001">2001</option>
									<option value="2002">2002</option>
									<option value="2003">2003</option>
									<option value="2004">2004</option>
									<option value="2005">2005</option>
									<option value="2006">2006</option>
									<option value="2007">2007</option>
									<option value="2008">2008</option>
									<option value="2009">2009</option>
									<option value="2010">2010</option>
									<option value="2011">2011</option>
									<option value="2012">2012</option>
									<option value="2013">2013</option>
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2016">2020</option>
									<option value="2017">2021</option>
									<option value="2018">2022</option>
									<option value="2019">2023</option>
									<option value="2020">2024</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row"><label for="edu"><small>Put Your Chamber Location</small></label></div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Full Address</label>
                                <input type="text" class="form-input" id="address" name="full_address" placeholder="Full Address">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="city">City</label>
                                <select id="city" name="city" class="form-input">
                                    <option value="" selected>Choose...</option>
                                    <option value="Nairobi">Nairobi</option>
                                    <option value="Mombasa">Mombasa</option>
                                    <option value="Kisumu">Kisumu</option>
									<option value="Nakuru">Nakuru</option>
									<option value="Eldoret">Eldoret</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="zip">Zip Code</label>
                                <input type="text" class="form-input" id="zip" name="zip_code" placeholder="Zip Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="practise">Length of Practice</label>
                            <select id="practise" name="practise_Length" class="form-input">
                                <option value="" selected>Choose...</option>
                                <option value="1-5 years">1-5 years</option>
                                <option value="6-10 years">6-10 years</option>
                                <option value="11-15 years">11-15 years</option>
                                <option value="16-20 years">16-20 years</option>
                                <option value="Most Senior">Most Senior</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="speciality">Types of Case Handled</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="case_handle[]" value="Criminal matter" id="crime">
                                <label class="form-check-label" for="crime">Criminal Matter</label>
                            </div>
                            	<div class="form-check">
									<input class="form-check-input" type="checkbox"  name="case_handle[]" value="Civil matter" id="civil">
									<label class="form-check-label" for="civil">
										Civil matter
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox"  name="case_handle[]" value="Writ Jurisdiction" id="civil">
									<label class="form-check-label" for="civil">
										Writ Jurisdiction
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox"  name="case_handle[]" value="Company law" id="com">
									<label class="form-check-label" for="com">
										Company law
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox"  name="case_handle[]" value="Contract law" id="con">
									<label class="form-check-label"  for="con">
										Contract law
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox"  name="case_handle[]" value="Commercial matter" id="comm">
									<label class="form-check-label" for="comm">
										Commercial matter
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]" value="Construction law" id="cons">
									<label class="form-check-label" for="cons">
										Construction law
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]" value="Information Technology" id="it">
									<label class="form-check-label"  for="it">
										Information Technology
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]"  value="Family Law" id="fam">
									<label class="form-check-label" for="fam">
										Family Law
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]"  value="Religious Matter" id="rel">
									<label class="form-check-label"  for="rel">
										Religious Matter
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]"  value="Investment Matter" id="inv">
									<label class="form-check-label" for="inv">
										Investment Matter
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]" value="Labour Law" id="lab">
									<label class="form-check-label" for="lab">
										Labour Law
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]"  value="Property Law" id="prop">
									<label class="form-check-label" value="Labour Law" for="prop">
										Property Law
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]"  value="Taxation Matter" id="tax">
									<label class="form-check-label"  for="tax">
										Taxation Matter
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="case_handle[]"  value="Others" id="oth">
									<label class="form-check-label"  for="oth">
										Others
									</label>
								</div>
                            </div>
                            <div class="form-group">
                            <label for="speciality">My Speciality</label>
                            <select id="speciality" name="speciality" class="form-input">
                                <option value="" selected>Choose...</option>
                                <option value="Criminal Law">Criminal Law</option>
                               	<option value="Civil Law">Civil law</option>
								<option value="Writ Jurisdiction">Writ Jurisdiction</option>
								<option value="Company Law">Company law</option>
								<option value="Contract Law">Contract law</option>
								<option value="Commercial Law">Commercial law</option>
								<option value="Construction Law">Construction law</option>
								<option value="IT Law">IT law</option>
								<option value="Family Law">Family law</option>
								<option value="Religious Law">Religious law</option>
								<option value="Investment Law">Investment law</option>
								<option value="Labour Law">Labour law</option>
								<option value="Property Law">Property law</option>
								<option value="Taxation Law">Taxation law</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input id="accept" name="agree" type="checkbox" value="y" />
                                <strong>I Agree with Terms & Conditions</strong>
                            </div>
                        </div>
                        <input name="post" type="submit" class="btn-submit" value="Register" />
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="custom-nav">
            <p>&copy; 2024 LegalEase. All rights reserved.</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
