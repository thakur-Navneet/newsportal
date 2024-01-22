<?php require_once "header.php";?>

<div class="container-fluid prathma py-5">
<div class="container">
    <div class="row">
        <div class="col-xl-7  align-content-center d-flex flex-wrap">            
            <h2 class="text-light display-4"><strong>Contact us</strong></h2>
        </div>
    <div class="col-xl-5">
        <img class="img-fluid mt-3" src="system_img/contact_vector.png" />
    </div>
    </div>
</div>
</div>

<?php
// Define variables and initialize with empty values
$nameErr = $emailErr = $numberErr = $subjectErr = $messageErr = "";
$name = $email = $number = $subject = $message = "";
 
if($_SERVER["REQUEST_METHOD"] == "GET"){
    // Validate user name
    if(empty($_POST["name"])){
        $nameErr = "Please enter your name.";
    }
    else{
        $name = filterName($_POST["name"]);
        if($name == FALSE){
            $nameErr = "Please enter a valid name.";
        }
    }
}
?>


<div class="container-fluid py-5 contact">
    <div class="container">
    <div class="row">
        <div class="col-xl-4"></div>
        <div class="col-xl-4">
            <h2 class="portal-h1 text-center py-3">Get in touch</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 border p-3 shadow mt-3">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
                <input type="text" class="form-control border-0 border-round contact mt-4" id="name_cont" name="name" placeholder="Name" value="<?php echo $name; ?>" required/>
                <span class="error"><?php echo $nameErr; ?></span>

                <input type="email" class="form-control  border-0 border-round contact mt-4" id="email_cont" placeholder="Email" value="<?php echo $email; ?>" required/>
                <span class="error"><?php echo $emailErr; ?></span>

                <input type="number" class="form-control border-0 border-round  contact mt-4" id="Phone_cont" placeholder="Phone" value="<?php echo $number; ?>" required/>
                <span class="error"><?php echo $numberErr; ?></span>
                
                <input type="text" class="form-control  border-0 border-round contact mt-4" id="Subject" placeholder="Subject" value="<?php echo $subject; ?>" required/>
                <span class="error"><?php echo $subjectErr; ?></span>

                <label class="mt-4 for="textarea">Message</label>
                <textarea class="form-control border-0 border-round mt-4 contact" rows="6" placeholder="Enter your message"> </textarea>
                <span class="error"><?php echo $messageErr; ?></span>

                <a type="submit" class="btn btn-outline-success mt-3 w-100" onclick="alert('The data has been submitted');" value="Submit"/>Submit</a>
            </form>
        </div>
        <div class="col-xl-5 ps-5 pt-3" style="color: #6488EA;">
            <div class="row shadow py-5">
                <div class="col-xl-3 text-center">
                    <h1><i class="fa fa-phone" aria-hidden="true"></i></h1>
                </div>
                <div class="col-xl-9 text-start text-dark">
                    <h3>Give us a Call</h3>
                    <p>+91-9876543210</p>
                </div>
            </div>
            <div class="row shadow mt-3 py-5">
                <div class="col-xl-3 text-center">
                    <h1><i class="fa fa-envelope-o" aria-hidden="true"></i></h1>
                </div>
                <div class="col-xl-9 text-start text-dark">
                    <h3>Send us an email</h3>
                    <p>Newsportal@gmail.com</p>
                </div>
            </div>
            <div class="row shadow mt-3 py-5">
                <div class="col-xl-3 text-center">
                    <h1><i class="fa fa-map-marker" aria-hidden="true"></i></h1>
                </div>
                <div class="col-xl-9 text-start text-dark">
                    <h3>Find & Reach us</h3>
                    <p>Times Square, New York</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once "footer.php";?>
