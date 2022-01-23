<?php
$loggedIn = 0;
$permission = 0;

if($_SESSION) {
    $loggedIn = 1;
    $res = $link->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'");
    $resF = $res->fetch();
    $permission = $resF['permission'];
}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">UltimateLicense</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarOpen" aria-controls="navbarOpen" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarOpen">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_GET["page"] == "" ? "active" : "")?>" href="./index.php">AnaSayfa</a>
                    </li>
                    <?php if($loggedIn == 1):?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET["page"] == "manage" ? "active" : "")?>" href="./index.php?page=manage">Lisansları Yönet</a>
                        </li>
                        <?php if($permission == 1):?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET["page"] == "dashboard" ? "active" : "")?>" href="./index.php?page=dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET["page"] == "add" ? "active" : "")?>" href="./index.php?page=add">Lisans Ekle</a>
                        </li>
                        <?php endif; ?>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET["page"] == "logout" ? "active" : "")?>" href="./logout.php" style="color: red;">Çıkış yap</a>
                        </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_GET["page"] == "login" ? "active" : "")?>" href="./index.php?page=login">Giriş yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_GET["page"] == "register" ? "active" : "")?>" href="./index.php?page=register">Kayıt ol</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>