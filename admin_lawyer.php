<?php
session_start();
if ($_SESSION['login'] == TRUE AND $_SESSION['status'] == 'Active') {
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
    	.lawyers-table {
    		width: 100%;
    		border-collapse: collapse;
		}

		.lawyers-table th,
		.lawyers-table td {
   			border: 1px solid #dee2e6;
    		padding: 8px;
    		text-align: left;
		}

		.lawyers-table th {
    		background-color: #343a40;
    		color: white;
		}

		.lawyers-table tbody tr:nth-child(even) {
    		background-color: #f8f9fa;
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

        <div class="content">
            <div class="content-header">
                <?php if (isset($_GET['done'])) {
                    echo "<div class='alert'>
                    <strong>Welcome!</strong> You are logged in as Admin.
                    </div>";
                } ?>
            </div>
            <div class="content-body">
                <h2>Registered Lawyers</h2>
                <table class="lawyers-table">
                    <thead>
                        <tr>
							<th>No.</th>
							<th>Lawyer ID</th>
							<th>First name</th>
							<th>Last name</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>Full Address</th>
							<th>City</th>
							<th>Zip Code</th>
							<th>Image</th>
							<th>University / College</th>
							<th>Degree</th>
							<th>Passing Year</th>
							<th>Practise Length</th>
							<th>Handle Cases</th>
							<th>Speciality</th>
							<th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    include_once 'db_con/dbCon.php';
                    $conn = connect();
					$result = mysqli_query($conn,"SELECT * FROM participants INNER JOIN lawyer on participants.u_id=lawyer.lawyer_id");
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
					<td>+254<?php echo $row["contact_Number"]; ?></td>
					<td><?php echo $row["full_address"]; ?></td>
					<td><?php echo $row["city"]; ?></td>
					<td><?php echo $row["zip_code"]; ?></td>
					<td><img src="images/upload/<?php echo $row["image"]; ?>" class="img-fluid " alt="<?php echo $row["image"]; ?>"></td>
					<td><?php echo $row["university_College"]; ?></td>
					<td><?php echo $row["degree"]; ?></td>
					<td><?php echo $row["passing_year"]; ?></td>
					<td><?php echo $row["practise_Length"]; ?></td>
					<td><?php echo $row["case_handle"]; ?></td>
					<td><?php echo $row["speciality"]; ?></td>
					<?php if ($row['status']=='Active'){ ?>
					<td>
					Active
					</td>
					<?php }
					else{?>
					<td>
					<a class="btn btn-sm btn-warning" href="approve_lawyer.php?unblock_id=<?=$row['u_id']?>"><i class="fas fa-hourglass"></i>&nbsp; Pending</a>
					</td>
					<?php }?>
					</tr>
					<?php
					}
					?>
							
                </table>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
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
