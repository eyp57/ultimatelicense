<?php

if(file_exists('../config.php')) require '../config.php';
elseif (file_exists('config.php')) require 'config.php';
else breakDown("Could not find file 'config.php'");

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function breakDown($msg, $alert='0'){
  echo "<head>";
  echo "<link rel='stylesheet' href='css/master.css' type='text/css' charset='utf-8'>";
  echo "</head>";
  echo "<body>";
  $allCalss = "al_info";
  if($alert) $allCalss = "al_alert";
  exit("<div class='$allCalss'>$msg</div> ");
}

// $link = new PDO(HOST, USERNAME, PASSWORD, DB_NAME);
$link = new PDO("mysql:host=$HOST;dbname=$DB_NAME", "$USERNAME", "$PASSWORD");

try {
  if(!$link->query("DESCRIBE `users`")) {
    $link->query("CREATE TABLE `users` (
        `id` int(11) AUTO_INCREMENT,
        PRIMARY KEY(`id`),
        `username` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `permission` tinyint(4) NOT NULL DEFAULT '0',
        `email` VARCHAR(255) NOT NULL DEFAULT 'email@email-provider.com',
        `discord_id` VARCHAR(255) NOT NULL DEFAULT '0'
      )
      ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8");
    if(!ADMIN_USERNAME OR !ADMIN_PASSWORD) breakDown("Config.php ye admin hesabı bilgilerinizi giriniz" ,1);
    else{
      $link->query("
        INSERT INTO `users` (`username`, `password`, permission) VALUES ('".ADMIN_USERNAME."','".md5(ADMIN_PASSWORD)."', 1)
      ");
    }
    breakDown("`users` Veritabanı oluşturuldu  sayfayı yenileyin. | Adım [1/2]");
  }

  if(!$link->query("DESCRIBE `licenses`")){
    $link->query("CREATE TABLE `licenses` (
      `id` INT AUTO_INCREMENT,
      `key` TEXT NULL,
      `ip` VARCHAR(255) NOT NULL DEFAULT '127.0.0.1',
      `plName` TEXT NULL,
      `plDesc` TEXT NULL,
      `plClient` varchar(11),
      `lastRef` TEXT NULL,
      `currIPs` TEXT NULL,
      PRIMARY KEY (`id`)
      )
      ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8");

   breakDown("`licenses` Veritabanı oluşturuldu sayfayı yenileyin. | Adım [2/2]");
    }
} catch(PDOException $ex) {
  echo '<h1 style="font-family: Poppins; text-align: center; padding-top: 250px;">Olamaz! Bir SQL Hatası meydana geldi. Aşağıda log işlendi. Kontrol et. Bir sıkıntı gözükmüyorsa geliştiriciye ulaş</h1> <br><h3 style="font-family: Poppins; text-align: center;">', $ex->getMessage(), '</h3>';
}
?>
