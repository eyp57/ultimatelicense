<?php
if($_SESSION) {
    $result = $link->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'");
    $user = $result->fetch();
  
    $permission = $user['permission'];
  } else {
    header("Location: ./index.php");
}

if($_GET) {
    $id = $_GET['id'];

    $licenseq = $link->query("SELECT * FROM `licenses` WHERE `id` = $id");
    $license = $licenseq->fetch();

    if($license == NULL) {
        header("Location: ./index.php?page=manage");
    }
}

if($permission == 1) {
?>
<div style="padding: 30px;" class="add">
  <h1><?php echo $license['id'] ?> ID'li lisans düzenleniyor.</h1>
  <form method="POST">
      
      <h3>Lisans ayarları</h3>
      <label for="licenseKey">Lisans kodu:</label>
      <br>
      <input style="width: 250px; display: inline;" value='<?php echo $license['key'] ?>' type="text" name="licenseKey" id="licenseKey" class="form-control" readonly="readonly">
      <br>
      <label for="ipAddress">IP adresi:</label>
      <input style="width: 250px;" value='<?php echo $license['ip'] ?>' type="text" name="ipAddress" id="ipAddress" class="form-control">
      <br>
      <label for="clientId">Müşteri ID:</label>
      <input style="width: 250px;" type="number" value='<?php echo $license['plClient'] ?>' name="clientId" id="clientId" class="form-control" readonly="readonly">

      <h3>Eklenti ayarları</h3>
      <br>
      <label for="plDesc">Açıklama</span>
      <input name="plDesc" value='<?php echo $license['plDesc'] ?>' id="plDesc" type="text" class="form-control">
      <br>
      <label for="plDesc">Eklenti Adı</span>
      <input name="plName" id="plName" value='<?php echo $license['plName'] ?>' type="text" class="form-control">
      <br>
      <button type="submit" class="btn btn-outline-success">Kaydet</button>
  </form>
</div>

<?php 


if($_POST) {
    $clientId = $_POST['clientId'];
    $ipAddress = $_POST['ipAddress'];
    $plBound = 'on';
    $plName = $_POST['plName'];
    $plDesc = $_POST['plDesc'];
    $link->query("UPDATE `licenses` SET
        `ip` = '$ipAddress',
        `plName` = '$plName',
        `plDesc` = '$plDesc'
        WHERE `id` = $id;");
    echo "<script>swal('Başarılı', 'Lisans başarıyla düzenlendi.', 'success');</script>";
    header("Refresh:2; url=./index.php?page=manage");
}
} else if($license['plClient'] == $user['id']) { ?>

<div style="padding: 30px;" class="add">
  <h1><?php echo $license['id'] ?> ID'li lisans düzenleniyor.</h1>
  <form method="POST">
      
      <h3>Lisans ayarları</h3>
      <label for="licenseKey">Lisans kodu:</label>
      <br>
      <input style="width: 250px; display: inline;" value='<?php echo $license['key'] ?>' type="text" name="licenseKey" id="licenseKey" class="form-control" readonly="readonly">
      <br>
      <label for="ipAddress">IP adresi:</label>
      <input style="width: 250px;" value='<?php echo $license['ip'] ?>' type="text" name="ipAddress" id="ipAddress" class="form-control">
      <br>
      <label for="clientId">Müşteri ID:</label>
      <input style="width: 250px;" type="number" value='<?php echo $license['plClient'] ?>' name="clientId" id="clientId" class="form-control" readonly="readonly">

      <h3>Eklenti ayarları</h3>
      <br>
      <label for="plDesc">Açıklama</span>
      <input name="plDesc" value='<?php echo $license['plDesc'] ?>' id="plDesc" type="text" class="form-control" readonly="readonly">
      <br>
      <label for="plDesc">Eklenti Adı</span>
      <input name="plName" id="plName" value='<?php echo $license['plName'] ?>' type="text" class="form-control" readonly="readonly">
      <br>
      <button type="submit" class="btn btn-outline-success">Kaydet</button>
  </form>
</div>

<?php 


if($_POST) {
    $clientId = $_POST['clientId'];
    $ipAddress = $_POST['ipAddress'];
    $plBound = 'on';
    $plName = $_POST['plName'];
    $plDesc = $_POST['plDesc'];
    $link->query("UPDATE `licenses` SET
        `ip` = '$ipAddress',
        `plName` = '$plName',
        `plDesc` = '$plDesc'
        WHERE `id` = $id;");
    echo "<script>swal('Başarılı', 'Lisans başarıyla düzenlendi.', 'success');</script>";
    header("Refresh:2; url=./index.php?page=manage");
}
} else {
    echo "<script>swal('Ooops!', 'Lisans galiba bu lisans sana ait değil.', 'error');</script>";
    header("Refresh:2; url=./index.php");
} 
?>