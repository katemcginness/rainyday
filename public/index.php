<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:login.php");
    exit;
}
?>
<?php include "templates/header.php";?>
<?php include "templates/navuser.php";?>


<?php include "templates/footer.php";?>

