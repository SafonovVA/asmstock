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
				
				for($i = 1; $i <= count_num_rows(); $i++) {
					$array = resultToArray($i);
					echo "<tr>";
					foreach ($array as $key => $value) {
						echo "<td>".$value."</td>";
					}
					echo "</tr>";
				}
				
?>		
	</table>
</body>
</html>