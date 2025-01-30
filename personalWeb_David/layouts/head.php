<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>David Personal Web</title>
    <!-- css bootstrap -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- my css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Personal Web</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link <?php if ($pageinfo == "Home") echo "active" ?>" href="../pages/home.php">Home</a>
            <a class="nav-item nav-link <?php if ($pageinfo == "Biography") echo "active" ?>" href="../pages/bio.php">Biografi</a>
            <a class="nav-item nav-link <?php if ($pageinfo == "Portfolio") echo "active" ?>" href="../pages/porto.php">Portofolio</a>
            <a class="nav-item nav-link <?php if ($pageinfo == "Contact") echo "active" ?>" href="../pages/contact.php">Contact</a>
            <?php
            session_start();
            if(!isset($_SESSION['U']) and (!isset($_SESSION['P']))){
              echo' <a class="nav-link" href="../pages/login.php">Login</a>';
            }else{
              include("../configs/connection.php");
              $user = $_SESSION['U'];
              $sqlGetIDuser_sekarang = mysqli_query($connect, "select * from user where username = '$user'");
              $dataUser = mysqli_fetch_array($sqlGetIDuser_sekarang);
              $iduser = $dataUser['id_user'];
              $sql = mysqli_query($connect, "select * from user where id_user = $iduser");
              $data = mysqli_fetch_array($sql);
              $namaUser = $data[1];
              //hanya ketika username bernama david maka dialah admin yang memiliki akses ke fitur user managament
              //opsi lain bisa memakai array lalu di cek usernamenya kalo mau admin >1
              if($namaUser == "david"){
                echo '<a class = "nav-item nav-link ';
                if($pageinfo == "User Management"){
                  echo"active";
                }
                echo '" href="../pages/user-management.php">User Management</a>';
              }
              echo '<a class="nav-link" href="#">| &nbsp; Halo, </>',$namaUser;
              echo '<a class="nav-link" href="../pages/logout.php">(Logout)</a>';
            }
            ?>
           
          </div>
        </div>
      </div>
    </nav>
    <!-- navbar end -->