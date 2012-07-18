
<!DOCTYPE HTML>
<html>
	<head>
		<meta lang="en" charset="utf8" />
		<meta name="author" content="Konstantinos Tsatsarounos" />
		<title>Page Title</title>
	</head>
	<body>
		<div id='output' ></div>

		<script type="text/javascript">
			var militaryUID = <?php
	echo "[";
	for($i=1; $i<51; $i++){
		if(i==50)
		{echo file_get_contents("http://e-sim.org/apiMilitaryUnitById.html?id={$i}");}
		else 
		{echo file_get_contents("http://e-sim.org/apiMilitaryUnitById.html?id={$i}").',';}
	}
	echo "]";
?>;
	

		</script>
	</body>
</html>

