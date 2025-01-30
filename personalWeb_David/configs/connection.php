<?php
    $servername = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "personalweb_david";

    $connect = mysqli_connect($servername, $dbuser, $dbpassword);

    $connect_error = "Koneksi gagal atau tidak ada";
    mysqli_select_db($connect, $dbname) or die($connect_error);

?>