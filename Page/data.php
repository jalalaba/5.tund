<?php
require_once("functions.php");
$number_plate = $color = "";
$number_plate_error = $color_error = "";
if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
	}
	//kasutaja tahab välja logida
	if(isset($_GET["logout"])){
		//aadressireal on olemas muutuja logout
		
		//kustutame kõik sessiooni muutujad ja peatame sessiooni
		session_destroy();
		
		header("Location: login.php");
	}
	
	
if(isset($_POST["add_plate"])){
		echo $_SESSION[$logged_in_user_id];	
		if (empty($_POST["number_plate"])){
			$number_plate_error = "see väli on kohustulik";	
		} else {
				$number_plate=test_input($_POST["number_plate"]);
		}
		if (empty($_POST["color"])){
			$color_error = "see väli on kohustulik";
		} else {
			$color=test_input($_POST["color"]);
		}
		if ($number_plate_error = "" && $color_error = ""){
			
		addCarPlate($number_plate,$color);
	}
		
}
	
function test_input($data) {
	//võtab ära tühikud,enterid jne
	$data = trim($data);
	//võtab ära tagurpidi kaldkriipsud
	$data = stripslashes($data);
	//teeb html-i tekstiks
	$data = htmlspecialchars($data);
	return $data;
	}
	
?>
<p>
	Tere,<?php echo $_SESSION["logged_in_user_email"];?>
	<a href="?logout=1"> Logi välja <a>
</p>
<h2>Lisa autonumbrimärk</h2>
<form action="login.php" method="post">
			<label for="number_plate">Auto numbrimärk</label><br>
			<input id="number_plate" name="number_plate" type="text"  value="<?php echo $number_plate; ?>"> <?php echo $number_plate_error; ?><br><br>
			<label for="color">Värv</label><br>
			<input id="color" name="color" type="text" value="<?php echo $color;?>"> <?php echo $color_error; ?> <br><br>
			<input name="add_plate" type="submit" value="Salvesta"> 
		</form>