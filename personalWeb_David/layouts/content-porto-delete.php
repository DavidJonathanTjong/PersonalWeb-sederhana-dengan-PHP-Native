<?php
    if(!isset($_SESSION['U']) and (!isset($_SESSION['P']))){
        header("location:login.php");
    }
    include("../configs/connection.php");
    
    $id = $_GET['id'];
    $delete = mysqli_query($connect, "delete from portfolio where id_port = '$id' ");
    
    if($delete){
        header("location:../pages/porto.php");
    }else{
        echo "<script type='text/javascript'> onload=function(){alert('Data gagal didelete!'); }</script> ";
    }
?>