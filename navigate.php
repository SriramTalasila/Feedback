<?php
    session_start();
    if(isset($_SESSION["username"])){
        echo $_SESSION["role"];
        if($_SESSION['role']=='admin')
            header('Location: admin/admin.php');
        elseif($_SESSION['role']=='Teacher')
            header('Location: teacher/teacher_home.php');
        else
            header('Location: student/student_home.php');
    }
?>