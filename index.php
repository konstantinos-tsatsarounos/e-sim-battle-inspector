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
		.form { width: 100%; }
		input, label { display: inline-block; padding: 5px; }
		#ModalWindow {
			background-color: #fff;
			width: 500px;
			height: 200px;
			border: 1px solid #999;
			border-radius: 10px;
			position: absolute;
			top: 30%;
			left: 30%;
			color: #444;
			font-size: 40px;
			text-align: center;
			padding: 10px;
			display: none;

		}
		#ModalWindow div { margin: 0 auto; padding: 50px; width: 80%; height: 80%; line-height: 45px;}

	</style>
	<body>
		
		<div id="ModalWindow">
			<div></div>
		</div>


		<div class="form" >
			<label>Εισάγετε τον αριθμό της μάχης<input id="BattleId" type="number"  placeholder="Κωδικός μάχης" /></label>
			<label>Εισάγετε τον αριθμό του γύρου<input id="RoundId" type="number"  placeholder="Αριθμός γύρου" /></label>
			<select id="MU" name="MU">
								<option value="">Επιλέξτε MU
								<option value="">----------------------------------------
								<option value="43">Mugiwara Pirates
								<option value="311">Mugiwara Pirates Academy
								<option value="36">National Guard
								<option value="93">Omerta
								<option value="247">Omerta 2
								<option value="392">Omerta Academy
								<option value="63">Blues Brothers
								<option value="133">Death Squad
								<option value="335">Jedi Elite
								<option value="372">Greek Presidential Guard
								<option value="405">The Expendables
								<option value="482">The Expendables II
								<option value="541">Phalanx
								<option value="565">Titanes
								<option value="154">The SMURFS
								<option value="13">The baby SMURFS
								<option value="194">Libertad
								<option value="269">Armed Troops
								<option value="176">Greek Army
								<option value="253">redbull team
								<option value="424">AKRITES
								<option value="642">MARVEL
							</select>
			<input type="number" id="SumDamage" value="0" readonly="readonly" placeholder="Συνολο ζημιάς μονάδας" />
			<input type="button" value="Clear Damage" id="ClearDamage" />
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

			$("<span>x</span>", { class: "close"})
										.css({
										position: "absolute",
										top: 10,
										right:10,
										fontWeight: "bold",
										fontSize: 25,
										"z-index" : 10000,
										cursor: "pointer"

									})
									.appendTo("#ModalWindow")
									.on("click", function(){ 
										$(this).parent("div").fadeOut(300);


									});
					$("#MU").live("change", function () {    
    								var MU = this.options[this.selectedIndex].value,
    								totalDamage=0;

    								for(var i=0; i<fileT.length; i++)
    								{
    									if(fileT[i].militaryUnit==MU)
    									{
    										totalDamage += fileT[i].damage;
    									}
    								}

    								$("#ModalWindow")
    										.fadeIn(200)
    										.children("div")
    										.html("Συνολική ζημιά: "+totalDamage);
    								var val = document.getElementById("SumDamage").value;
    								val = parseInt(val);

    								document.getElementById("SumDamage").value = val + parseInt(totalDamage);

   								 });
					$("#ClearDamage").on("click", function(){ document.getElementById("SumDamage").value = 0 ;})

		</script>
	</body>
</html>