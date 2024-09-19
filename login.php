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
        .error-message {
            color: red;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
        .registerform {
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column; /* Stack vertically */
            align-items: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        .row {
            width: 100%; /* Ensure the row takes full width */
        }

        .col-md-6 {
            flex: 1;
            padding: 10px;
            text-align: center; /* Center text */
        }

        .col-md-6 h2, .col-md-6 h4 {
            margin: 0;
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
    <section class="registerform">
        <?php
            if(isset($_GET['error'])){
                echo "
                <div class='alert alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Sorry User ...<strong>Wrong!</strong> Email or Password.
                </div>";
            }
            else if(isset($_GET['deactivate'])){
                echo "
                <div class='alert alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <center>Sorry User ...<br/>Please Type your Valid Email & Password</center>
                </div>";
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>LOGIN HERE !!! <i class="fas fa-hand-paper"></i></h2><hr/>
                    
                </div>
                <div class="col-md-6">
                    <form action="db_con/db_login.php" method="POST" id="validateForm">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your Valid Email address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your Valid Password">
                        </div>
                        <input name="login" type="submit" class="btn" value="Login" />
                    </form>
                    <p> Don't have an account? <a href="index.php"> Register here</a></p>
                </div>
            </div>
        </div>
    </section>
    <script src="js/script.js"></script>
</body>
</html>
