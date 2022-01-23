<script>
  function dateToString(milliseconds, def) {
    var d = new Date(milliseconds);
    console.log(milliseconds+" - "+d);
    if(d.getFullYear() == 1970) return def;
    return d.toLocaleDateString()+" - "+d.toLocaleTimeString();
  }
</script>

<?php
function getLastRef($time="0") {
  foreach (explode("#", $time) as $str) {
    if($str > $time) $time = $str;
  }
  if(!$time) return "0";
  else return $time."000";
}

if($_SESSION) {
  $result = $link->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'");
  $user = $result->fetch();
  $userId = $user['id'];
  $permission = $user['permission'];
} else {
  header("Location: ./index.php");
}
?>

<div class="manage">
  <script>
    function deleteLic(elementID, id) {
      console.log("Deleting license with id "+id+" -/- "+elementID);
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "scripts/Action.php?action=delete&id="+id, true);
      xhttp.send();
      $(".header"+elementID).slideUp();
      $("#entry"+elementID).slideUp();
    }
  </script>
  <h1>Lisansları Yönet</h1>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Kod</th>
        <th>Açıklama</th>
        <th>Eklenti</th>
        <th>IP</th>
        <th>Müşteri ID</th>
        <th>Son Etkileşim</th>
        <th> </th>
      </tr>
    </thead>
    <tbody>

      <?php
          if($permission == 1) {

            $sql= "SELECT * FROM `licenses`";
            $result=$link->query($sql);
            if($result->rowCount() >= 1) {
              foreach($result as $license) {
                $id = $license['id'];
                echo "<tr>";
                echo "<td class='header".$id."' > ".$id."</td>";
                echo "<td class='header".$id."' > ".$license['key']."</td>";
                echo "<td class='header".$id."' > ".$license['plDesc']."</td>";
                echo "<td class='header".$id."' > ".$license['plName']."</td>";
                echo "<td class='header".$id."' > ".$license['ip']."</td>";
                echo "<td class='header".$id."' >".$license['plClient']."</td>";
                echo "<td class='header".$id."'  id='date".$id."-2'></td>";
                echo "<td class='header".$id."'> <button onclick='window.location = `./index.php?page=edit&id=$id`' class='btn btn-outline-primary'><i class='fa fa-mouse-pointer'></i></button></td>";
                echo "<script> document.getElementById('date".$id."-2').innerHTML = dateToString(".getLastRef($license['lastRef']).", 'None yet'); </script>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='5' id='entry".$id."' style='display: none;'>";
              }
            } else {
              echo "<h3 style='color: #ff4a4a'>Hiç bir lisans yok.</h3>"; 
            }
          } else {
            $sql= "SELECT * FROM `licenses` WHERE `plClient` = $userId";
            $result=$link->query($sql);
            if($result->rowCount() >= 1) {
              foreach($result as $license) {
                $id = $license['id'];
                echo "<tr>";
                echo "<td class='header".$id."' > ".$id."</td>";
                echo "<td class='header".$id."' > ".$license['key']."</td>";
                echo "<td class='header".$id."' > ".$license['plDesc']."</td>";
                echo "<td class='header".$id."' > ".$license['plName']."</td>";
                echo "<td class='header".$id."' > ".$license['ip']."</td>";
                echo "<td class='header".$id."' >".$license['plClient']."</td>";
                echo "<td class='header".$id."'  id='date".$id."-2'></td>";
                echo "<td class='header".$id."'> <button onclick='window.location = `./index.php?page=edit&id=$id`' class='btn btn-outline-primary'><i class='fa fa-mouse-pointer'></i></button></td>";
                echo "<script> document.getElementById('date".$id."-2').innerHTML = dateToString(".getLastRef($license['lastRef']).", 'None yet'); </script>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='5' id='entry".$id."' style='display: none;'>";
              }
            } else {
              echo "<h3 style='color: #ff4a4a'>Hiç bir lisans yok.</h3>"; 
            }
          }
      ?>
     
    </tbody>
  </table>
</div>
