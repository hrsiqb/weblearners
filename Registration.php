<br><br><br><br><br>	

<?php

session_start();

if(isset($_SESSION['userEmail']))
    header("Location: Dashboard.php");
else
    {
include 'connection.php';

if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['country'])
                         && isset($_POST['pswd']) && isset($_FILES['file']['name']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$pswd = $_POST['pswd'];
$pswd_re_enter = $_POST['pswd-re-enter'];
$imagename = $_FILES['file']['name'];

echo $imagename . "<br>";

$image_location = "C:/xampp/htdocs/Pictures/" . $imagename;
$result1 = move_uploaded_file($_FILES['file']['tmp_name'], $image_location);
if($result1)
    echo "Image moved successfully <br>";
else 
	echo"img failed <br>";

$nameerror = "";
$emailerror = "";
$phoneerror = "";
$countryerror = "";
$imageerror = "";
$pswderror = "";
$repswderror = "";
if(empty($name))
        $nameerror = "enter name";
 else
    {
        if(preg_match("/^[a-zA-Z]*$/",$name))
            echo $name."<br>";
        else
        $nameerror =  "invalid name";
    }   

if(empty($email))
    $emailerror = "enter email";
else
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        echo $email. "<br>";
    else 
    $emailerror = "invalid email";
}

if(empty($phone))
    $phoneerror = "enter phone";
 else
 {
     if(is_numeric($phone))
        echo $phone. "<br>";
     else
        $phoneerror = "invalid phone";
 }

if(empty($country))
    $countryerror =  "select country";
else
    echo $country. "<br>";

    if(empty($imagename))
    $imageerror =  "select Image";
else
    echo $imagename. "<br>";

$passwordLength = strlen($pswd);
    if(empty($pswd))
        $pswderror = "enter password";
 else
 {
     if(preg_match("/[a-z]/",$pswd) && (preg_match("/[^\w]/",$pswd)) && ($passwordLength >= 6))
        echo $pswd. "<br>";
     else
         $pswderror =  "password must include lower case";
 }

if(empty($pswd_re_enter))
        $repswderror = "re enter password";
 else
 {
    if(preg_match("/[a-z]/",$pswd) && (preg_match("/[^\w]/",$pswd)) && ($passwordLength >= 6))
    echo $pswd_re_enter. "<br>";
    else
     $repswderror =  "password must include lower case";
 }

    $extension = pathinfo($image_location, PATHINFO_EXTENSION);
    $size = $_FILES['file']['size'];
    if($size > 1000000)
        echo "size is too large <br>";
    else
        echo "size is ok <br>";
    if($extension == "jpg" || $extension == "png" || $extension == "gif")
        echo "file type is correct <br>";
    else
        echo "file type is not correct <br>";
    $result =  mysqli_query($con, "INSERT INTO user (Name, Email, Phone, Country, Image, Password) VALUES ('$name','$email','$phone','$country','$imagename','$pswd')");
    if($result)
    {
        echo "record inserted <br>";
    }
    else 
        echo "error inserting record <br>";
}
    }
?> 

<!DOCTYPE html>
<html>
<head>    
    <title></title>
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="Bootstrap/js/jquery-3.1.1.min.js"></script>
    <!--Bootstrap js link-->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style type="text/css">
        h1 {
            color: #0e59a5;
            text-align: center;
        }

        label {
            color: #0e59a5;
        }
    </style>
</head>
<body>
    <!--========================================Navigation Bar=============================================-->
      
    <!--fixed-top class is used to fix the navigation bar to the top while scrolling(it is necessay to use margin-top(in the container on line 52) with this class)-->
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center fixed-top">
        <a href="#" class="navbar-brand" style="vertical-align:central"><p>CONTACT BOOK</p></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navcollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Contact us</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Via Email</a>
                        <a href="#" class="dropdown-item">Via Facebook</a>
                        <a href="#" class="dropdown-item">Via Whatsapp</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="Login.php" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--========================================Login Form=============================================-->
    <form class="container" style="margin-top:7vw"action=""method="POST" enctype="multipart/form-data" >
        <div class="col-md-12">
            <div class="col-md-5">
                <h1>Register</h1>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="enter name" class="form-control" />
                    <?php if(isset($nameerror))
                            echo $nameerror?>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="enter email" class="form-control" />
                    <?php if(isset($emailerror))
                            echo $emailerror?>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="enter Phone" class="form-control" />
                    <?php if(isset($phoneerror))
                            echo $phoneerror?>
                </div>

                <div class="form-group">
                    <label>Select Country</label>
                    <select class="form-control" name="country">
                        <option value="Pakistan">Pakistan</option>
                        <option value="India">India</option>
                        <option value="England">England</option>
                        <option value="USA">USA</option>
                    <?php if(isset($countryerror))
                            echo $countryerror?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" name="file" />
                    <?php if(isset($imageerror))
                            echo $imageerror?>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pswd" placeholder="enter Password" class="form-control" />
                    <?php if(isset($pswderror))
                            echo $pswderror?>
                </div>

                <div class="form-group">
                    <label>Re-Enter Password</label>
                    <input type="password" name="pswd-re-enter" placeholder="enter Password" class="form-control" />
                    <?php if(isset($repswderror))
                            echo $repswderror?>
                </div>
                <button class="btn btn-primary">Submit</button>
                <button class="btn btn-basic">Cancel</button>
            </div>
        </div>
    </form>

</body>
</html>