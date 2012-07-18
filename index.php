<!DOCTYPE HTML>
<html>
	<head>
		<meta lang="en" charset="utf8" />
		<meta name="author" content="Konstantinos Tsatsarounos" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="docs.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<title>e-Sim Players</title>
	</head>
	<style type="text/css">
		html { width:100%;}
		body { width:95%;}
		.tbl-centered td, .tbl-centered th { text-align: center;}
		.form { width: 80%; }
		input, label { display: inline-block; padding: 5px; }


	</style>
	<body>
		
		<div class="form">
			<label>BattleId <input id="BattleId" type="number" value="0" placeholder="Κωδικός μάχης" /></label>
			<label>RoundId <input id="RoundId" type="number" value="0" placeholder="Αριθμός γύρου" /></label>
			<input type="button" id="trigg" value="Display" />
		</div>


		<div style="display: none; position: absolute; z-index: 999; margin-top: 50%; margin-left: 50%; padding: 10px;" id="dvloader">
			<img src="images/ajax-loader.gif" />
		</div>

		<script type="text/javascript">
						
			var fileT = false;

			//Αυτός είναι ο ορισμός της συναρτησης
			//Δεχεται το αντικείμενο, και ένα κείμενο εάν δεν υπάρχει το αντικείμενο που ελεγχεται!
			/*function isDef(elem,string){

					//εδω τσεκάρει αν το αντικείμενο υπάρχει, αν ναι επιστρεφει το αντικείμενο
					if(elem){ return elem ;}
					//Εάν δεν υπαρχει επιστρέψει σε αυτη τη θέση το κείμενο που συμπλήρωσες ως δευτερη παραμετρο
					else { return string;}

			}
			*/
			function setCookie(){

				document.cookie = 'BattleId='+document.getElementById('BattleId').value;
				document.cookie = 'RoundId='+document.getElementById('RoundId').value;
			}


			function isMUBonus(elem)
			{ 
				if(elem)
					{
						switch(elem)
						{	case 1.2  : return "Elite"; break;
							case 1.15 : return "Veteran"; break;
							case 1.1  : return "Regular"; break;
							case 1.05 : return "Novice"; break;
							default : "None"
						}
					}
				
					else
					{
						return "None";
					}
			}
			
			function isSide(elem)
			{
				if(elem){ return "Defender";} 
				else { return "Attacker";} 
			}

			function isBerserk(elem){
				if(elem){ return "Yes (x5)";}
				else { return "No (x1)";} }
			
			function isRB(elem)
			{ 	if(elem){ return "Yes";}
				else { return "No";} }
			
			
			
			function isDS(elem)
			{
				if(elem)
					{
						switch(elem)
						{	case 1 : return "Q1"; break;
							case 2 : return "Q2"; break;
							case 3 : return "Q3"; break;
							case 4 : return "Q4"; break;
							case 5 : return "Q5"; break;
							default : "None"
						}
					}
				
					else
					{
						return "None";
					}
			}
			
			

			 	var table = document.createElement('table'),
			 	countries = [	 "Poland",
			 					 "Russia",
			 					 "Germany",
			 					 "France",
			 					 "Spain",
			 					 "United Kingdom",
			 					 "Italy",
			 					 "Hungary",
			 					 "Romania",
			 					 "Bulgaria",
			 					 "Serbia",
			 					 "Croatia",
			 					 "Bosnia and Herzegovina",
			 					 "Greece",
			 					 "Republic of Macedonia",
			 					 "Ukraine",
			 					 "Sweden",
			 					 "Portugal",
			 					 "Lithuania",
			 					 "Latvia",
			 					 "Slovenia",
			 					 "Turkey",
			 					 "Brazil",
			 					 "Argentina",
			 					 "Mexico",
			 					 "USA",
			 					 "Canada",
			 					 "China",
			 					 "Indonesia",
			 					 "Iran",
			 					 "South Korea",
			 					 "Taiwan",
			 					 "Israel",
			 					 "India",
			 					 "Australia",
			 					 "Netherlands",
			 					 "Finland",
			 					 "Ireland",
			 					 "Switzerland",
			 					 "Belgium",
			 					 "Pakistan",
			 					 "Malaysia",
			 					 "Norway",
			 					 "Peru",
			 					 "Chile",
			 					 "Colombia"
			 				],
			 				weapons = [	 "None",
			 				 "Q1",
			 				 "Q2",
			 				 "Q3",
			 				 "Q4",
			 				 "Q5"
							];

			 	function Display(){
			 	rows = "<tr><th>Military Unit</th><th>Citizen</th><th>Citizenship</th><th>Building</th><th>Region Bonus</th><th>Berserk</th><th>Defender</th><th>Weapon</th><th>Time</th><th>MU Bonus</th><th>Damage</th></tr>";


			 	table.setAttribute('class', 'table tbl-centered');

			 	for(var i=0; i<fileT.length; i++){

			 		rows += "<tr><td>"+fileT[i].militaryUnit+"</td><td>"+fileT[i].citizenId+"</td><td>"+countries[fileT[i].citizenship-1]+"</td><td>"+isDS(fileT[i].hospitalQuality)+"</td><td>"+isRB(fileT[i].localizationBonus)+"</td><td>"+isBerserk(fileT[i].berserk)+"</td><td>"+isSide(fileT[i].defenderSide)+"</td><td>"+weapons[fileT[i].weapon]+"</td><td>"+fileT[i].time+"</td><td>"+isMUBonus(fileT[i].militaryUnitBonus)+"</td><td>"+fileT[i].damage+"</td></tr>";
			 	}
			 	
			 	table.innerHTML = rows;

			 	document.body.appendChild(table);


			 	$('.playerTable').slideDown(600);
			 }

			 

			document.getElementById("trigg").onclick = function(){
				$("#dvloader").css('display','block');
			 	setCookie();

			 $.ajax({
				type: 'GET',
  				url: "includes/playersJSON.php",
 				success : function(json) {
       				fileT = eval(json);       				
       				Display();
       				$("#dvloader").fadeOut(200);
       				
   				 }
				});
			}
		</script>
	</body>
</html>