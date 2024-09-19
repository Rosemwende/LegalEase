<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('dbCon.php');
    $con = connect();
    session_start();

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query for Lawyer
    $sql = "SELECT * FROM participants INNER JOIN lawyer ON participants.u_id = lawyer.lawyer_id WHERE email = '$email' AND password = '$password' AND role = 'Lawyer' AND status = 'Active'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['email'] = $email;
        $_SESSION['first_Name'] = $row['first_Name'];
        $_SESSION['last_Name'] = $row['last_Name'];
        $_SESSION['lawyer_id'] = $row['lawyer_id'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['login'] = TRUE;
        header("Location: ../lawyer_dashboard.php");
        exit();
    }

    // Query for Client
    $sql = "SELECT * FROM participants INNER JOIN client ON participants.u_id = client.client_id WHERE email = '$email' AND password = '$password' AND role = 'Client' AND status = 'Active'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['email'] = $email;
        $_SESSION['first_Name'] = $row['first_Name'];
        $_SESSION['last_Name'] = $row['last_Name'];
        $_SESSION['client_id'] = $row['client_id'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['login'] = TRUE;
        header("Location: ../user_dashboard.php");
        exit();
    }

    // Query for Admin
    $sql = "SELECT * FROM participants INNER JOIN administrator ON participants.u_id = administrator.administrator_id WHERE email = '$email' AND password = '$password' AND role = 'Admin' AND status = 'Active'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['email'] = $email;
        $_SESSION['first_Name'] = $row['first_Name'];
        $_SESSION['last_Name'] = $row['last_Name'];
        $_SESSION['u_id'] = $row['administrator_id'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['login'] = TRUE;
        header("Location: ../admin_dashboard.php");
        exit();
    }

    // If no match, return an error message
    echo "Email or password incorrect";
}
?>
