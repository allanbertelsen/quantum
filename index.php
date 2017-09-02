<html>
<head>
<script language="javascript">
function changeWindow() {
	var i=0;
  var elem = document.getElementById('winMinStyle');
  if (typeof(elem) != 'undefined' && elem !== null) {
     elem.id='winMaxStyle';
     document.getElementById('calcbut').src='images/minimer.png';
     document.getElementById('winHeader').width='100%';
		 i = window.innerHeight*90/100;
  } else {
     elem = document.getElementById('winMaxStyle');
     elem.id='winMinStyle';
     document.getElementById('calcbut').src='images/maximer.png';
     document.getElementById('winHeader').width='402';
		 i=190;
  }

	document.getElementById('winiframe').height=i-35;
}
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>
#winMinStyle {background-color: white; width:400; height:190; color: #009fe3; border-style: solid; border-width: 1px;position: fixed; left: 498; top: 580 }
#winMaxStyle {background-color: white; z-index: 10; top:2%; left:5%; position: fixed; width:90%; height:90%; color: #009fe3; border-style: solid; border-width: 1px;box-shadow: 0px 0px 15px #888888; font-family: Calibri, sans-serif;}
#winHeader {color: #009fe3; font-family: Calibri, sans-serif;border-bottom: 1px solid #009fe3;}
#calcbut {box-shadow: 0px 0px 15px #888888;}
#winiframe {color: #009fe3; border-style: hidden;}
</style>

</head>
<body>

<?php

?>
<table id='quantumTable'><tr><td>
    <div id='winMinStyle'>
			<table width=402 id='winHeader'><tr></tr><td height=28> KNAUF M&aelig;ngdeberegninsprogram  </td><td align='right'>
    <img src='images/maximer.png' onClick="changeWindow();" id=calcbut></td></tr></table>
    <IFRAME src="loginform.php" id='winiframe' width= 100% height=100%></IFRAME>
    </div></td><td>
    </td></tr>
</table>
<IFRAME src="http://www.knauf.dk/prof/vaerktojer-service/vaerktojer/beregningsprogrammer/index.php" frameborder=0 width= 100% height=100%></IFRAME>
</body>
</html>
