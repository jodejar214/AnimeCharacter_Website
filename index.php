<!DOCTYPE html>

<html>

<head>
	<title>jao57 Project 2</title>
	<link href='css/style.css' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src='scripts/script.js'></script>
</head>

<body>

	<?php
		$delimiter = '|';

		//checks if all inputs in the form have content
		$notempty = !empty($_POST["charName"]) && !empty($_POST["aniTitle"]) && !empty($_POST["voiceActor"]) && !empty($_POST["gender"]) && !empty($_POST["hairColor"]);

		if(isset($_POST["newChar"]) && $notempty){

			$validVoiceActor = preg_match("/^[\w\-\.\_\s]+$/", $_POST["voiceActor"]);
			$file = fopen("data.txt", "a+");

			if(!$file){
				die("There was a problem opening the data file");
			}

			$name = $_POST["charName"];
			$title = $_POST["aniTitle"];
			$voiceActor = $_POST["voiceActor"];
			$gender = $_POST["gender"];
			$hairColor = $_POST["hairColor"];

			if($validVoiceActor){

				//check if character is in the catalog already
				$alreadyIn = false;
				$data = file("data.txt");
				foreach($data as $char){
					$info = explode($delimiter, trim($char));
					$sameName = strcasecmp($info[0], $name);
					$sameTitle = strcasecmp($info[1], $title);
					$sameVA = strcasecmp($info[2], $voiceActor);
					$sameGender = strcasecmp($info[3], $gender);
					$sameHairColor = strcasecmp($info[4], $hairColor);

					if($sameName === 0 && $sameTitle === 0 && $sameVA === 0 && $sameGender === 0 && $sameHairColor === 0){
						$alreadyIn = true;
						break;
					}
				}

				//add to catalog if not in it already
				if($alreadyIn === false){
					fputs($file, "$name$delimiter$title$delimiter$voiceActor$delimiter$gender$delimiter$hairColor\n");
				}

				natcasesort($data);

			}

			fclose($file);
		}
	?>

	<div id = "header">
		<h1>Anime Characters Catalog</h1>
	</div>

	<br>

	<?php

		//create options list input
		function createOptionList($arr){
			foreach($arr as $choice){
				echo "<option value = \"$choice\">$choice</option>";
			}
		}

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

		//choices of criteria for search
		$searchChoices = array(
			"Character Name",
			"Anime Title",
			"Voice Actor",
			"Gender",
			"Hair Color"
		);
	?>

	<!--the form to add an entry to the text file and table-->
	<div id = "finputs">
		<h2>Add an Anime Character</h2>
		<form action = "index.php" method = "POST">
			<p>
				What is the character's name?
				<br>
				<input type = "text" name = "charName" required>
				<br>
				What anime is the character from?
				<br>
				<input type = "text" name = "aniTitle" required>
				<br>
				Who voices the character?
				<br>
				<input type = "text" maxlength = "50" name = "voiceActor" required>
				<br>
				What is the character's gender?
				<br>
				<select name = "gender" required>
					<option value = "" disabled selected>--Choose a Gender--</option>
					<?php
						createOptionList($genderChoices);
					?>
				</select>
				<br>
				What is the character's hair color?
				<br>
				<select name = "hairColor" required>
					<option value = "" disabled selected>--Choose a Hair Color--</option>
					<?php
						createOptionList($colorChoices);
					?>
				</select>
				<br>
				<input class = "sub" type = "submit" name = "newChar" value = "Add Character" />
			</p>
		</form>
	</div>

	<!--the form that searches the text file-->
	<div id = "searchForm">
		<h2>Search the Catalog</h2>
		<form action = "searchResults.php" method = "POST">

			<!--5 different filter inputs that are collapsable-->
			<div class="accordion">
			    <div class="accordion-section">
			        <a class="section-title" href="#accordion-1">Filter 1</a>
			         
			        <div id="accordion-1" class="section-content">
			            Search By:
						<br>
						<select name = "criteria1" required>
							<option value = "" disabled selected>--Choose Criteria for Search--</option>
							<?php
								createOptionList($searchChoices);
							?>
						</select>
						<br>
						Enter the search here:
						<br>
						<input type = "text" name = "search1" required>
			        </div>
			    </div>

				<div class="accordion-section">
			        <a class="section-title" href="#accordion-2">Filter 2</a>
			         
			        <div id="accordion-2" class="section-content">
			            Search By:
						<br>
						<select name = "criteria2">
							<option value = "" disabled selected>--Choose Criteria for Search--</option>
							<?php
								createOptionList($searchChoices);
							?>
						</select>
						<br>
						Enter the search here:
						<br>
						<input type = "text" name = "search2">
			        </div>
			    </div>

				<div class="accordion-section">
			        <a class="section-title" href="#accordion-3">Filter 3</a>
			         
			        <div id="accordion-3" class="section-content">
			            Search By:
						<br>
						<select name = "criteria3">
							<option disabled selected>--Choose Criteria for Search--</option>
							<?php
								createOptionList($searchChoices);
							?>
						</select>
						<br>
						Enter the search here:
						<br>
						<input type = "text" name = "search3">
			        </div>
			    </div>

				<div class="accordion-section">
			        <a class="section-title" href="#accordion-4">Filter 4</a>
			         
			        <div id="accordion-4" class="section-content">
			            Search By:
						<br>
						<select name = "criteria4">
							<option disabled selected>--Choose Criteria for Search--</option>
							<?php
								createOptionList($searchChoices);
							?>
						</select>
						<br>
						Enter the search here:
						<br>
						<input type = "text" name = "search4">
			        </div>
			    </div>

				<div class="accordion-section">
			        <a class="section-title" href="#accordion-5">Filter 5</a>
			         
			        <div id="accordion-5" class="section-content">
			            Search By:
						<br>
						<select name = "criteria5">
							<option disabled selected>--Choose Criteria for Search--</option>
							<?php
								createOptionList($searchChoices);
							?>
						</select>
						<br>
						Enter the search here:
						<br>
						<input type = "text" name = "search5">
			        </div>
			    </div>
			</div>
				
			<input class = "sub" type = "submit" name = "doSearch" value = "Search" />
		</form>
	</div>

	<!--the table created from the data in the text file-->
	<table id = "animeChar">
		<tr>
			<th>Character Name</th>
			<th>Anime Title</th>
			<th>Voice Actor</th>
			<th>Gender</th>
			<th>Hair Color</th>
		</tr>

		<?php
			$characters = file("data.txt");
			natcasesort($characters);
			//gets character data from file and puts it into table
			foreach($characters as $char){
				$info = explode($delimiter, trim($char));

				echo "<tr>";
				echo "<td>$info[0]</td>";
				echo "<td>$info[1]</td>";
				echo "<td>$info[2]</td>";
				echo "<td>$info[3]</td>";
				echo "<td>$info[4]</td>";
				echo "</tr>";
			}
		?>
	</table>

	<br>

	<div id = "footer">
		<p> Background Created By LadyGt: <a href = "http://ladygt.deviantart.com/art/Shonen-Jump-Hanami-370777606">Source</a></p>
	</div>

</body>

</html>