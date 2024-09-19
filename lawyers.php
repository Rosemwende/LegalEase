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
        .custom-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .custom-col-12, .custom-col-4 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .custom-col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .custom-col-4 {
            flex: 0 0 33.333%;
            max-width: 33.333%;
        }
        /* Button Styles */
        .custom-btn-md {
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            border-radius: 0.3rem;
        }

        .custom-btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .custom-btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .custom-btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        /* Card Styles */
        .custom-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .custom-card-img-top {
            width: 100%;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }

        .custom-card-body {
            flex: 1 1 auto;
            padding: 1.25rem;
        }

        .custom-card-title {
            margin-bottom: 0.75rem;
        }

        /* Additional Styles */
        .custom-wrapper {
            padding: 15px;
        }

        .custom-section {
            padding: 60px 0;
        }

        .custom-bg-primary {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
        }

        .custom-img-fluid {
            max-width: 100%;
            height: auto;
        }

        .custom-ml-auto {
        margin-left: auto;
        }

        .custom-sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
            border: 0;
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
        <body>
            <div class="custom-wrapper" id="wrapper">
                <section class="custom-section">
                    <div class="custom-container">
                        <br/>
                        <a href="searchLawyer.php" type="submit" class="custom-btn custom-btn-md custom-btn-primary">
                            <i class="fa fa-search"></i>&nbsp; Find Lawyer
                        </a>
                        <hr/>
                        <div class="custom-row">
                            <?php
                            include_once 'db_con/dbCon.php';
                            $conn = connect();
                            $result = mysqli_query($conn,"SELECT * FROM participants, lawyer WHERE participants.u_id=lawyer.lawyer_id AND participants.status='Active'");
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                <div class="custom-col-4">
                                    <div class="custom-card">
                                        <img src="images/upload/<?php echo $row['image']; ?>" class="custom-card-img-top custom-img-fluid" alt="img">
                                        <div class="custom-card-body">
                                            <h5 class="custom-card-title"><?php echo $row['first_Name']; ?> <?php echo $row['last_Name']; ?></h5>
                                            <h6 class="custom-card-title"><?php echo $row['speciality']; ?></h6>
                                            <h6 class="custom-card-title"><span><?php echo $row['practise_Length']; ?></span></h6>
                                            <a class="custom-btn custom-btn-sm custom-btn-info" href="single_lawyer.php?u_id=<?php echo $row['u_id']; ?>">
                                                <i class="fa fa-street-view"></i>&nbsp; View Full Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </body>
        <script src="js/script.js"></script>
    </body>
</html>
