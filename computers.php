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
			<th>Действие</th>
		</tr>
<?php			
				require_once "mysql/connect.php";

				if (isset($_REQUEST['delete'])) { #Удаление строки
					$hidden = $_REQUEST['hidden'];
					if (isset($_REQUEST['delete'][$hidden])) {
						$hidden = Get_id($hidden);
						connectDB();
						$mysqli->query("DELETE FROM `pc` WHERE `id` = $hidden");
						closeDB();
					}
				}

				if (isset($_REQUEST['change'])) { #Измение строки
					$change = true;
					$hidden = $_REQUEST['hidden'];
					if (isset($_REQUEST['change'][$hidden])) {
						$array = resultToArray_row($hidden);

						echo "<tr>";
						foreach ($array as $val) {
							echo "<td>".$val."</td>";
						}
						echo "<td><form>";
							echo "<input type='hidden' name='hidden' value='$id_number'>";
							echo "<input type='submit' name='change[$id_number]' id='change[$id_number]' value='Изменить'>";
							echo "<input type='submit' name='delete[$id_number]' id='delete[$id_number]' value='Удалить'>";
							echo $row_number++;
						echo "</td></form>";
						echo "</tr>";

					}
				}

				echo $hidden;
				$arrays = resultToArray();
				$row_number = 0;
				if ($change) {
					foreach ($arrays as $array) {
						$id_number = $arrays[$row_number]['id'];
						echo "<tr>";
						foreach ($array as $val) {
							echo "<td>".$val."</td>";
						}
						echo "<td><form>";
							echo "<input type='hidden' name='hidden' value='$id_number'>";
							echo "<input type='submit' name='change[$id_number]' id='change[$id_number]' value='Изменить'>";
							echo "<input type='submit' name='delete[$id_number]' id='delete[$id_number]' value='Удалить'>";
							echo $row_number++;
						echo "</td></form>";
						echo "</tr>";
					}
				}
				

				// echo count_num_rows();
				// dumper($array);
				
?>		
	</table>
</body>
</html>