<?php
    require("../connect.php");
    session_start();
    $err=$succ='';
    if(isset($_SESSION['username'])){
        if($_SESSION["role"] != 'Student'){
            header('Location: ../navigate.php');
        }
    }
    else{
        header('Location: ../login.php');
    }
    if(isset($_POST['submit'])){
         if(isset($_POST['LQ']) && isset($_POST['CH']) && isset($_POST['QTS']) && isset($_POST['PAE']) && isset($_POST["teacher"])){
            $sid= $_SESSION['uid'];
            $tid=$_POST["teacher"];
            $lq=$_POST['LQ'];
            $ch=$_POST['CH'];
            $qts=$_POST['QTS'];
            $pae=$_POST['PAE'];
            $sql = "INSERT INTO `feedback`(`sid`, `tid`, `lq`, `ch`, `qts`, `pae`) VALUES ($sid,$tid,$lq,$ch,$qts,$pae)";
            if(mysqli_query($conn,$sql)){
                $succ = "Feedback submitted successfully";
            }
         }
         else{
             $err = "Some Fields required";
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
       .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
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
                    <a href="../accounts/logout.php">
                        <span class="glyphicon glyphicon-log-out"></span> Log out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h3>Welcome
            <?php
            echo $_SESSION['username'];
        ?>!</h3>
    </div>
    <div class="container">
        <div class="container-fluid">
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
            <form method="post" action="">
                <label for="sel1">Select Teacher:</label>
                <select class="form-control" id="teacher" name="teacher" required>
                    <option>----</option>
                    <?php
                        $sql = "SELECT `id`, `username` FROM `users` WHERE role = 'Teacher' AND isactive = 1";
                        $res = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo "<option value='";
                            echo $row['id'];
                            echo "'>";
                            echo $row['username'];
                            echo "</option>";
                        }
                    ?>
                </select>
                <div class="container-fluid">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Faculty Quality</th>
                                <th>Excellent</th>
                                <th>Very Good</th>
                                <th>Good</th>
                                <th>Bad</th>
                                <th>Very poor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lecture Quality</td>
                                <td><input type="radio" name="LQ"  value="5"></td>
                                <td><input type="radio" name="LQ"  value="4"></td>
                                <td><input type="radio" name="LQ"  value="3"></td>
                                <td><input type="radio" name="LQ"  value="2"></td>
                                <td><input type="radio" name="LQ"  value="1"></td>
                            </tr>
                            <tr>
                                <td>Consultation Hours</td>
                                <td><input type="radio" name="CH" value="5"></td>
                                <td><input type="radio" name="CH" value="4"></td>
                                <td><input type="radio" name="CH" value="3"></td>
                                <td><input type="radio" name="CH" value="2"></td>
                                <td><input type="radio" name="CH" value="1"></td>
                            </tr>
                            <tr>
                                <td>Quality of Tutorial session</td>
                                <td><input type="radio" name="QTS" value="5"></td>
                                <td><input type="radio" name="QTS" value="4"></td>
                                <td><input type="radio" name="QTS" value="3"></td>
                                <td><input type="radio" name="QTS" value="2"></td>
                                <td><input type="radio" name="QTS" value="1"></td>
                            </tr>
                            <tr>
                                <td>Problem Answer efficiency</td>
                                <td><input type="radio" name="PAE" value="5"></td>
                                <td><input type="radio" name="PAE" value="4"></td>
                                <td><input type="radio" name="PAE" value="3"></td>
                                <td><input type="radio" name="PAE" value="2"></td>
                                <td><input type="radio" name="PAE" value="1"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" style="float:right" type="submit" name="submit" value="Submit">
                </div>
            </form>
            <div>
            </div>
</body>

</html>