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
?>