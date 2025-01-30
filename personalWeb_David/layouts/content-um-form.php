<?php
    if(!isset($_SESSION['U']) and (!isset($_SESSION['P']))){
        header("location:login.php");
    }
    include("../configs/connection.php");
    
    error_reporting(0);
    
    $id = $_GET['id'];
    $sql = mysqli_query($connect, "select * from user where id_user = '$id' ");
    $data = mysqli_fetch_array($sql);

    if($id == ""){
        $idpengguna = "hidden"; $actbtn = "adduser"; $actval = "Save Data";
    }else{
        $idpengguna = "readonly"; $actbtn = "updateuser"; $actval = "Update Data";
    }
?>

<form name="adminform" method="post" action="" onsubmit="return validasiAdmin()">
    <div class="form-group" <?php echo $idpengguna; ?>>
        <label for="userID">ID User</label>
        <input type="text" class="form-control" name="user" id="userID" value="<?php echo $data['id_user']; ?>" <?php echo $idpengguna; ?>>
    </div>
    <div class="form-group">
        <label for="namaID">Nama User</label>
        <input type="text" class="form-control" name="nama" id="namaID" value="<?php if($actbtn == "updateuser"){echo $data['name'];}else{echo '';}?>" placeholder="type your name here">
        <span id="nama-error" class = "error-message"></span>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="usernameID" value="<?php echo $data['username']; ?>" placeholder="type username here">
        <span id="username-error" class = "error-message"></span>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="passwordID" value="" placeholder="type password here">
        <span id="password-error" class = "error-message"></span>
    </div>
    <div class="form-group">
        <input type="submit" name="<?php echo $actbtn?>" class="btn btn-info" value="<?php echo $actval; ?>">
        <input type="submit" class="btn btn-secondary" value="Reset Data">    
        <input type="button" class="btn btn-secondary" onclick="location.href='user-management.php'" value="Back">    
    </div>

    <div id="dom-target" style="display: none;">
        <?php
            $isPHPvalid = true; 
            echo $isPHPvalid;
        ?>
    </div>

</form>

<?php
    if(isset($_POST['adduser'])){
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //cek apakah username ada
        $sqlCekUsername = "SELECT * FROM `user` WHERE username = '$username';";
        $hasilCekUsername = mysqli_query($connect, $sqlCekUsername);
        $rowCount = mysqli_num_rows($hasilCekUsername);
        if($rowCount == 0){
            //tambah record user
            $sql = "INSERT INTO `user`(`name`, `username`, `password`) VALUES ('$nama','$username','$password')";
            $simpan = mysqli_query($connect, $sql);

            //ambil id user
            $sqlGetID = "SELECT id_user FROM `user` WHERE username = '$username'";
            $ambilID = mysqli_query($connect, $sqlGetID);
            $data = mysqli_fetch_array($ambilID);
            $idUser = $data['id_user'];

            //tambah record biografi
            $sqladdBioRecord = "INSERT INTO `biography`(`id_user`, `biography`, `photo`) VALUES ('$idUser','','')";
            $simpanRecordBio = mysqli_query($connect, $sqladdBioRecord);

            //bila berhasil simpan user dan biografi kembali ke halaman user management
            if($simpan && $simpanRecordBio){
                header("location:../pages/user-management.php");
                echo "<script type='text/javascript'> onload=function(){alert('Data berhasil ditambahkan!'); }</script> ";
            }else{
                echo "<script type='text/javascript'> onload=function(){alert('Data gagal ditambahkan!'); }</script> ";
            }
        }else{
            //tampilkan pesan username sudah ada
            $isPHPvalid = false;
            echo "<script type='text/javascript'> onload=function(){alert('Username sudah ada!'); }</script> ";
        }
    }else if(isset($_POST['updateuser'])){
        $iduser = $_POST['user'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //cek apakah username sudah ada selain username pada id saat ini
        $sqlCekUsername = "SELECT * FROM `user` WHERE username = '$username' AND NOT `id_user` = '$iduser';";
        $hasilCekUsername = mysqli_query($connect, $sqlCekUsername);
        $rowCount = mysqli_num_rows($hasilCekUsername);

        //jika tidak ada lakukan update
        if($rowCount == 0){
            $sql = "UPDATE `user` SET `name`='$nama',`username`='$username',`password`='$password' WHERE id_user = $iduser";
            $update = mysqli_query($connect, $sql);
            if($update){
                header("location:../pages/user-management.php");
                echo "<script type='text/javascript'> onload=function(){alert('Data berhasil diupdate!'); }</script> ";
            }else{
                echo "<script type='text/javascript'> onload=function(){alert('Data gagal diupdate!'); }</script> ";
            }

        }else{
            //jika ada tampilkan pesan eror
            $isPHPvalid = false;
            echo "<script type='text/javascript'> onload=function(){alert('Username sudah ada!'); }</script> ";
        }
    }
?>

<style>
    <?php
        include("../assets/css/style.css");
    ?>
</style>

<script type = "text/javascript">
    function validasiAdmin(){
        const nama = document.getElementById("namaID").value.trim();
        const namaError = document.getElementById("nama-error");
        const username = document.getElementById("usernameID").value.trim();
        const usernameError = document.getElementById("username-error");
        const password = document.getElementById("passwordID").value.trim();
        const passwordError = document.getElementById("password-error");

        namaError.textContent = "";
        usernameError.textContent = "";
        passwordError.textContent = "";
        let isValid = true;
        
        var div = document.getElementById("dom-target");
        var myData = div.textContent;
        if(myData != 1){
            isValid = false;
        }
        if (nama === "" || nama.length > 50) {
            namaError.textContent = "Masukan nama tidak lebih dari 50 karakter";
            isValid = false;
        }
        if (username === "" || username.length > 50) {
            usernameError.textContent = "Masukan username tidak lebih dari 50 karakter";
            isValid = false;
        }
        if (password === "" || password.length > 255) {
            passwordError.textContent = "Masukan password";
            isValid = false;
        }
        return isValid;
    }
</script>