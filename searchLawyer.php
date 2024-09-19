<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEGALEASE</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
    	.lawyerscard {
    		background-color: #fff;
    		padding: 20px;
    		margin: 20px auto;
    		max-width: 1200px;
    		border-radius: 8px;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.container {
    		padding: 0 15px;
		}

		.row {
    		display: flex;
    		flex-wrap: wrap;
    		margin: -10px;
		}

		.col-md-4 {
    		flex: 1;
    		padding: 10px;
    		max-width: 33.3333%;
		}

		.col-md-8 {
    		flex: 1;
    		padding: 10px;
    		max-width: 66.6666%;
		}

		.form-group {
    		margin-bottom: 15px;
		}

		label {
   			 display: block;
    		margin-bottom: 5px;
    		font-weight: bold;
		}

		.form-control {
    		width: 100%;
    		padding: 8px;
    		border: 1px solid #ddd;
    		border-radius: 4px;
		}

		.btn {
    		padding: 10px 15px;
    		border: none;
    		border-radius: 4px;
    		color: #fff;
    		background-color: #007bff;
    		cursor: pointer;
		}

		.btn-primary {
    		background-color: #007bff;
		}

		.btn-info {
    		background-color: #17a2b8;
		}

		.btn-sm {
    		font-size: 14px;
    		padding: 5px 10px;
		}

		.btn:hover {
    		opacity: 0.9;
		}

		hr {
   	 		border: 1px solid #ddd;
    		margin: 20px 0;
		}

		/* Card Styles */
		.card {
    		background-color: #fff;
    		border: 1px solid #ddd;
    		border-radius: 8px;
    		overflow: hidden;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    		margin-bottom: 20px;
		}

		.card-img-top {
    		width: 100%;
    		height: auto;
		}

		.card-body {
    		padding: 15px;
		}

		.card-title {
    		margin: 0 0 10px;
    		font-size: 18px;
		}

		.card-title span {
    		font-weight: normal;
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
                <li><a href="#">About Us</a></li>
             </ul>
             <?php if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE){ ?>
             	<li class="">
				<ul class="right-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
			<?php }else{ ?>
				<ul class="left-nav">
				<li><a href="login.php">Login</a></li>
                <li class="dropdown">
                    <a href="#">Register &#9662;</a>
                    <div class="dropdown-content">
                        <a href="user_register.php">Register as a User</a>
                        <a href="lawyer_register.php">Register as a Lawyer</a>
                    </div>
                </li>
            </ul>
            <?php }?>
		</nav>
	</header>
	<body>
		<section class="lawyerscard">
			<div class="container">
				<form method="post" novalidate="novalidate" >
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="experience">Experience</label>
								<select name="experience" class="form-control">
									<option value="" selected>Choose...</option>
									<option value="1-5 years">1-5 years</option>
									<option value="6-10 years">6-10 years</option>
									<option value="11-15 years">11-15 years</option>
									<option value="16-20 years">16-20 years</option>
									<option value="Most Senior">Most Senior</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group ">
								<label for="speciality">Speciality</label>
								<select name="speciality" class="form-control">
									<option value="" selected>Choose...</option>
									<option value="Criminal law">Criminal law</option>
									<option value="Civil law">Civil law</option>
									<option value="Writ Jurisdiction">Writ Jurisdiction</option>
									<option value="Company law">Company law</option>
									<option value="Contract law">Contract law</option>
									<option value="Commercial law">Commercial law</option>
									<option value="Construction law">Construction law</option>
									<option value="IT law">IT law</option>
									<option value="Family law">Family law</option>
									<option value="Religious law">Religious law</option>
									<option value="Investment law">Investment law</option>
									<option value="Labour law">Labour law</option>
									<option value="Property law">Property law</option>
									<option value="Taxation law">Taxation law</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="location">Location</label>
							<select name="location" class="form-control">
								<option selected>Choose...</option>
								<option value="Nairobi">Nairobi</option>
								<option value="Mombasa">Mombasa</option>
								<option value="Kisumu">Kisumu</option>
								<option value="Nakuru">Nakuru</option>
								<option value="Eldoret">Eldoret</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4">
							<button id="button" type="submit" class="btn btn-mg btn-primary" name="submit" value="submit" style="float:right"><i class="fa fa-search"></i>&nbsp; Search Information</button>
						</div>
					</div>
				</form>
				<hr/>
				<div class="row " >
					<?php
					include_once 'db_con/dbCon.php';
					$conn = connect();
					if (isset($_POST['submit'])){
					$experience=$_POST['experience'];
					$speciality=$_POST['speciality'];
					$location=$_POST['location'];
								
					$result = mysqli_query($conn,"SELECT * FROM participants,lawyer WHERE participants.u_id=lawyer.lawyer_id 
					AND participants.status='Active'
					OR practise_Length='$experience'
					OR speciality='$speciality'
					OR city='$location'");
					while($row = mysqli_fetch_array($result)) {
						?>
						<div class="col-md-4">
							<div class="card" style="width: 18rem;">
								<img src="images/upload/<?php echo $row["image"]; ?>" class="card-img-top cusimg img-fluid" alt="img">
								<div class="card-body">
									<h5 class="card-title"><?php echo $row["first_Name"]; ?> <?php echo $row["last_Name"]; ?></h5>
									<h6 class="card-title"><?php echo $row["speciality"]; ?></h6>
									<h6 class="card-title"><span><?php echo $row["practise_Length"]; ?></span></h6>
									<a class="btn btn-sm btn-info" href="single_lawyer.php?u_id=<?php echo $row["u_id"]; ?>"><i class="fa fa-street-view"></i>&nbsp; View Full Profile</a>
								</div>
							</div>
						</div>
						<?php
					}}
					?>
				</div>
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
