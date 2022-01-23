
<div style="padding: 30px;" class="add">
  <h1>Yeni bir lisans oluştur.</h1>
  <form method="POST">
      
      <h3>Lisans ayarları</h3>
      <label for="licenseKey">Lisans kodu:</label>
      <br>
      <input style="width: 250px; display: inline;" value="" type="text" name="licenseKey" id="licenseKey" class="form-control">
      <a href="javascript:;" onclick="createRandomKey()" class="btn"><i class="fas fa-sync"></i></a>
      <br>
      <label for="ipAddress">IP adresi:</label>
      <input style="width: 250px;" value="127.0.0.1" type="text" name="ipAddress" id="ipAddress" class="form-control">
      <br>
      <label for="clientId">Müşteri ID:</label>
      <input style="width: 250px;" type="number" name="clientId" id="clientId" class="form-control">

      <h3>Eklenti ayarları</h3>
      <br>
      <label for="plDesc">Açıklama</span>
      <input name="plDesc" id="plDesc" type="text" class="form-control">
      <br>
      <label for="plDesc">Eklenti Adı</span>
      <input name="plName" id="plName" type="text" class="form-control">
      <br>
      <button type="submit" class="btn btn-outline-success">Oluştur</button>
  </form>
</div>
<script>

  function toggleReadonly(id) {
    if(document.getElementById(id).hasAttribute('readonly')) {
      document.getElementById(id).removeAttribute('readonly');
    } else {
      document.getElementById(id).setAttribute('readonly', '');
    }
  };
  
  function createRandomKey() {
    const randKey = Math.random().toString(36).substr(2, 4).toUpperCase()+"-"+Math.random().toString(36).substr(2, 4).toUpperCase()+"-"+Math.random().toString(36).substr(2, 4).toUpperCase()+"-"+Math.random().toString(36).substr(2, 4).toUpperCase();
    console.log(randKey);
    let input = document.getElementById('licenseKey');
    input.setAttribute('value', randKey)
  }
</script>
<?php

if($_POST) {
  $licenseKey = $_POST['licenseKey'];
  $clientId = $_POST['clientId'];
  $ipAddress = $_POST['ipAddress'];
  $plBound = 'on';
  $plName = $_POST['plName'];
  $plDesc = $_POST['plDesc'];

  try {
    $link->query("INSERT INTO `licenses` (`key`, `ip`, `plName`, `plDesc`, `plClient`) VALUES ('$licenseKey', '$ipAddress', '$plName', '$plDesc', '$clientId')");
    echo "
    <script>swal('Başarılı', 'Lisans başarıyla aktive edildi.', 'success');</script>
    ";
  } catch(PDOException $e) {
    echo '<h1 style="font-family: Poppins; text-align: center; padding-top: 250px;">Olamaz! Bir SQL Hatası meydana geldi. Aşağıda log işlendi. Kontrol et. Bir sıkıntı gözükmüyorsa geliştiriciye ulaş</h1> <br><h3 style="font-family: Poppins; text-align: center;">', $ex->getMessage(), '</h3>';
  }
}

?>