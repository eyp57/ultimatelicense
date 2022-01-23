<?php

  if(isset($_SESSION['username'])) {
    header("Location: ./index.php");
  }
  if(isset($_POST['login']) AND $_POST['login'] == 1){
    if($_POST['usr'] == '' OR $_POST['pw'] == ''){
      echo "<script>swal('Oops!', 'Lütfen şifrenizi ve kullanıcı adınızı giriniz', 'error')</script>";

    }else{
      $result = $link->query("SELECT * FROM `users` WHERE `username` = '".$_POST['usr']."' AND `password` = '".md5($_POST['pw'])."'");
      $resultF = $result->fetch();
      
      if($resultF != null){        
        $_SESSION['username'] = $resultF['username'];
        $_SESSION['user_id'] = $resultF['id'];
        header("Location: ./index.php");
      }else{
        echo "<script>swal('Oops!', 'Kullanıcı adı veya şifre yanlış.', 'error')</script>";
      }
    }
  }
?>
<div class="login">
  <?php if(isset($error)) echo $error; ?>

  <div class="al_load">
    <i class="fa fa-user userlog"></i>
  </div>

  <form id="loginForm" action="#" method="post">
    <div class="input-group" style="width: 40%;">
      <span class="input-group-addon" style="width: 120px;">Kullanıcı adı</span>
      <input name="usr" type="text" class="form-control">
    </div>
    <div class="input-group" style="width: 40%;">
      <span class="input-group-addon" style="width: 120px;">Şifre</span>
      <input name="pw" type="password" class="form-control" >
    </div>
    <input name="login" type="number" value="1" style="display:none">
    <br>
    <button type="submit" class='btn btn-outline-success'>

      Login <i class="fa fa-arrow-right"></i>
    </button>
  </form>
</div>
