<?php
    session_start();
    if($_SESSION['login'] == TRUE AND $_SESSION['status'] == 'Active') {
        include("db_con/dbCon.php");
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media.css">
    <style>
    	.container-fluid {
    		background: #fff;
    		border-radius: 10px;
    		padding: 20px;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h1.mt-4 {
    		margin-top: 20px;
    		font-size: 2em;
    		color: #333;
		}
	</style>
	<title>Lawyer Profile</title>
</head>
<body>
	<header>
        <nav>
            <ul class="left-nav">
                <li><a href="index.php">Lawyer Management System</a></li>
            </ul>
            <ul class="right-nav">
                <li class="">
                    <a class="nav-link cus-a" href="#">Full Name: <?php echo $_SESSION['first_Name'];?> <?php echo $_SESSION['last_Name'];?></a>
                </li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="wrapper">
    	<div class="sidebar">
    		<div class="sidebar-heading">My Dashboard</div>
    		<div class="sidebar-menu">
                <a href="lawyer_dashboard.php" class="sidebar-item">Dashboard</a>
                <a href="lawyer_edit_profile.php" class="sidebar-item active">Edit</a>
                <a href="lawyer_booking.php" class="sidebar-item">Booking requests</a>
                <a href="update_password_admin.php" class="sidebar-item">Update password</a>
            </div>
        </div>
        <div id="page-content-wrapper">
        	<?php if(isset($_GET['done'])) {
        		echo "<div class='alert alert-danger alert-dismissible'>
        		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <strong>Welcome!</strong> You are logged in as Lawyer.
                </div>";
            } ?>
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to your profile</h1>
                <p>Welcome to your profile on the Lawyer Management System. We are thrilled to have you as part of our community. Here, you can easily manage your profile, view and update your information, and handle your booking requests with just a few clicks. Our platform is designed to provide a seamless and efficient experience, ensuring that you can focus on what matters most – providing excellent legal services to your clients. Thank you for being with us, and we look forward to supporting you in your professional journey.</p>
            </div>
        </div>
    </div>
    <footer>
    	<div class="customnav">
            <p>&copy; 2024 LegalEase. All rights reserved.</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
<?php
    } else {
        header('location:login.php?deactivate');
    }
?>
