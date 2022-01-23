
<?php
if(STATS){
  $logFile = fopen("log.txt", "r");
  if(!$logFile) exit(" <br/><br/>
                        <div class='al_alert'>
                          <b>Failed to read log-file!</b>
                          <br/>1. Check if the file log.txt exitst in the main folder
                          <br/> -> If not create a empty log.txt file
                          <br/>2. Check if php has access to this file
                          <br/> -> If not give PHP access [Contact your hosts support?]
                          <br/>3. Contact me for futher help!
                          <br/> -> Skype: Leoko33 | Mail: Leoko3344@gmail.com
                          <br/><br/>
                          <b>Just want to get rid of this error?</b>
                          <br/> Disable the stats in the config.php
                        </div> ");
  $statsData = array();
  $statsStringVerif;
  $statsStringFailed;
  $myTime = time();

  while(!feof($logFile)) {
    $data = explode("#", fgets($logFile));
    for ($i=0; $i < 12; $i++) {
      if(isset($data[1]) AND $data[1] > $myTime-(60*15*($i+1))){
        $statsData[$data[0]][$i] = (isset($statsData[$data[0]][$i]) ? $statsData[$data[0]][$i] : 0) +1;
        break;
      }
    }
  }

  $statsStringVerif = "";
  $statsStringFailed = "";

  for ($i=12; $i >= 0; $i--) {
    $statsStringVerif .= (!isset($statsData[1][$i]) ? '0' : $statsData[1][$i]).", ";
    $statsStringFailed .= (!isset($statsData[0][$i]) ? '0' : $statsData[0][$i]).", ";
  }



    if(isset($statsStringVerif))  $statsStringVerif = substr($statsStringVerif, 0, -2);
    if(isset($statsStringFailed)) $statsStringFailed = substr($statsStringFailed, 0, -2);
  fclose($logFile);
}

  if($_SESSION) {
    $result = $link->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'");
    $user = $result->fetch();
    $userId = $user['id'];
    $permission = $user['permission'];
    if($permission != 1) {
      header("Location: ./index.php");
    }
  } else {
    header("Location: ./index.php");
  }
  
?>


<h2>Dashboard</h2>
<p>
  <?php echo $loggedIn; ?>
</p>

<?php if(STATS){ ?>

<div class="stats">
  <canvas id="canvas" height="1" width="4"></canvas>
</div>
<div style="background-color: rgba(104, 255, 101, 1); width:20px; height:20px; border-radius:5px; float: left;"></div>
<span style="float: left;"> Onaylanmış lisans sorguları   </span>
<div style="background-color: rgba(233, 79, 79, 1); width:20px; height:20px; border-radius:5px; float: left;"></div>
<span style="float: left;"> Onaylanmamış lisans sorguları</span><br/><br/>

<?php } ?>

<p>
  Bu fork'da daha fazla Destek almak için 
  <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Forklayan reis">
    zRooter#7295         
  </a>
  discord adresi üzerinden ulaşın
</p>

<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*10)};
	var lineChartData = {
		labels : ["3h","2,75h","2,5h","2,25h","2h","1,75h","1,5h","1,25h","60min","45min","30min","15min","Last"],
		datasets : [
			{
				label: "Verified-Requests",
				fillColor : "rgba(39, 215, 62, 0.5)",
				strokeColor : "rgba(104, 255, 101, 1)",
				pointColor : "rgba(104, 255, 101, 1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(104, 255, 101, 1)",
				data : [
          <?php
            echo $statsStringVerif;
          ?>
        ]
			},

      {
				label: "Rejected-Requests",
				fillColor : "rgba(235, 0, 0, 0.5)",
				strokeColor : "rgba(233, 79, 79, 1)",
				pointColor : "rgba(233, 79, 79, 1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(233, 79, 79, 1)",
				data : [
          <?php
            echo $statsStringFailed;
          ?>
        ]
			},
		]
	}
window.onload = function(){
	var ctx = document.getElementById("canvas").getContext("2d");
	window.myLine = new Chart(ctx).Bar(lineChartData, {
		responsive: true,
    bezierCurveTension : 0.3
	});
}


</script>
