<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to Admin_panel page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Admin_panel.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
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
        $sql = "SELECT id, username, password FROM Admin_users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to Admin_panel page
                            header("location: Admin_panel.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="stylesheets/register.css">
</head>
<body>
<div class="container-fluid bg-secondary py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-9 col-xl-10">
                <h2 class="text-light">NewsPortal</h2>
            </div>
            <div class="col-sm-6 col-md-3 col-xl-2">
                <a type="button" href="register.php" class="btn btn-outline-light w-100" target="_blank">Register</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-5 back_main">
    <div class="container my-5 py-5">
            <h2 class="text-light">Login</h2>
            <p class="text-light">Please fill in your credentials to login into the admin panel.</p>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label class="text-light mt-2">Username</label>
                <input type="text" name="username" class="form-control text-light bg-transparent <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label class="text-light mt-2">Password</label>
                <input type="password" name="password" class="form-control text-light bg-transparent <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group mt-3">
                    <input type="submit" class="btn btn-success" value="Login">
                    <input type="reset" class="btn btn-danger ms-2" value="Reset">
            </div>
            <p class="text-light mt-2">Don't have an account? <a class="btn btn-sm btn-outline-secondary border-0 ms-1" href="register.php" target="_blank">Register here</a></p>
        </form>
    </div>
    </div>
<div class="container-fluid bg-secondary text-light">
    <div class="container">
        <p class="py-1">&copy Developed by Navneet Thakur</p>
    </div>
</div> 
</body>
</html>