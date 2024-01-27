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
// Functions to filter user inputs
function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
}    
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}

// Define variables and initialize with empty values
$nameErr = $emailErr = $phoneErr = $subjectErr = $messageErr = "";
$name = $email = $phone = $subject = $message = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    // Validate email address
    if(empty($_POST["email"])){
        $emailErr = "Please enter your email address.";     
    } else{
        $email = filterEmail($_POST["email"]);
        if($email == FALSE){
            $emailErr = "Please enter a valid email address.";
        }
    }
    // Validate phone
    if(empty($_POST["phone"])){
        $phoneErr = "Please enter your number.";
    }
    else{
        $phone = $_POST["phone"];
        if($phone == FALSE){
            $phoneErr = "Please enter a valid number.";
        }
    }
    // Validate message subject
    if(empty($_POST["subject"])){
        $subject = "";
    } else{
        $subject = filterString($_POST["subject"]);
    }
    
    // Validate user comment
    if(empty($_POST["message"])){
        $messageErr = "Please enter your comment.";     
    } else{
        $message = filterString($_POST["message"]);
        if($message == FALSE){
            $messageErr = "Please enter a valid comment.";
        }
    }
}
/*
// Escape user inputs for security
$DBname = mysqli_real_escape_string($link, $_POST['name']);
$DBemail = mysqli_real_escape_string($link, $_POST['email']);
$DBphone = mysqli_real_escape_string($link, $_POST['phone']);
$DBsubject = mysqli_real_escape_string($link, $_POST['subject']);
$DBmessage = mysqli_real_escape_string($link, $_POST['message']);
*/ 
$DBname = $name;
$DBemail = $email;
$DBphone = $phone;
$DBsubject = $subject;
$DBmessage = $message;

// Attempt insert query execution
$sql = "INSERT INTO cont_form (name, email, phone, subject, message) VALUES ('$DBname', '$DBemail', '$DBphone', '$DBsubject', '$DBmessage')";
if(mysqli_query($link, $sql)){
    echo "<script> alert ('Records added successfully.');</script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);


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
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input type="text" class="form-control border-0 border-round contact mt-4" id="name_cont" name="name" placeholder="Name"required="required"/>
                <span class="error"><?php echo $nameErr; ?></span>

                <input type="email" class="form-control  border-0 border-round contact mt-4" id="email_cont" name="email" placeholder="Email" required="required"/>
                <span class="error"><?php echo $emailErr; ?></span>

                <input type="text" class="form-control border-0 border-round  contact mt-4" id="Phone_cont" name="phone" placeholder="Phone" required="required"/>
                <span class="error"><?php echo $phoneErr; ?></span>
                
                <input type="text" class="form-control  border-0 border-round contact mt-4" id="Subject" name="subject" placeholder="Subject" required="required"/>
                <span class="error"><?php echo $subjectErr; ?></span>

                <label class="mt-4 for="textarea">Message</label>
                <textarea name="message" class="form-control border-0 border-round mt-4 contact" rows="6" required="required"> </textarea>
                <span class="error"><?php echo $messageErr; ?></span>

                <input type="submit" class="btn btn-outline-success mt-3 w-100"  value="Submit"/>
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
