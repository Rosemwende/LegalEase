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
    <style> 
    	.bookingrqst {
    		padding: 20px;
    		background-color: #f9f9f9;
    		border-radius: 8px;
    		margin: 20px auto;
    		max-width: 1200px;
		}

		.bookingrqst .container {
    		max-width: 100%;
    		margin: 0 auto;
		}

		.bookingrqst .widget-header {
    		background-color: #007bff;
    		color: #ffffff;
    		padding: 10px 15px;
    		border-radius: 8px 8px 0 0;
    		margin-bottom: 20px;
    		font-size: 1.25rem;
    		display: flex;
    		align-items: center;
		}

		.bookingrqst .widget-header .icon-th-list {
    		margin-right: 10px;
		}

		.bookingrqst .widget-content {
    		background-color: #ffffff;
    		padding: 20px;
    		border-radius: 0 0 8px 8px;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.bookingrqst .form-row {
    		margin-bottom: 15px;
		}

		.bookingrqst .form-group {
   			 margin-bottom: 15px;
		}

		.bookingrqst .form-control {
   	 		border-radius: 4px;
    		border: 1px solid #ccc;
    		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    		font-size: 1rem;
		}

		.bookingrqst .form-control:focus {
    		border-color: #007bff;
    		outline: none;
    		box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
		}

		.bookingrqst .btn {
 	   		background-color: #007bff;
    		border: none;
    		color: #ffffff;
    		padding: 10px 15px;
    		font-size: 1rem;
    		border-radius: 4px;
    		cursor: pointer;
    		transition: background-color 0.3s ease;
		}

		.bookingrqst .btn:hover {
    		background-color: #0056b3;
		}

		.bookingrqst .alert {
    		margin-bottom: 20px;
		}

		.bookingrqst .alert-success {
    		background-color: #d4edda;
    		border-color: #c3e6cb;
    		color: #155724;
		}

		.bookingrqst .alert-dismissible .close {
    		color: #000;
		}

		.bookingrqst .alert-dismissible .close span {
    		font-size: 1.5rem;
    		line-height: 1;
		}
	</style>
	<title></title>
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
    				<a href="lawyer_dashboard.php" class="sidebar-item">Dashboard</a>
                	<a href="lawyer_edit_profile.php" class="sidebar-item active">Edit</a>
                	<a href="lawyer_booking.php" class="sidebar-item">Booking requests</a>
                	<a href="update_password_admin.php" class="sidebar-item">Update password</a>
            	</div>
        	</div>
        	<section class="bookingrqst">
        		<div class="container">
        			<div class="span7">
        				<div class="">
        					<div class="widget-header">
        						<i class="icon-th-list"></i>
        						<?php if(isset($_GET['ok'])){
        							echo "<div class='alert alert-success alert-dismissible fade show'>
        							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        							<strong>Sucessfully!</strong> update your Profile.
        							</div>";
        						}?>
        					</div>
        					<div class="widget-content">
        						<div class="row">
        							<div class="col-md-1"></div>
        							<?php
        							$a=$_SESSION['lawyer_id'];
        							$conn = connect();
        							$result = mysqli_query($conn,"SELECT * FROM participants,lawyer WHERE participants.u_id=lawyer.lawyer_id AND participants.status='Active' AND participants.u_id='$a'");
        							while($row = mysqli_fetch_array($result)) {
        								?>
        								<div class="col-md-10">
        									<form  action="save_lawyer_edit_Profile.php"  method="post" enctype="multipart/form-data"  id="validateForm">
        										<div class="form-row">
        											<div class="form-group col-md-6">
        												<label for="fname">First Name</label>
        												<input type="text" class="form-control" id="first_Name" name="first_Name" value="<?php echo $row["first_Name"]; ?>">
        											</div>
        											<div class="form-group col-md-6">
        												<label for="lname">Last Name</label>
														<input type="text" class="form-control" id="lname" name="last_Name" value="<?php echo $row["last_Name"]; ?>">
													</div>
												</div>
												<div class="form-group">
														<label for="num">Contact Number</label>
														<input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php echo $row["contact_Number"]; ?>">
													</div>
													<div class="form-row"><label for="edu"><small>Put Your Last Education</small></label></div>
														<div class="form-row">
															<div class="form-group col-md-6">
															<label for="institute">University / College Name</label>
															<input type="text" class="form-control" id="institute" name="university_College" value="<?php echo $row["university_College"]; ?>">
														</div>
														<div class="form-group col-md-3">
															<label for="degree">Degree</label>
															<select id="degree" name="degree" class="form-control">
																<option value=" " selected>Choose...</option>
																<option value="LLB" <?php if ($row['degree']=='LLB'){echo "selected";}?>>LLB</option>
																<option value="LLM" <?php if ($row['degree']=='LLM'){echo "selected";}?>>LLM</option>
															</select>
														</div>
														<div class="form-group col-md-3">
															<label for="pyear">Passing Year</label>
															<select id="passing_year" name="passing_year" class="form-control">
																<option value=" " selected>Choose...</option>
																<option value="2000" <?php if ($row['passing_year']=='2000'){echo "selected";}?>>2000</option>
																<option value="2001" <?php if ($row['passing_year']=='2001'){echo "selected";}?>>2001</option>
																<option value="2002" <?php if ($row['passing_year']=='2002'){echo "selected";}?>>2002</option>
																<option value="2003" <?php if ($row['passing_year']=='2003'){echo "selected";}?>>2003</option>
																<option value="2004" <?php if ($row['passing_year']=='2004'){echo "selected";}?>>2004</option>
																<option value="2005" <?php if ($row['passing_year']=='2005'){echo "selected";}?>>2005</option>
																<option value="2006" <?php if ($row['passing_year']=='2006'){echo "selected";}?>>2006</option>
																<option value="2007" <?php if ($row['passing_year']=='2007'){echo "selected";}?>>2007</option>
																<option value="2008" <?php if ($row['passing_year']=='2008'){echo "selected";}?>>2008</option>
																<option value="2009" <?php if ($row['passing_year']=='2009'){echo "selected";}?>>2009</option>
																<option value="2010" <?php if ($row['passing_year']=='2010'){echo "selected";}?>>2010</option>
																<option value="2011" <?php if ($row['passing_year']=='2011'){echo "selected";}?>>2011</option>
																<option value="2012" <?php if ($row['passing_year']=='2012'){echo "selected";}?>>2012</option>
																<option value="2013" <?php if ($row['passing_year']=='2013'){echo "selected";}?>>2013</option>
																<option value="2014" <?php if ($row['passing_year']=='2014'){echo "selected";}?>>2014</option>
																<option value="2015" <?php if ($row['passing_year']=='2015'){echo "selected";}?>>2015</option>
																<option value="2016" <?php if ($row['passing_year']=='2016'){echo "selected";}?>>2016</option>
																<option value="2017" <?php if ($row['passing_year']=='2017'){echo "selected";}?>>2017</option>
																<option value="2018" <?php if ($row['passing_year']=='2018'){echo "selected";}?>>2018</option>
																<option value="2019" <?php if ($row['passing_year']=='2019'){echo "selected";}?>>2019</option>
																<option value="2020" <?php if ($row['passing_year']=='2020'){echo "selected";}?>>2020</option>
																<option value="2021" <?php if ($row['passing_year']=='2021'){echo "selected";}?>>2021</option>
																<option value="2022" <?php if ($row['passing_year']=='2022'){echo "selected";}?>>2022</option>
																<option value="2023" <?php if ($row['passing_year']=='2023'){echo "selected";}?>>2023</option>
																<option value="2024" <?php if ($row['passing_year']=='2024'){echo "selected";}?>>2024</option>
															</select>
														</div>
													</div>
													<div class="form-row"><label for="edu"><small>Put Your chamber Location</small></label></div>
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="address">Full Address</label>
															<input type="text" class="form-control" id="address" name="full_address" value="<?php echo $row["full_address"]; ?>">
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
															<input type="text" class="form-control" id="zip" name="zip_code" value="<?php echo $row["zip_code"]; ?>">
														</div>
													</div>
													<div class="form-group">
														<label for="practise">Length of practise</label>
														<select id="practise" name="practise_Length" class="form-control">
															<option value=" " selected>Choose...</option>
															<option value="1-5 years" <?php if ($row['practise_Length']=='1-5 years'){echo "selected";}?>>1-5 years</option>
															<option value="6-10 years" <?php if ($row['practise_Length']=='6-10 years'){echo "selected";}?>>6-10 years</option>
															<option value="11-15 years" <?php if ($row['practise_Length']=='11-15 years'){echo "selected";}?>>11-15 years</option>
															<option value="16-20 years" <?php if ($row['practise_Length']=='16-20 years'){echo "selected";}?>>16-20 years</option>
															<option value="Most Senior" <?php if ($row['practise_Length']=='Most Senior'){echo "selected";}?>>Most Senior</option>
														</select>
													</div>
													<div class="form-group">
														<label for="practise">My Speciality</label>
														<select id="practise" name="speciality" class="form-control">
															<option value=" " selected>Choose...</option>
															<option value="Criminal Law" <?php if ($row['speciality']=='Criminal Law'){echo "selected";}?>>Criminal law</option>
															<option value="Civil Law" <?php if ($row['speciality']=='Civil Law'){echo "selected";}?>>Civil law</option>
															<option value="Writ Jurisdiction" <?php if ($row['speciality']=='Writ Jurisdiction'){echo "selected";}?>>Writ Jurisdiction</option>
															<option value="Company Law" <?php if ($row['speciality']=='Company Law'){echo "selected";}?>>Company law</option>
															<option value="Contract Law" <?php if ($row['speciality']=='Contract Law'){echo "selected";}?>>Contract law</option>
															<option value="Commercial Law" <?php if ($row['speciality']=='Commercial Law'){echo "selected";}?>>Commercial law</option>
															<option value="Construction Law" <?php if ($row['speciality']=='Construction Law'){echo "selected";}?>>Construction law</option>
															<option value="IT Law" <?php if ($row['speciality']=='IT Law'){echo "selected";}?>>IT law</option>
															<option value="Family Law" <?php if ($row['speciality']=='Family Law'){echo "selected";}?>>Family law</option>
															<option value="Religious Law" <?php if ($row['speciality']=='Religious Law'){echo "selected";}?>>Religious law</option>
															<option value="Investment Law" <?php if ($row['speciality']=='Investment Law'){echo "selected";}?>>Investment law</option>
															<option value="Labour Law" <?php if ($row['speciality']=='Labour Law'){echo "selected";}?>>Labour law</option>
															<option value="Property Law" <?php if ($row['speciality']=='Property Law'){echo "selected";}?>>Property law</option>
															<option value="Taxation Law"  <?php if ($row['speciality']=='Taxation Law'){echo "selected";}?>>Taxation law</option>
														</select>
													</div>
													<div class="form-group">
														
													</div>
													<input name="update" type="submit" class="btn btn-block btn-info" value="Update"/>
												</form>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</section>
				</di>
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