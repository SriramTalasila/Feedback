<?php
    require("../connect.php");
    session_start();
    $err=$succ='';
    if(isset($_SESSION['username'])){
        if($_SESSION["role"] != 'Teacher'){
            header('Location: ../navigate.php');
        }
    }
    else{
        header('Location: ../login.php');
    }
    $tid = $_SESSION['uid'];
    $sql = "SELECT ROUND(AVG(`lq`)) as alq, ROUND(AVG(`ch`)) as ach, ROUND(AVG(`qts`)) as aqt, ROUND(AVG(`pae`)) as apa FROM `feedback` WHERE tid = $tid";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
?>
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
       #stats{
           border:1px solid black;
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

    <div id= "stats" class="container">
        <h3>Your Stats</h3>
        <ul class="list-group">
            <li class="list-group-item">Lecture Quality <span class="badge"><?php echo $row['alq']?></span></li>
            <li class="list-group-item">Consultation Hours <span class="badge"><?php echo $row['ach']?></span></li> 
            <li class="list-group-item">Quality of Tutorial session <span class="badge"><?php echo $row['aqt']?></span></li>
            <li class="list-group-item">Problem Answer efficiency <span class="badge"><?php echo $row['apa']?></span></li>  
        </ul>
        <div class="alert alert-info">
            1 - very poor, 2 - bad, 3 - Good, 4 - Very Good, 5 - Excellent 
        </div>
    </div>
    </body>

</html>