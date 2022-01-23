<?php

  if(isset($_SESSION['username'])) {
    header("Location: ./index.php");
  }
  if(isset($_POST['register']) AND $_POST['register'] == 1){
    if($_POST['usr'] == '' OR $_POST['pw'] == ''OR $_POST['email'] == ''){
      echo "<script>swal('Oops!', 'Lütfen şifrenizi, kullanıcı adınızı ve e-postanızı giriniz', 'error')</script>";
    }else{
      $result = $link->prepare("INSERT INTO `users` (`username`, `password`, `email`) VALUES ('".$_POST['usr']."', '".md5($_POST['pw'])."', '".$_POST['email']."')");
      $resultF = $result->execute();
      
      if($resultF){        
        $_SESSION['username'] = $resultF['username'];
        $_SESSION['user_id'] = $resultF['id'];
        echo "<script>swal('Başarılı', 'Başarıyla kayıt oldunuz.', 'success')</script>";
				echo '<meta http-equiv="refresh" content="3;URL=index.php">';
      }else{
        echo "<script>swal('Oops!', 'Böyle bir kullanıcı zaten bulunuyor.', 'error')</script>";

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
      <input name="usr" type="text" required class="form-control">
    </div>
    <div class="input-group" style="width: 40%;">
      <span class="input-group-addon" style="width: 120px;">E-Posta</span>
      <input name="email" type="email" required class="form-control">
    </div>
    <div class="input-group" style="width: 40%;">
      <span class="input-group-addon" style="width: 120px;">Şifre</span>
      <input name="pw" type="password" required class="form-control" >
    </div>
    <input name="register" type="number" value="1" style="display:none">
    <br>
    <button type="submit" class='btn btn-outline-success'>

      Login <i class="fa fa-arrow-right"></i>
    </button>
  </form>
</div>
