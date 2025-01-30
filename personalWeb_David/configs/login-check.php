<?php
    include("connection.php");
    $usr = $_POST['user']; //didapat dari name pada content login
    $pss = md5($_POST['pass']); 
    $sql = mysqli_query($connect, "select * from user where username = '$usr' and password ='$pss' ");

    $rowCount = mysqli_num_rows($sql);

    if($rowCount !=0){
        session_start(); //mengaktifkan session
        $_SESSION['U'] = $usr; //membuat variabel dalam session untuk data user
        $_SESSION['P'] = $pss; //membuat variabel dalam session untuk data password

        header("location:../pages/home.php");
    }else{
        header("location:../pages/login.php");
    }

?>