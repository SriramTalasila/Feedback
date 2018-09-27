<?php
     require("check.php");
     $sql = "SELECT users.id, users.username, ROUND(AVG(`lq`)) as alq, ROUND(AVG(`ch`)) as ach, ROUND(AVG(`qts`)) as aqt, ROUND(AVG(`pae`)) as apa, COUNT(feedback.fid) as fcount FROM feedback INNER JOIN users ON feedback.tid=users.id GROUP BY feedback.tid";
     $res = mysqli_query($conn,$sql);
     if(isset($_POST['submit'])){
         echo "hai";
         $sql1= "DELETE FROM `feedback`;";
         mysqli_query($conn,$sql1);
         header("Refresh:0");
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
        .act {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">Feedback</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="act">
                    <a href="#">Teachers Stats</a>
                </li>
                <li>
                    <a href="students.php">Manage Students</a>
                </li>
                <li>
                    <a href="teachers.php">Manage Teachers</a>
                </li>
            </ul>
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
        ?>! Logged in as Admin</h3>
    </div>
    
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Teacher Name</th>
                    <th scope="col">Lecture Quality</th>
                    <th scope="col">Consultation Hours</th>
                    <th scope="col">Quality of Tutorial session</th>
                    <th scope="col">Problem Answer efficiency</th>
                    <th scope="col">No. of feedbacks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            echo "<tr><td>".$row['id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['alq']."</td>";
                            echo "<td>".$row['ach']."</td>";
                            echo "<td>".$row['aqt']."</td>";
                            echo "<td>".$row['apa']."</td>";
                            echo "<td>".$row['fcount']."</td>";
                        }
                    }
                    else{
                        echo "<tr ><td style='text-align:center' colspan='7'>No Records Found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
            if (mysqli_num_rows($res) > 0)
                echo '<a id="dbtn" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash"></span> Delete</a>';
        ?>
        <div class="modal" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                <p>Are you sure do you want to delete all records</p>
                </div>
                <div class="modal-footer">
                <form id= "DelForm" action="admin.php" method="POST">
                    <input type="submit" name="submit" class="btn btn-danger" value="yes" >
                    <a href="" class="btn btn-default" data-dismiss="modal">No</a>
                </form>
                </div>
            </div>
            </div>
        </div>
        
    </div>
    
<script>
    $(document).ready(function(){
    })
</script>

</body>

</html>