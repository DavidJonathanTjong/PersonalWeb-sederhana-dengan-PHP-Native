<?php
    if(!isset($_SESSION['U']) and (!isset($_SESSION['P']))){
      echo'<a class="nav-link" href="../pages.login.php">Login</a>';
    }
    include("../configs/connection.php");
    $idbio = $_GET['id'];
    $sql = mysqli_query($connect, "select * from biography where id_bio =$idbio");
    $data = mysqli_fetch_array($sql);
?>

<!-- biography form -->
<form name="bioform" method="post" enctype="multipart/form-data" action="" onsubmit="return validasiBioForm()">
  <div class="form-group">
    <label for="bioID">Biography Edit Form</label>
    <textarea class="form-control" name="bio" id="bioID" rows="5">
      <?php echo $data['biography'];?>
    </textarea>
    <span id="bio-error" class = "error-message"></span> 
  </div>
  <div class="form-group">
    <label for="fotoID">Foto Profil</label>
    <input type="file" name="foto" id="fotoID" accept="image/*">
    <span id="biofile-error" class = "error-message"></span>
  </div>
  <div class="form-group">
    <input
      type="submit"
      name="updatebio"
      class="btn btn-info"
      value="Update Data"
    />
    <input type="submit" class="btn btn-secondary" value="Reset Data" />
    <input
      type="button"
      class="btn btn-secondary"
      value="Back"
      onclick="location.href='bio.php'"
    />
  </div>
</form>
<!-- end of biography form  -->

<?php
  if(isset($_POST['updatebio'])){
    $bioaja = $_POST['bio'];
    $dir = "../uploads/";
    $filename = $data['photo'];

    //cek apakah file foto baru diupload? jika tidak maka pertahankan foto yang ada, jika iya maka periksa apakah extensionnya sesuai
    if($_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE) {
      //$_FILES['userfile']['error'] tampil jika ada eror yang terjadi saat upload file
      $filePath = $_FILES['foto']['tmp_name']; //ambil path file
      $fileName = $_FILES['foto']['name']; //ambil nama file
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $allowedExtensions = ['jpg','png', 'jpeg'];

      if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = $fileName;
        $dest_path = $dir . $newFileName;

        if(move_uploaded_file($filePath, $dest_path)) {
          $filename = $newFileName; // ubah nama file jika sukses
        }else{
          echo "<script type='text/javascript'> onload = function() { alert('File gagal diupload!'); }</script>";
        }
      }
    }

    $update = mysqli_query($connect, "update biography set biography = '$bioaja', photo = '$filename' where id_bio = '$idbio'");
    
    if ($update) { 
      header("location:../pages/bio.php");
    } else{
        echo "<script type='text/javascript'> onload =function()
        { alert('Data gagal disimpan!');}</script>";
      } 
  }
?>

<style>
    <?php
        include("../assets/css/style.css");
    ?>
</style>

<script type = "text/javascript">
    function validasiBioForm(){
        const desc = document.getElementById("bioID").value.trim();
        const descError = document.getElementById("bio-error");
        descError.textContent = "";

        const fileInput = document.getElementById("fotoID").value;
        const fileError = document.getElementById("biofile-error");
        fileError.textContent = "";

        const fileName = fileInput.split('.');
        const fileNameExtension = fileName[fileName.length - 1].toLowerCase();
        const cekExtensions = ["jpg", "jpeg", "png"];

        let isValid = true;
        if (desc === "") {
            descError.textContent = "Masukan deskripsi biografi";
            isValid = false;
        }
        //cek jika ada file yang diupload
        // if(fileName[0].length>0){
          //cek jika file extension tidak ada dalam syarat 
          if (!cekExtensions.includes(fileNameExtension)) {
            fileError.textContent = "Masukan hanya file gambar!";
            isValid = false;
          }
        // }
        return isValid;
    }
</script>