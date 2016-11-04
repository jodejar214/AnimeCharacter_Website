<!DOCTYPE html>

<html>

<head>
	<title>jao57 Project 2</title>
	<link href='css/style.css' rel='stylesheet' type='text/css'>
</head>

<body>

	<?php

		//choices of genders for character
		$genderChoices = array(
			"Male",
			"Female",
			"Neutral",
			"Unknown"
		);

		//choices of hair colors for character
		$colorChoices = array(
			"Black",
			"Brown",
			"Blonde",
			"Red",
			"Blue",
			"Green",
			"Orange",
			"Pink",
			"Purple",
			"White",
			"Silver",
			"Gray",
			"Bald",
			"Other"
		);
	?>

	<div id = "header">
		<h1>Search Results</h1>
		<a class = "home" href = 'index.php'>Back to Main Catalog</a>
	</div>

	<br>

	<table id = "animeChar">
		<tr>
			<th>Character Name</th>
			<th>Anime Title</th>
			<th>Voice Actor</th>
			<th>Gender</th>
			<th>Hair Color</th>
		</tr>

		<?php
			function getEntry($bio){
				echo "<tr>";
				echo "<td>$bio[0]</td>";
				echo "<td>$bio[1]</td>";
				echo "<td>$bio[2]</td>";
				echo "<td>$bio[3]</td>";
				echo "<td>$bio[4]</td>";
				echo "</tr>";
			}

			function doFilter(&$list, $key, $info, $in, $filter, $genderArr, $colorArr){
				$bio = explode('|', trim($info));
				//put long conditionals in variables
				$sameName = strcasecmp($bio[0], $in);
				$sameTitle = strcasecmp($bio[1], $in);
				$sameVA = strcasecmp($bio[2], $in);
				$sameGender = strcasecmp($bio[3], $in);
				$sameHairColor = strcasecmp($bio[4], $in);
				$charFilter = ($filter === "Character Name" && $sameName !== 0);
				$titleFilter = ($filter === "Anime Title" && $sameTitle !== 0);
				$voiceFilter = ($filter === "Voice Actor" && $sameVA !== 0);
				$genderFilter1 = ($filter === "Gender" && !in_array($in, $genderArr) && $sameGender !== 0);
				$genderFilter2 = ($filter === "Gender" && in_array($in, $genderArr) && $sameGender !== 0);
				$colorFilter1 = ($filter === "Hair Color" && !in_array($in, $colorArr) && $sameHairColor !== 0);
				$colorFilter2 = ($filter === "Hair Color" && in_array($in, $colorArr) && $sameHairColor !== 0);
				if($charFilter || $titleFilter || $voiceFilter || $genderFilter1 || $colorFilter1 || $genderFilter2 || $colorFilter2){
					unset($list[$key]);
				}
			}

			if(isset($_POST["doSearch"]) && !empty($_POST["criteria1"]) && !empty($_POST["search1"])){
				$cr1 = $_POST["criteria1"];
				$input1 = $_POST["search1"];
				$data = file("data.txt");
				$len = count($data);
				foreach($data as $index => $char){
					doFilter($data, $index, $char, $input1, $cr1, $genderChoices, $colorChoices);
				}
				if(!empty($_POST["criteria2"]) && !empty($_POST["search2"])){
					$cr2 = $_POST["criteria2"];
					$input2 = $_POST["search2"];
					foreach($data as $index => $char){
						doFilter($data, $index, $char, $input2, $cr2, $genderChoices, $colorChoices);
					}
				}
				if(!empty($_POST["criteria3"]) && !empty($_POST["search3"])){
					$cr3 = $_POST["criteria3"];
					$input3 = $_POST["search3"];
					foreach($data as $index => $char){
						doFilter($data, $index, $char, $input3, $cr3, $genderChoices, $colorChoices);
					}
				}
				if(!empty($_POST["criteria4"]) && !empty($_POST["search4"])){
					$cr4 = $_POST["criteria4"];
					$input4 = $_POST["search4"];
					foreach($data as $index => $char){
						doFilter($data, $index, $char, $input4, $cr4, $genderChoices, $colorChoices);
					}
				}
				if(!empty($_POST["criteria5"]) && !empty($_POST["search5"])){
					$cr5 = $_POST["criteria5"];
					$input5 = $_POST["search5"];
					foreach($data as $index => $char){
						doFilter($data, $index, $char, $input5, $cr5, $genderChoices, $colorChoices);
					}
				}
				if(count($data) !== $len){
					natcasesort($data);
					foreach($data as $char){
						$bio = explode('|', trim($char));
						getEntry($bio);
					}
				}
			}
		?>

	</table>

	<br>

	<div id = "searchMsg">

		<?php
			$entrycounter = count($data);
			if($entrycounter === 1){
				echo "<br><p>$entrycounter Entry Found By Search</p>";
			}
			else if($entrycounter === $len){
				echo "<br><p>0 Entries Found By Search</p>";
			}
			else{
				echo "<br><p>$entrycounter Entries Found by Search</p>";
			}
			echo "<a class = 'home2' href = 'index.php'>Back to Main Catalog</a>";
		?>

	</div>

	<div id = "footer">
		<p> Background Created By LadyGt: <a href = "http://ladygt.deviantart.com/art/Shonen-Jump-Hanami-370777606">Source</a></p>
	</div>

</body>

</html>