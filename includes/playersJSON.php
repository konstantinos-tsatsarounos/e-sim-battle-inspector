<?php

$BattleId = $_COOKIE["BattleId"];
$RoundId = $_COOKIE["RoundId"];

if(isset($BattleId) && isset($RoundId) ){

				$file = file_get_contents("http://e-sim.org/apiFights.html?battleId={$BattleId}&roundId={$RoundId}");

				echo $file;
			}
		else {
			echo "";

		}
?>;