<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		
		//session_start();
		include("db_con/dbCon.php");
		$conn = connect();
		if(isset($_GET['unblock_id'])){
			
			$id = $_GET['unblock_id'];
			//echo $id;exit;
			
			$sql = "UPDATE `booking` SET `status`='Accepted' WHERE booking_id='$id'";
			//echo $sql;
			$conn->query($sql);
			header("Location:lawyer_booking.php");
		}
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
    	.bookingrqst {
    		background: #fff;
    		border-radius: 10px;
    		padding: 20px;
    		margin: 20px 0;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.widget {
    		margin-bottom: 20px;
		}

		.widget-header {
    		background-color: #337ab7;
    		color: #fff;
    		padding: 10px;
    		border-radius: 10px 10px 0 0;
    		display: flex;
    		align-items: center;
		}

		.widget-header i {
    		margin-right: 10px;
		}

		.widget-content {
    		padding: 20px;
    		border: 1px solid #ddd;
    		border-radius: 0 0 10px 10px;
    		overflow-x: auto;
		}

		.table {
    		width: 100%;
    		border-collapse: collapse;
    		margin: 20px 0;
		}

		.table th,
		.table td {
    		padding: 12px;
    		border: 1px solid #ddd;
    		text-align: left;
		}

		.table th {
    		background-color: #f4f4f4;
		}

		.table tr:nth-child(even) {
    		background-color: #f9f9f9;
		}

		.table .btn {
    		padding: 5px 10px;
    		color: #fff;
    		border: none;
    		border-radius: 3px;
    		cursor: pointer;
		}

		.btn-warning {
    		background-color: #f0ad4e;
		}

		.btn-warning:hover {
    		background-color: #ec971f;
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
                <li><a href="login.php">Logout</a></li>
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
											<th>Client Name</th>
											<th>Date</th>
											<th>Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php
									include_once 'db_con/dbCon.php';
									$a=$_SESSION['lawyer_id'];
									$conn = connect();
									$result = mysqli_query($conn,"SELECT booking_id,first_Name,last_Name,date,description,booking.status as 'statuss' FROM booking,client,participants WHERE booking.client_id=client.client_id AND client.client_id=participants.u_id and booking.lawyer_id='$a'");
									$counter = 0;
									while($row = mysqli_fetch_array($result)) {
										?>
										<tbody id="myTable">
											<tr>
												<td><?php echo ++$counter ;?></td>
												<td><?php echo $row["first_Name"]; ?> <?php echo $row["last_Name"]; ?></td>
												<td><?php echo $row["date"]; ?></td>
												<td><?php echo $row["description"]; ?></td>
												<?php if ($row['statuss']=='Pending'){ ?>
													<td>
														<a class="btn btn-sm btn-warning" href="lawyer_booking.php?unblock_id=<?=$row['booking_id']?>"><i class="fas fa-hourglass"></i>&nbsp; Pending</a>
													</td>
												<?php }
												else{?>
													<td>
														Active
													</td>
												<?php }?>
											</tr>
										</tbody>
									<?php }?>
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
</body>
</html>
	<?php
		
	}else 
	header('location:login.php?deactivate');
?>