<?php
	//functions.php
	// siia tulevad funktsioonid, k�ik mis seotud andmebaasiga
	
	//loon andmebaasi �henduse
	require_once("../../configglobal.php");
	$database = "if15_siim_3";
	
	//tekitatakse sessioon, mida hoitakse serveris,
	//k�ik session muutujad on k�ttesaadavad kuni viimase brauseriakna sulgemiseni
	session_start();
	
	//v�tab andmed ja sisestab andmebaasi
	
	function createUser($create_email,$hash,$fname,$lname,$age,$city){
		// salvestame andmebaasi
		$mysqli = new mysqli($GLOBALS["server_name"],$GLOBALS["server_username"],$GLOBALS["server_password"],$GLOBALS["database"]);
				$stmt = $mysqli->prepare("INSERT INTO users(email,password,first_name,last_name,age,city) VALUES (?,?,?,?,?,?)");
				echo $mysqli->error;
 				echo $stmt->error;
				//asendame ? m�rgid, ss - s on string email, s on string password,i on integer
				$stmt->bind_param("ssssis",$create_email,$hash,$fname,$lname,$age,$city);
				$stmt->execute();
				$stmt->close();
				
				//paneme �henduse kinni
	$mysqli->close();
	}
	function loginUser($email,$hash){
		$mysqli = new mysqli($GLOBALS["server_name"],$GLOBALS["server_username"],$GLOBALS["server_password"],$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id,email FROM users WHERE email=? AND password=? ");
		$stmt->bind_param("ss",$email,$hash);
				
				//muutujuad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
				
				//kontrollin kas tulemusi leiti
		if($stmt->fetch()){
					//ab's oli midagi
			echo " Email ja parool �iged, kasutaja id=".$id_from_db;
			
			//tekitan sessiooni muutujad
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user_email"] = $email_from_db;
			
			//suunan data.php lehele
			header("Location:data.php");
			
		}else{
					//ei leidnud
			echo "Wrong credentials";
				}
		$stmt->close();
		$mysqli->close();
	}	
		
	function addCarPlate ($car_plate,$car_color){
		$mysqli = new mysqli($GLOBALS["server_name"],$GLOBALS["server_username"],$GLOBALS["server_password"],$GLOBALS["database"]);
			$stmt = $mysqli->prepare("INSERT INTO car_plates(user_id,number_plate,color) VALUES (?,?,?)");
			//asendame ? m�rgid, ss - s on string email, s on string password,i on integer
			$stmt->bind_param("iss",$_SESSION["logged_in_user_id"],$car_plate,$car_color);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();	
	}
	
	
?>