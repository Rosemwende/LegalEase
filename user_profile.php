<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){

		//session_start();
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
	<title></title>
	<style>
.editprofile {
    margin-top: 20px;
}
.container {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}
.cusform {
    display: flex;
    flex-direction: column;
}

.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-group {
    flex: 1;
    margin-right: 15px;
}

.form-group:last-child {
    margin-right: 0;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    text-decoration: none;
}

.btn-info {
    background-color: #007bff;
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
    			<div class="sidebar-heading">My Dashboard</div>
    			<div class="sidebar-menu">
    				<a href="user_dashboard.php" class="sidebar-item">Dashboard</a>
                	<a href="user_profile.php" class="sidebar-item active">Edit</a>
                	<a href="user_booking.php" class="sidebar-item">Booking requests</a>
                	<a href="update_password.php" class="sidebar-item">Update password</a>
                </div>
            </div>
            <section class="editprofile">
            	<?php if(isset($_GET['ok'])){
            		echo "<div class='alert alert-success alert-dismissible fade show'>
            		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span
            		aria-hidden='true'>&times;</span></button>
					<strong>Sucessfully!</strong> update your Profile.
					</div>";
				}?>
				<?php
				$a=$_SESSION['client_id'];
				$conn = connect();

				$result = mysqli_query($conn,"SELECT * FROM participants,client WHERE participants.u_id=client.client_id AND participants.status='Active' AND participants.u_id='$a'");

				while($row = mysqli_fetch_array($result)) {
					?>
					<div class="container">
						<form class="cusform" action="save_user_edit_profile.php" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="fname">First Name</label>
									<input type="text" class="form-control" name="first_Name"  id="first_Name" value="<?php echo $row["first_Name"]; ?>">
								</div>
								<div class="form-group col-md-6">
									<label for="lname">Last Name</label>
									<input type="text" class="form-control" name="last_Name"  id="last_Name" value="<?php echo $row["last_Name"]; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="num">Contact Number</label>
								<input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php echo $row["contact_number"]; ?>">
							</div>

							<div class="form-row"><label for="edu"><small>Put Your address here </small></label></div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="address">Full Address</label>
									<input type="text" class="form-control" name="full_address" id="full_address" value="<?php echo $row["full_address"]; ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="city">City</label>
									<select id="city" name="city" class="form-control">
										<option value=" " selected>Choose...</option>
										<option value="Nairobi" <?php if ($row['city']=='Nairobi'){echo "selected";}?>>Nairobi</option>
										<option value="Mombasa" <?php if ($row['city']=='Mombasa'){echo "selected";}?>>Mombasa</option>
										<option value="Kisumu" <?php if ($row['city']=='Kisumu'){echo "selected";}?>>Kisumu</option>
										<option value="Nakuru" <?php if ($row['city']=='Nakuru'){echo "selected";}?>>Nakuru</option>
										<option value="Eldoret" <?php if ($row['city']=='Eldoret'){echo "selected";}?>>Eldoret</option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="zip">Zip code</label>
									<input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo $row["zip_code"]; ?>">
								</div>
							</div>
							<button type="submit" class="btn btn-info">Update</button>
						</form>
					</div>
					<?php
				}
				?>
			</section>
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