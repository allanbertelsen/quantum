<html>
<head>
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="quantum_functions.js"></script>
</head>
<body>
	<div class="menu xw3-row">
		<a href href="#" class="menubutton w3-button">Menu&nbsp;pkt&nbsp;1</a>
		<a href href="#" class="menubutton w3-button">Menu&nbsp;pkt&nbsp;2</a>
		<a href href="#" class="menubutton w3-button">Beregn</a>
	</div>
	<div class="xw3-row">
	<div class="contentx xw3-col">
<?php
//phpinfo();
DoThings();

Function DoThings(){
	error_reporting(-1);
	ini_set('display_errors', 'On');
	$host="localhost";
	$host="127.0.0.1";
	$port=3306;
	$socket="";
	$user="root";
	$password="123";
	$dbname="Quantum";

	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
		or die ('Could not connect to the database server' . mysqli_connect_error());

	mysqli_set_charset($con,'utf8');

	$sql = 'SELECT ParameterVaerdiID as ID, ParameterNavn as Parameter, Vaerdi FROM qryParametersForForm where system=300';

	ShowTable($sql, $con, 1);

	$sql = 'SELECT `Materiale nr` as ID, `Materiale nr`, MaterialeKortTekst, Pris FROM Quantum.tblMaterialeListe limit 10';

	ShowTable($sql, $con, 2);

	$sql = 'SELECT * FROM Quantum.tblKonsulent limit 5';

	//ShowTable($sql, $con, 3);

	$con->close();
}

Function ShowTable($sql, $con, $tid){
	//$query = mysqli_query($con, $sql);
	$query = $con->query($sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($con));
	}

	$fields_num = $query->field_count;
	echo "<div class='ttt'><table class='t1' id='navigate'><thead><tr>";
	// printing table headers

	$i = 0;

	while ($finfo = $query->fetch_field()) {
		if ($i!=0) echo "<th>{$finfo->name} ({$finfo->type})</th>";
		$f[$i]=$finfo->type;
		$i++;
	}
	$id=0;
	$t="";
	echo "</tr></thead>\n";
	// printing table rows
	while($row = $query->fetch_row())
	{
		echo "<tr>";
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		$i=0;
		foreach($row as $cell) {
			$t=DKLetters($cell);
			if ($i==0) {
				$id = $cell;
			} else {
				if (($f[$i]==3) or ($f[$i]==5)) {
					$t = str_replace(".",",",$t);
					echo "<td align='right' tid='$id'><span contenteditable='true'>$t</span></td>";
				} else {
					echo "<td align='left' tid='$id'><span contenteditable='true'>$t</span></td>";
				}
			}
			$i++;
		}
		echo "</tr>\n";
	}
	echo "</table></div>\n";
	//mysql_freeresult($query);
}

Function DKLetters($text){
	$iletters = array("æ","","");
	$lletters = array("&aelig;","","");
	return str_replace($iletters,$lletters,$text);
}
?>
</div>
</body>
</html>
