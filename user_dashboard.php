<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		
		//session_start();
		include("db_con/dbCon.php");
		
	?>
	<!doctype html>
	<html lang="en">
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media.css">
    <title> </title>
    <style>
    	#page-content-wrapper {
    flex: 1;
    padding: 20px;
}

.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
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
            	<li><a href="lawyers.php">Lawyers</a></li>
            	<li class="">
            		<a class="nav-link cus-a" href="#">Full Name: <?php echo $_SESSION['first_Name'];?> <?php echo $_SESSION['last_Name'];?></a>
            	</li>
            	<li><a href="logout.php">Logout</a></li>
            </ul>
        	</nav>
    	</header>
			<body>

				<div class="wrapper">
					<div class="sidebar">
						<div class="sidebar-heading">My profile</div>
						<div class="sidebar-menu">
							<a href="user_dashboard.php" class="sidebar-item">Dashboard</a>
							<a href="user_profile.php" class="sidebar-item active">Edit profile</a>
							<a href="user_booking.php" class="sidebar-item">Booking requests</a>
							<a href="update_password.php" class="sidebar-item">Update password</a>
						</div>
					</div>
					<div id="page-content-wrapper">
						<?php if(isset($_GET['done'])){
							echo "<div class='alert alert-danger alert-dismissible fade show'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<strong>Welcome!</strong> You are login as a normal user.
							</div>";
						}?>
						<div class="container-fluid">
							<h1 class="mt-4">Welcome to your profile</h1>
							<p>Welcome to your profile page! Here, you can manage all aspects of your account and stay updated with your latest activities. Use the dashboard to navigate through your bookings, update your personal information, and change your password. Our goal is to ensure you have a seamless experience while using our platform.</p>

						</div>
					</div>
				</div>
			</body>
			<footer>
				<div class="customnav">
					<p>&copy; 2024 LegalEase. All rights reserved.</p>
				</div>
			</footer>
			<script src="js/script.js"></script>
		</body>
	</html>
	<?php
}else 
	header('location:login.php?deactivate');
?>