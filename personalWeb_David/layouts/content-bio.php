<!-- content biografi -->
<?php
    if(!isset($_SESSION['U']) and (!isset($_SESSION['P']))){
        $btn_status ="hidden";
        $hr = "";
    }else{
        $btn_status ="";
        $hr = "<hr>"; 
    }

include("../configs/connection.php"); 
$sql = mysqli_query($connect, "SELECT * from biography JOIN user ON user.id_user = biography.id_user"); 
?>

<?php
if(isset($_SESSION['U']) && isset($_SESSION['P'])){
  $user = $_SESSION['U'];
  $sqlGetIDuser_sekarang = mysqli_query($connect, "select * from user where username = '$user'");
  $dataUser = mysqli_fetch_array($sqlGetIDuser_sekarang);
  $iduser = $dataUser['id_user'];
  
  $sqlGetIDbio = mysqli_query($connect, "SELECT * from biography JOIN user ON user.id_user = biography.id_user WHERE user.id_user = '$iduser'");
  $dataID = mysqli_fetch_array($sqlGetIDbio);
  $idBio = $dataID['id_bio'];
}
  
?>

<button class="btn btn-info" <?php echo $btn_status; ?>
  onclick="location.href='bio-form.php?id=<?php
  echo $idBio?>'">Edit Data
</button>
<?php echo $hr; ?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Biografi</th>
      <th scope="col">Foto</th>
    </tr>
  </thead>

  <?php
        $nomor =1;
        while($data = mysqli_fetch_array($sql)) {?>
  <tbody>
    <tr>
      <td scope="row"><?php echo $nomor; ?></td>
      <td><?php echo $data['name']; ?></td>
      <td><?php echo $data['biography']; ?></td>
      <td>
        <?php 
          $namaFileFoto = $data['photo'];
        ?>
        <img src="../uploads/<?php echo $namaFileFoto?>" width="100rem" height="100rem" alt="gambar tidak tersedia"/>
      </td>
    </tr>
  </tbody>
  <?php $nomor++; }?>
</table>

<!-- content biografi-end -->
