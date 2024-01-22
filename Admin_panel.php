<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 // $username coming from the form, such as $_POST['username']

?>
<?php require_once "config.php" ?>
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
                <h2><a class="text-light text-decoration-none" href="index.php">NewsPortal</a></h2>
            </div>
            <div class="col-sm-6 col-md-3 col-xl-2">
                <a type="button" href="register.php" class="btn btn-outline-light w-100" target="_blank">Register</a>
            </div>
        </div>
    </div>
</div>

    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
