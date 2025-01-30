<?php
    if(!isset($_SESSION['U']) and (!isset($_SESSION['P']))){
        header("location:login.php");
    }
    include("../configs/connection.php");
    
    $id = $_GET['id'];
    $deleteAdmin = mysqli_query($connect, "delete from biography where id_user = $id");
    $deleteUser = mysqli_query($connect, "delete from user where id_user = '$id' ");
    
    
    if($deleteUser and $deleteAdmin){
        header("location:../pages/user-management.php");
    }else{
        echo "<script type='text/javascript'> onload=function(){alert('Data gagal didelete!'); }</script> ";
    }
?>