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
    <style>
    	.container-fluid {
    		max-width: 1000px;
            margin: 0 auto;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            flex: 0 0 30%;
            max-width: 30%;
            margin-bottom: 0;
        }

        .form-group .form-control {
            flex: 1;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .customnav {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
    <title> </title>
</head>
<body>
	<header>
		<nav>
			<ul class="left-nav">
				<li><a href="index.php">LEGALEASE</a></li>
         	</ul>
         	<ul class="right-nav">
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
				<br/>
				<div class="card">
					<div class="card-title">
						<h4>Update Password</h4>
					</div>
					<div class="card-body">
						<script type="text/javascript">
							$(document).ready(function() {
								$('#example-progress-bar-hierarchy').strengthMeter('progressBar', {
									container: $('#example-progress-bar-hierarchy-container'),
									hierarchy: {
										'0': 'progress-bar-danger',
										'10': 'progress-bar-warning',
										'15': 'progress-bar-success'
									}
								});
							});
						</script>
						<?php
						include_once 'db_con/dbCon.php';
						$con = connect();
						if(isset($_POST['update'])){
							$email = $_SESSION['email'];
							$password = mysqli_real_escape_string($con, $_POST['current']);
							$new_password=$_POST['new_password'];
							$p_length=strlen($new_password);
							//echo $p_length;
							if($p_length <=5){
								echo "<div class='alert alert-danger'>
								Sorry User New Password Should be Minimum  6 Character .
								</div>";
							}else{
								$result = mysqli_query($con, "SELECT * FROM user WHERE email = '" . $email. "' and password = '" . $password. "' and role='User'");
								if ($row = mysqli_fetch_array($result)) {
									$query="UPDATE user set password='$new_password' where email='$email'";
									if(mysqli_query($con,$query)){
										echo "<div class='alert alert-success'>
										<strong>Password Successfuly Updated.</strong>
										</div>";
									}
								}else{
									echo "<div class='alert alert-danger'>
									Soory User... Inputed Current Password is Wrong.Please Type Again...
									</div>";
								}
							}
						}
						?>
						<div class="basic-form">
							<form autocomplete="off" method="post" action="update_password.php">
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-3 col-form-label">Current Password</label>
									<div class="col-sm-8" style="fload:right">
										<input type="password" name="current" class="form-control" required id="inputPassword" placeholder="Please Type Your Current Password">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-3 col-form-label">New Password</label>
									<div class="col-sm-8">
										<input type="password" name="new_password" onblur="checkLength(this)" class="form-control" id='password'  maxlength="30" required placeholder="Please Type Your New Password">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-3 col-form-label">Confirm Password</label>
									<div class="col-sm-8">
										<input type="password" name="confirm_password" class="form-control" id='confirm_password' required  placeholder="Please Type Your Confirm Password">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-8" style="margin-left:40%">
										<input type="submit" name="update" value="Update"  class="btn btn-success">
									</div>
								</div>
							</form>
							<script>
								var password = document.getElementById("password")
								, confirm_password = document.getElementById("confirm_password");
								function validatePassword(){
									if(password.value != confirm_password.value) {
										confirm_password.setCustomValidity("Passwords Don't Match");
									} else {
										confirm_password.setCustomValidity('');
									}
								}
								password.onchange = validatePassword;
								confirm_password.onkeyup = validatePassword;
							</script>
						</div>
					</div>
				</div>
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