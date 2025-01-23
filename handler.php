<?	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/jobs/db.php';
	
	if ($_POST['type'] == 'textarea') {
		list($row, $id) = explode('_', $_POST['id']);
		$affectedRowsNumber = $dbh->exec("UPDATE jobs SET " . $row . " = '" . $_POST['text'] . "' WHERE id = " . $id);
		if ($affectedRowsNumber == 1) echo 'OK';
	}
	
	if ($_POST['type'] == 'del') {
		$affectedRowsNumber = $dbh->exec("DELETE FROM jobs WHERE id = " . $_POST['id']);
		if ($affectedRowsNumber == 1) echo 'OK';
	}
	
	if ($_POST['type'] == 'add') {
		$affectedRowsNumber = $dbh->exec("INSERT INTO jobs (date,operation,shift,line,workcenter,plan,fact,operator) VALUES ('".date('Y-m-d H:i:s')."','".$_POST['operation']."','".$_POST['shift']."','".$_POST['line']."','".$_POST['workcenter']."','".$_POST['plan']."','".$_POST['fact']."','".$_POST['operator']."')");
		if ($affectedRowsNumber == 1) echo 'OK';
	}
	
	if ($_POST['type'] == 'pereodic') {
		$sql = 'SELECT * FROM jobs WHERE date >= CURDATE()';
		if ($_POST['line'] != 'null') $sql = 'SELECT * FROM jobs WHERE line = ' . $_POST['line'] . ' AND date >= CURDATE()';
		
		$result = $dbh->query($sql);
		
		$shift = 2;
		if (date('H') >= 12 && date('H') <= 24) $shift = 1;
		
		while($row = $result->fetch()) {
			if ($row['shift'] != $shift) continue;
			$arRsult[$row['id']]['workcenter'] = $row['workcenter'];
			$arRsult[$row['id']]['operation'] = $row['operation'];
			$arRsult[$row['id']]['operator'] = $row['operator'];
			$arRsult[$row['id']]['precent'] = ($row['plan'] > 0) ? ceil(($row['fact']/$row['plan'])*100) : 'Деление на ноль';
		}
		
		echo json_encode($arRsult);
	}
	
	