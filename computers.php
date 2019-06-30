<!DOCTYPE html>
<html lang="ru">
<head>
  <title>ASM stock</title>
  <meta charset='utf-8'>
  	<script>
		function deleteName(f) {
    		if (confirm("Уверен что хочешь удалить запись?\nПотом пожалеешь...")) f.submit();
   		}
	</script>
</head>
<body>
    <table border="1" width="100%">
		<tr>
			<th>№</th>
			<th>Наименование</th>
			<th>Инвентарный номер</th>
			<th>Номер винчестера</th>
			<th>Фамилия</th>
			<th>Кабинет</th>
			<th>Действие</th>
		</tr>
<?php			
	require_once "mysql/connect.php";

	if (isset($_REQUEST['delete'])) { #Удаление строки
		$hidden = $_REQUEST['hidden'];
		if (isset($_REQUEST['delete'][$hidden])) {
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
			foreach ($array as $key => $val) {
				if ($key == 'id') {
					echo "<td><form><input type='text' name='$key' value='$val'><form></td>";
					continue;
				}
				echo "<td><form><input type='text' name='$key' value='$val'><form></td>";
			}
			echo "<td><form><input type='submit' name='confirm' value='Подтвердить'><form></td>"; 
			echo "<tr>";
		}
	}
	if (isset($_REQUEST['confirm'])) { #Применение изменений строки
		$changed_id = Get_id($_REQUEST['id']);
		$changed_row = resultToArray_row($changed_id);
		changes($changed_id, $changed_row);
	}

	if (!$change) { #Вывод таблицы на экран
		$arrays = resultToArray();
		$row_number = 0;
		foreach ($arrays as $array) {
			$id_number = $arrays[$row_number]['id'];
			echo "<tr>";
			foreach ($array as $key => $val) {
				if ($key == 'id') {
					echo "<td>".++$row_number."</td>";
					continue;
				}
				echo "<td>".$val."</td>";
			}
			echo "<td><form>";
				echo "<input type='hidden' name='hidden' value='$id_number'>";
				echo "<input type='submit' name='change[$id_number]' id='change[$id_number]' value='Изменить'>";
				echo "<input type='hidden' name='hidden' value='$id_number'>";		
				echo "<input type='submit' name='delete[$id_number]' id='delete[$id_number]' value='Удалить'>";
				echo "</td></form>";
			echo "</tr>";
		}
	}		
?>		