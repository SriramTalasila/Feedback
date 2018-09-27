<?php
     require("check.php");
     $sql = "SELECT * FROM `users` WHERE role = 'Teacher'";
     $res = mysqli_query($conn,$sql);
     if(isset($_POST['submit'])){
        if(!empty($_POST['id_list'])){
            if($_POST['submit']=='Enable'){
                foreach($_POST['id_list'] as $selected){
                    mysqli_query($conn,"UPDATE `users` SET `isactive`= 1 WHERE id=$selected;");
                }
                header("Refresh:0");
            }
            if($_POST['submit']=='Disable'){
                foreach($_POST['id_list'] as $selected){
                    mysqli_query($conn,"UPDATE `users` SET `isactive`= 0 WHERE id=$selected;");
                }
                header("Refresh:0");
            }
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
     .act{
        background-color:lightgrey;
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
                <li ><a href="admin.php">Teachers Stats</a></li>
                <li ><a href="students.php">Manage Students</a></li>
                <li class="act"><a href="teachers.php">Manage Teachers</a></li>
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
  <h2>Manage Teachers:</h2>
  <p>You can enable or disable the Teacher account</p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <form method="POST" action="">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Teacher ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if (mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                echo "<tr>";
                echo "<td><input type='checkbox' name='id_list[]' value='".$row['id']."'></td>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['email']."</td>";
                if($row['isactive']==1)
                    echo "<td>Active</td></tr>";
                else
                    echo "<td>Disabled</td></tr>";
            }
        }
        else{
            echo "<tr ><td style='text-align:center' colspan='5'>No Records Found</td></tr>";
        }
      ?>
    </tbody>
  </table>
        <input type="submit" class="btn btn-success" name="submit" value="Enable"/>
        <input type="submit" class="btn btn-danger" name="submit" value="Disable"/>
    </form>
</div>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</body>

</html>