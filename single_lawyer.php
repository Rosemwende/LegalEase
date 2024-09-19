<?php
	session_start();
	include("db_con/dbCon.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media.css">
    <title>LEGALEASE</title>
    <style>
        .profile-sidebar {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }

        .profile-img {
            width: 30%;
            border-radius: 50%;
        }

        .profile-main {
            padding: 20px;
        }

        .info-group {
            display: flex;
            margin-bottom: 15px;
        }

        .info-label {
            flex: 1;
            font-weight: bold;
        }

        .info-value {
            flex: 2;
        }

        .form-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin: 20px 0;
}

.form-label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-input input,
.form-input textarea {
    width: 30%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-input textarea {
    resize: vertical;
}

.submit-btn {
    background-color: #17a2b8;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
}

.submit-btn:hover {
    background-color: #138496;
}

.form-submit {
    margin-top: 5px;
}

.form-submit h6 {
    color: #dc3545;
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
    <section>
        <div class="container">
            <div class="row">
                <?php
                include_once 'db_con/dbCon.php';
                $conn = connect();
                $result = mysqli_query($conn, "SELECT * FROM participants,lawyer WHERE participants.u_id=lawyer.lawyer_id AND participants.status='Active' AND participants.u_id='" . $_GET['u_id'] . "'");
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="col-md-3">
                        <div class="profile-sidebar">
                            <img src="images/upload/<?php echo $row["image"]; ?>" class="profile-img" alt="profile picture">
                            <h2><?php echo $row["first_Name"]; ?> <?php echo $row["last_Name"]; ?></h2>
                            <h4><?php echo $row["speciality"]; ?></h4>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-main">
                            <div class="info-group">
                                <div class="info-label">
                                    <label for="email"><b>Contact number :</b></label>
                                </div>
                                <div class="info-value">
                                <p><?php echo $row["contact_Number"]; ?></p>
                            </div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <label for="email"><b>Email :</b></label>
                            </div>
                            <div class="info-value">
                                <p><?php echo $row["email"]; ?></p>
                            </div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <label for="email"><b>Education :</b></label>
                            </div>
                            <div class="info-value">
                                <p><?php echo $row["university_College"]; ?></p>
                                <p><?php echo $row["degree"]; ?></p>
                                <p><?php echo $row["passing_year"]; ?></p>
                            </div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <label for="email"><b>Practising location :</b></label>
                            </div>
                            <div class="info-value">
                                <p><?php echo $row["full_address"]; ?></p>
                                <p><?php echo $row["city"]; ?></p>
                                <p><?php echo $row["zip_code"]; ?></p>
                            </div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <label for="email"><b>Practising length :</b></label>
                            </div>
                            <div class="info-value">
                                <p><?php echo $row["practise_Length"]; ?></p>
                            </div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">
                                <label for="email"><b>Type of case handles:</b></label>
                            </div>
                            <div class="info-value">
                                <p><?php echo $row["case_handle"]; ?></p>
                            </div>
                        </div>  
                        
                       <form action="save_booking.php" method="post">
                        <div class="form-group">
                            <div class="form-label">
                                Book for appointment
                            </div>
                            <input type="hidden" name="lawyer_id" value="<?php echo $row['u_id']; ?>">
                            <input type="hidden" name="client_id" value="<?php echo $_SESSION['client_id']; ?>">
                            <div class="form-input">
                                <input type="date" name="date">
                            </div>
                            <div class="form-input">
                                <textarea name="description" cols="20" rows="4" placeholder="write description if any"></textarea>
                            </div>
                            <div class="form-submit">
                                <?php if (isset($_SESSION['login']) && $_SESSION['login'] == TRUE) { ?>
                                    <input name="post" type="submit" class="submit-btn" value="Request booking">
                                <?php } else { ?>
                                    <h6><a href="login.php">To Request for lawyer booking please login or registration first</a></h6>
                                <?php } ?> 
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    </section>
    <footer>
        <div class="footer-nav">
            <p>&copy; 2024 LegalEase. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
