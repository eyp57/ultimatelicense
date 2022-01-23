<?php
  session_start();
  ob_start();
  require "scripts/connect.php";

  if(HTTPS){
    echo " <script>
    if (window.location.protocol != 'https:')
      window.location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    </script> ";
  }

  if (NOINDEX) {
  	$meta = "noindex, ";
  } else {
  	$meta = "index, ";
  }
  if (NOFOLLOW) {
  	$meta .= "nofollow";
  } else {
  	$meta .= "follow";
  }
  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }


  function getButton($name, $url){
    echo "<a href='?page=$url'> <div style='cursor: pointer;' class='al_btn'>
            <div class='anim_btn'>
              $name
            </div>
            $name
          </div> </a>";
  }
  $loggedIn = 0;

  if($_SESSION) $loggedIn = 1;
  
  if(!isset($_GET['page'])) $_GET['page'] = '';
  $page = $_GET["page"] ? $_GET['page'] : '';
  if($page == '' OR $page == 'logout') $page = "anasayfa";
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>UltimateLicense-System</title>

    <meta name="robots" content="<?php echo $meta; ?>">

    <script src='https://code.jquery.com/jquery-latest.min.js' type='text/javascript'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link rel='stylesheet' href='css/master.css' type='text/css' charset='utf-8'>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"> </script>
    <script src="js/master.js"> </script>

    <?php include("./layouts/header.php"); ?>
    <div style="margin: 40px;">
      <?php include("./content/$page.php");?>
    </div>
    <?php include("./layouts/footer.php"); ?>
  </body>
</html>
