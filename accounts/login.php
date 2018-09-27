<?php
    require("../connect.php");
    session_start();
    if(isset($_SESSION["username"])){
        header('Location: ../navigate.php');
    }
    $email='';
    $err='';
    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $pswd=$_POST['pwd'];
        $pswd1= sha1($pswd);
        $sql = "SELECT * FROM `users` where email = '$email' AND password = '$pswd1'";
        $res = mysqli_query($conn,$sql);
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            if($row['isactive']==1){
                $_SESSION["username"]=$row['username'];
                $_SESSION["role"]=$row['role'];
                $_SESSION["uid"]=$row['id'];
                header('Location: ../navigate.php');
            }
            else{
                $err = "Your account is inactive please contact website admin";
            }
        }
        else{
            $err = "Email/password incorrect";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="https://www.regenering.com/wp-content/uploads/feedback.png.cf_.png" type="image/x-icon">
    <title>Teacher Feedback</title>
    <style>
        #lg{
            width:40%;
        }
        </style>
</head>

<body>
    <nav class="navbar ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">Feedback</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="signup.php">
                        <span class="glyphicon glyphicon-user"></span> Signup</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="lg" class="container">
    <div class="row">
        <div class="col-sm-12 form-group-sm">
            <h3>Login</h3>
            <?php
                if($err!=''){
                    echo '<div class="alert alert-warning">';
                    echo $err;
                    echo '</div>';
                }
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email;?>" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" required>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" style="float:right" type="submit" name="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>