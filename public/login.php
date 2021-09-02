<?php 
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: index.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement

        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo_connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            // session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("Location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo_connection);
}

include "templates/navnew.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rainyDay</title>

    <!--Import Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/style.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="icon" type="image/svg" href="assets/images/favicon.svg"/>


</head>
<body>
<div class="container">
<div class="row">
    <h2>Login to rainyDay</h2>
<form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<div class="input-field col s12 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <input id="username" name="username" type="text" class="validate" value="<?php echo $username; ?>">
          <label for="username">Username</label>
          <span class="helper-text error"><?php echo $username_err; ?></span>
        </div>
      
      <div class="input-field col s12 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <input id="password" type="password" class="validate" name="password">
          <label for="password">Password</label>
          <span class="helper-text error"><?php echo $password_err; ?></span>
        </div>
      
      <div class="input-field col s12">
      <button class="btn waves-effect waves-light" type="submit" name="action">Login
  </button>
  <a href="register.php" class="waves-effect waves-teal btn-flat">Create an account</a>
    </div>
</form>
</div>
</div>

<?php include "templates/footer.php";?>

