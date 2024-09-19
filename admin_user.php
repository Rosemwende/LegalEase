<?php
	session_start();
	if($_SESSION['login']==TRUE AND $_SESSION['status']=='Active'){
		
		//session_start();
		include("db_con/dbCon.php");
		$conn = connect();
		if(isset($_GET['block_id'])){
			
			$id = $_GET['block_id'];
			//echo $id;exit;
			
			$sql = "UPDATE `participants` SET `status`='Block' WHERE u_id='$id'";
			//echo $sql;
			$conn->query($sql);
			header("Location:admin_user.php");
		}
		if(isset($_GET['unblock_id'])){
			
			$id = $_GET['unblock_id'];
			//echo $id;exit;
			
			$sql = "UPDATE `participants` SET `status`='Active' WHERE u_id='$id'";
			//echo $sql;
			$conn->query($sql);
			header("Location:admin_user.php");
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
    	.table {
    		width: 100%;
    		max-width: 100%;
    		margin-bottom: 1rem;
    		background-color: transparent;
    		border-collapse: collapse;
		}

		.table th, .table td {
    		padding: 0.75rem;
    		vertical-align: top;
    		border-top: 1px solid #dee2e6;
		}

		.table thead th {
    		vertical-align: bottom;
    		border-bottom: 2px solid #dee2e6;
    		background-color: #f2f2f2;
		}

		.table tbody + tbody {
    		border-top: 2px solid #dee2e6;
		}

		.table-bordered {
    		border: 1px solid #dee2e6;
		}

		.table-bordered th, .table-bordered td {
    		border: 1px solid #dee2e6;
		}

		.table-primary {
    		background-color: #e9ecef;
		}

		.table-responsive {
    		display: block;
    		width: 100%;
    		overflow-x: auto;
    		-webkit-overflow-scrolling: touch;
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
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-heading">Admin Panel</div>
            <div class="sidebar-menu">
                <a href="admin_dashboard.php" class="sidebar-item">Dashboard</a>
                <a href="admin_lawyer.php" class="sidebar-item active">See Lawyers</a>
                <a href="admin_user.php" class="sidebar-item">See Users</a>
            </div>
        </div>
        <section class="bookingrqst">
        	<div class="container">
        		<div class="span7">
        			<div class="widget stacked widget-table action-table">
        				<div class="widget-header">
        					<i class="icon-th-list"></i>
        					<h3>Registered Clients</h3>
        				</div>
        				<div class="widget-content">
        					<table class="table table-bordered  table-primary table-responsive">
        						<thead>
        							<tr>
        								<th>No.</th>
        								<th>Client ID</th>
										<th>First name</th>
										<th>Last name</th>
										<th>Email</th>
										<th>Contact Number</th>
										<th>Full Address</th>
										<th>City</th>
										<th>Zip Code</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php
								include_once 'db_con/dbCon.php';
								$conn = connect();
								$result = mysqli_query($conn,"SELECT * FROM participants INNER JOIN client on participants.u_id=client.client_id");
								$counter = 0;
								while($row = mysqli_fetch_array($result)) {
									?>
									<tbody id="myTable">
										<tr>
											<td><?php echo ++$counter ;?></td>
											<td><?php echo $row["u_id"]; ?></td>
											<td><?php echo $row["first_Name"]; ?></td>
											<td><?php echo $row["last_Name"]; ?></td>
											<td><?php echo $row["email"]; ?></td>
											<td>+254<?php echo $row["contact_number"]; ?></td>
											<td><?php echo $row["full_address"]; ?></td>
											<td><?php echo $row["city"]; ?></td>
											<td><?php echo $row["zip_code"]; ?></td>
											<td><img src="images/upload/<?php echo $row["image"]; ?>" class="img-fluid " alt="<?php echo $row["image"]; ?>"></td>
											<?php if ($row['status']=='Active'){ ?>
											<td>
												<a class="btn btn-sm btn-danger" href="admin_user.php?block_id=<?=$row['u_id']?>"><i class="fa fa-ban"></i>&nbsp; Block</a>
											</td>
											<?php }
												else{?>
											<td>
												<a class="btn btn-sm btn-warning" href="admin_user.php?unblock_id=<?=$row['u_id']?>"><i class="fa fa-unlock "></i>&nbsp; UnBlock</a>
											</td>
												<?php }?>
										</tr>
												<?php }?>

									</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<footer class="footer">
		<div class="footer-content">
            <p>&copy; 2024 LegalEase. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
<?php

}else 
header('location:login.php?deactivate');
?>						