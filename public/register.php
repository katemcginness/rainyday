<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo_connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo_connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("Location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <h2>Register to rainyDay</h2>
<form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> "method="post">

<div class="input-field col s12 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <input name="username" id="username" type="text" class="validate" value="<?php echo $username; ?>">
          <label for="username">Username</label>
          <span class="helper-text error"><?php echo $username_err; ?></span>
        </div>
      
      <div class="input-field col s12 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <input id="password" type="password" class="validate" name="password" value="<?php echo $password; ?>">
          <label for="password">Password</label>
          <span class="helper-text error"><?php echo $password_err; ?></span>
        </div>

        <div class="input-field col s12 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
          <input id="confirm_password" type="password" name="confirm_password" class="validate" value="<?php echo $confirm_password; ?>">
          <label for="confirm_password">Confirm password</label>
          <span class="helper-text error"><?php echo $confirm_password_err; ?></span>
        </div>
      
      <div class="input-field col s12">
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
  </button>
  <button class="btn waves-effect waves-light" type="reset" name="action">Reset
  </button>
  <div class="row">
      <p>Already have an account? </p>
  <a href="login.php" class="waves-effect waves-teal btn-flat">Login here</a>
</div>

  </div>
</form>
</div>
</div>

<?php include "templates/footer.php";?>