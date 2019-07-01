<?php
	$mysqli = false;
	function connectDB () {
		global $mysqli;
		$mysqli = new mysqli("localhost", "root", "", "computers");
		$mysqli->query("SET NAMES 'utf8'");
	}
	
	function closeDB () {
		global $mysqli;
		$mysqli->close ();
	}
#Возврат типа данных
  	function dumper($obj)
  	{
    	echo 
    	  "<pre>",
    	    htmlspecialchars(dumperGet($obj)),
    	  "</pre>"; 
  	}
  	function dumperGet(&$obj, $leftSp = "")
  	{ 
    	if (is_array($obj)) {
    		$type = "Array[".count($obj)."]"; 
    	} elseif (is_object($obj)) {
    		$type = "Object";
    	} elseif (gettype($obj) == "boolean") {
    		return $obj? "true" : "false";
    	} else {
    		return "\"$obj\"";
    	}
    	$buf = $type; 
    	$leftSp .= "    ";
    	for (Reset($obj); list($k, $v) = each($obj); ) {
    		if ($k === "GLOBALS") continue;
    		$buf .= "\n$leftSp$k => ".dumperGet($v, $leftSp);
    	}
    	return $buf;
	}
################################################################################
#ВОзврат логина или пароля
	function authentication($index) {
		global $mysqli;
		connectDB();
		$result_set = $mysqli->query("SELECT * FROM `person` WHERE `login`='".$_REQUEST['login']."'");
		closeDB();
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false) {
			$array[] = $row;
		}
		return $array[0][$index];
	}
#Возвращает двумерный массив ключ => значение
function resultToArray() {
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `pc` ORDER BY `id` ASC");
	closeDB();
	$array = array ();
	while (($row = $result->fetch_assoc()) != false) {
		//if(isset($array[1])) break;
		$array[] = $row;
	}
	//return array_values($array);
	return $array;
	}

	function resultToArray_row ($i) {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `pc` WHERE `id`='".$i."' ORDER BY `id` ASC");
		closeDB();
		$array = array ();
		while (($row = $result->fetch_assoc()) != false) {
			if(isset($array[1])) break;
			$array[] = $row;
		}
		//return array_values($array);
		return $array[0];
		}

	function count_num_rows() {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT `id` FROM `pc`");
		closeDB();
		$array = array();
		while (($row = $result->fetch_assoc()) != false) {
			//if(isset($array[1])) break;
			$array[] = $row;
		}
		return count($array);
	}

	function Get_id($number) 
	{
		global $mysqli;
		connectDB();
		$result_set = $mysqli->query("SELECT * FROM `pc` WHERE `id`= '$number'");					
		while (($row = $result_set->fetch_assoc()) != false){
			$id = $row["id"];
		};
		closeDB();
		return $id;
	}

	function add_rows() 
	{
		global $mysqli;
		connectDB();
		for ($i = 1; $i <= 1000; $i++) {
			$mysqli->query("INSERT INTO `pc` (`id`, `name`, `pc_serial`, `inv_number`, `hardware_serial`, `hardware`, `surname`, `cabinet`) VALUES (NULL, '$i', '$i', '$i', '$i', '$i');");
		}
		closeDB();
	}

	function add_new_rows($row) 
	{
		global $mysqli;
		connectDB();
		$mysqli->query("INSERT INTO `pc` (`$id`) VALUES (NULL);");
		foreach($row as $key => $val) {
			if ($key == 'id') continue;
			if ($key == 'add_values') break;
			
			$mysqli->query("INSERT INTO `pc` (`$key`) VALUES ('$val');");
		}
			#$mysqli->query("INSERT INTO `pc` (`id`, `name`, `pc_serial`, `inv_number`, `hardware_serial`, `hardware`, `surname`, `cabinet`) VALUES (NULL, '$i', '$i', '$i', '$i', '$i');");
		closeDB();
		#INSERT INTO `pc` (`id`, `cabinet`) VALUES (NULL, '456465');
	}

	function changes($id, $row) {
		global $mysqli;
		connectDB();
		foreach($row as $key => $val) {
			if ($key == 'confirm') break;
			$mysqli->query("UPDATE `pc` SET `$key` = '$_REQUEST[$key]' WHERE `pc`.`id` = '$id'");
		}
		closeDB();
	}


	//UPDATE `pc` SET `name` = '1', `inv_number` = '1', `hardware` = '1', `surname` = '1', `cabinet` = '1' WHERE `pc`.`id` = 33
?>