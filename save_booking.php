<header>	
	<script>
    function MySucessFn() {
      Swal.fire({
        title: "Dear User...",
        text: "Booking Details Saved Successfully",
        icon: "success",
        confirmButtonText: "OK"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'http://localhost/lawyermanagementsystem/index.php';
        }
      });
    }
  </script>
</header>
<?php
  include_once 'db_con/dbCon.php';

  $okFlag = TRUE;
  if ($okFlag) {

    $date = $_POST['date'];
    $description = $_POST['description'];
    $client_id = $_POST['client_id'];
    $lawyer_id = $_POST['lawyer_id'];
    
    $conn = connect();
    
    // SQL query for inserting data into the database
    $sql = "INSERT INTO `booking`(date, description, client_id, lawyer_id, status) VALUES('$date','$description','$client_id','$lawyer_id','Pending')";
    
    if (mysqli_query($conn, $sql)) {
      echo "<script type='text/javascript'>MySucessFn();</script>";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
?>
