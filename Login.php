<br><br><br><br>

<?php

session_start();

if(isset($_SESSION['userEmail']))
    header("Location: Dashboard.php");
else
    {

include 'connection.php';

if(isset($_POST['email']) && isset($_POST['pswd']))
{
$email = $_POST['email'];
$pswd = $_POST['pswd'];
// '*' means 'this function'
$query = "SELECT * FROM user WHERE Email = '$email' AND Password = '$pswd'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

if($count == 1)
    {
        echo "Login Successful <br>";
        $_SESSION['userEmail'] = $email;
        $_SESSION["message"] = "this is message";
        header("Location: Dashboard.php");
    }
else 
    echo "Login failed <br>";
print_r($rows);
echo $count;
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
                    <a href="Registration.php" class="nav-link">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--========================================Login Form=============================================-->
    <form class="container" style="margin-top:7vw"action=""method="POST" enctype="multipart/form-data" >
        <div class="col-md-12">
            <div class="col-md-5">
                <h1>Login</h1>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="enter email" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pswd" placeholder="enter Password" class="form-control" />
                </div>

                <button class="btn btn-primary">Submit</button>
                <button class="btn btn-basic">Cancel</button>
            </div>
        </div>
    </form>

</body>
</html>
<?php
    }
?>