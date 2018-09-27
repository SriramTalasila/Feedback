<?php
    require("../connect.php");
    session_start();
    if(isset($_SESSION["username"])){
        header('Location: ../navigate.php');
    }
    $username='';
    $email='';
    $role='';
    $pswd='';
    $pswd1='';
    $err=$succ='';
    if(isset($_POST['submit'])){
        $username=$_POST['usr'];
        $email=$_POST['email'];
        $role=$_POST['role'];
        $pswd=$_POST['pwd'];
        $pswd1=$_POST['pwd1'];
        if($pswd==$pswd1){
            $pswd2 = sha1($pswd);
            $sql = "INSERT INTO `users`( `username`, `email`, `password`, `isactive`, `role`) VALUES ('$username','$email','$pswd2',1,'$role')";
            if (mysqli_query($conn, $sql)) {
                $succ = "Registered Successfully";
                $username='';
                $email='';
                $role='';
                $pswd='';
                $pswd1='';
            } else {
                $err = "<li>Username/email already exists</li>";
            }
        }
        else{
            $err = "<li>password doesn't match</li>";
        }
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="https://www.regenering.com/wp-content/uploads/feedback.png.cf_.png" type="image/x-icon">
    <title>Teacher Feedback</title>
    <style>
        #sg{
            width:40%;
        }
        </style>
</head>

<body>
    <nav class="navbar ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../">Feedback</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="login.php">
                        <span class="glyphicon glyphicon-log-in"></span> Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id ="sg" class="container">
    <div class="row">
        <div class="col-sm-12 form-group-sm">
            <h3>Signup</h3>
            <?php
                if($err!=''){
                    echo '<div class="alert alert-warning">';
                    echo $err;
                    echo '</div>';
                }
                elseif($succ!=''){
                    echo '<div class="alert alert-success">';
                    echo $succ;
                    echo '</div>';
                }
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="text" class="form-control" name="usr" id="usr" value="<?php echo $username;    ?>"required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email;?>" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" value="<?php echo $pswd;?>" required>
                </div>
                <div class="form-group">
                    <label for="pwd1">Confirm Password:</label>
                    <input type="password" class="form-control" name="pwd1" id="pwd1" required>
                </div>
                <div class="form-group">
                    <label for="role">Select Role:</label>
                    <select class="form-control" name="role" id="role">
                        <option>Teacher</option>
                        <option>Student</option>
                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>