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
    	.table {
    		width: 100%;
    		border-collapse: collapse;
   	 		margin-bottom: 20px;
		}

		.table th, .table td {
    		padding: 10px;
    		text-align: left;
    		border-bottom: 1px solid #ddd;
		}

		/* Table Header Styles */
		.table thead th {
    		background-color: #f4f4f4;
    		color: #333;
    		font-weight: bold;
    		border-bottom: 2px solid #ddd;
		}

		/* Table Row Styles */
		.table tbody tr:nth-child(even) {
    		background-color: #f9f9f9;
		}

		.table tbody tr:hover {
   	 		background-color: #f1f1f1;
		}

		/* Table Border Styles */
		.table-bordered {
    		border: 1px solid #ddd;
		}

		.table-bordered th, .table-bordered td {
    		border: 1px solid #ddd;
		}

		/* Table Responsive Styles */
		.table-responsive {
   			 overflow-x: auto;
		}

		/* Widget Styles */
		.widget {
    		background: #fff;
    		border-radius: 10px;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    		margin-bottom: 20px;
		}

		.widget-header {
    		background-color: #f4f4f4;
    		padding: 10px;
    		border-bottom: 1px solid #ddd;
    		font-weight: bold;
		}

		.widget-content {
    		padding: 20px;
		}

		/* Custom Styles for Booking Requests Section */
		.bookingrqst {
    		margin: 20px;
		}

		.span7 {
    		width: 100%;
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
    			<div class="sidebar-heading">My profile</div>
    			<div class="sidebar-menu">
    				<a href="user_dashboard.php" class="sidebar-item">Dashboard</a>
                	<a href="user_profile.php" class="sidebar-item active">Edit profile</a>
                	<a href="user_booking.php" class="sidebar-item">Booking requests</a>
                	<a href="update_password.php" class="sidebar-item">Update password</a>
                </div>
            </div>
            <section class="bookingrqst">
            	<div class="container">
            		<div class="span7">
            			<div class="widget stacked widget-table action-table">
            				<div class="widget-header">
            					<i class="icon-th-list"></i>
            					<h3>Booking Request</h3>
            				</div>
            				<div class="widget-content">
            					<table class="table table-striped table-bordered  table-success table-responsive">
            						<thead>
            							<tr>
            								<th>No.</th>
											<th>Date</th>
											<th>Description</th>
											<th>Lawyer Name</th>
											<th>Status</th>
										</tr>
									</thead>
									<?php
									include_once 'db_con/dbCon.php';
									$a=$_SESSION['client_id'];
									$conn = connect();
									$result = mysqli_query($conn,"SELECT first_Name,last_Name,date,description,booking.status as status
									FROM booking,lawyer,participants
									WHERE booking.lawyer_id=lawyer.lawyer_id 
									AND lawyer.lawyer_id=participants.u_id 
												
									and booking.client_id='$a'
									");
									$counter = 0;
									while($row = mysqli_fetch_array($result)) {
										?>
										<tbody id="myTable">
											<tr>
												<td><?php echo ++$counter ;?></td>
												<td><?php echo $row["date"]; ?></td>
												<td><?php echo $row["description"]; ?></td>
												<td><?php echo $row["first_Name"]; ?> <?php echo $row["last_Name"]; ?></td>
												<td><?php echo $row["status"]; ?></td>
											</tr>
											<?php
										}
										?>
									</table>
								</div>
							</div>
						</div>
					</div>
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