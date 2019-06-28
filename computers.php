<!DOCTYPE html>
<html lang="ru">
<head>
  <title>ASM stock</title>
  <meta charset='utf-8'>
</head>
<body>
    <table border="1" width="100%">
		<tr>
			<th>№</th>
			<th>Наименование</th>
			<th>Инвентарный номер</th>
			<th>Номер винчестера</th>
		</tr>
<?php			
				require_once "mysql/connect.php";
				$array = resultToArray();
				for($i = 0; $i != 3; $i++) {
					echo "<tr>";
					for ($j = 0; $j != 4; $j++) {
						echo "<td>".$array[$i][$j]."</td>";
					}
					echo "</tr>";
					dumper($array);
				}
				
				// require_once "mysql/connect.php";
				// global $mysqli;
				// $db_count = 1;
				// $index = 0;
				// connectDB();
				// $result = $mysqli->query("SELECT * FROM `pc` ORDER BY `id` ASC");
				// closeDB();
				// $array = array ();
				// while (($row = $result->fetch_assoc()) != false) {
				// 	echo "<td>".$row."</td>";
				// 	if (++$db_count % 4) echo "</tr>";
				// }
				//dumper($array);
				
?>		
	</table>
</body>
</html>