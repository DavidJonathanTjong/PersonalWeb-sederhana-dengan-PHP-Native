<!-- content  -->
<div class="container">
  <div class="row">
    <div class="col-md-9 content">
      <?php
        if($pageinfo == "Biography"){
          include("content-bio.php");
        }
        if($pageinfo == "Portfolio"){
          include("content-porto.php");
        }
        if($pageinfo == "Contact"){
          include("content-contact.php");
        }
        if($pageinfo == "Login"){
          include("content-Login.php");
        }
        if($pageinfo == "Biography Form"){
          include("content-biography-form.php");
        }
        if($pageinfo == "Portfolio Form"){
          include("content-porto-form.php");
        }
        if($pageinfo == "User Management"){
          include("content-um.php");
        }
        if($pageinfo == "User Management Form"){
          include("content-um-form.php");
        }
      ?>
    </div>
    <div class="col-md-3">
      <ul class="list-group">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Morbi leo risus</li>
        <li class="list-group-item">Porta ac consectetur ac</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
    </div>
  </div>
</div>
<!-- content end  -->