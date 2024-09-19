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
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media.css">
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
                <div class="sidebar-heading">Admin Panel</div>
                <div class="sidebar-menu">
                    <a href="admin_dashboard.php" class="sidebar-item">Dashboard</a>
                    <a href="admin_lawyer.php" class="sidebar-item active">See Lawyers</a>
                    <a href="admin_user.php" class="sidebar-item">See Users</a>
                </div>
            </div>
            <div id="page-content-wrapper">
                <?php if(isset($_GET['done'])){
                    echo "<div class='alert alert-danger alert-dismissible fade show'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <strong>Welcome!</strong> You are login as Lawyer.
                    </div>";
                }?>
                <section class="report-generation">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Generate Report</h2>
                                <form id="reportForm" action="generate_report.php" method="post">
                                    <div class="form-group">
                                        <label for="reportType">Report Type</label>
                                        <select class="form-control" id="reportType" name="reportType">
                                            <option value="pdf">PDF</option>
                                            <option value="csv">CSV</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Generate</button>
                                </form>
                                <div id="reportMessage"></div>
                            </div>
                        </div>
                    </div>
                </section>
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