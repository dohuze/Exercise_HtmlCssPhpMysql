<?	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/jobs/db.php';
	
	$result = $dbh->query('SELECT * FROM jobs');
	while($row = $result->fetch()){
		//echo "<pre>row: "; print_r($row); echo "</pre>";
		$arRsult[] = $row;
	}
?>

	<table class="iksweb" id="table-1">
		<tbody>
			<tr>
				<th><b>N п/п</b></th>
				<th><b>date</b></th>
				<th><b>operation</b></th>
				<th><b>shift</b></th>
				<th><b>line</b></th>
				<th><b>workcenter</b></th>
				<th><b>plan</b></th>
				<th><b>fact</b></th>
				<th><b>operator</b></th>
				<th><b>удалить</b></th>
			</tr>
			<?foreach ($arRsult as $key => $value):?>
			<?$number = $key + 1;?>
			<?$id = $value['id']?>
				<tr id="tr_<?=$id?>">
					<td style="width: 15px;"><?=$number?></td>
					<td style="width: 50px;"><input type="text" value="<?=$value['date']?>" id="date_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_date_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 50px;"><input type="text" value="<?=$value['operation']?>" id="operation_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_operation_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 15px;"><input type="text" value="<?=$value['shift']?>" id="shift_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_shift_<?=$id?>" style="display: none;">&#128190;<span></td>
					<td style="width: 15px;"><input type="text" value="<?=$value['line']?>" id="line_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_line_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 50px;"><input type="text" value="<?=$value['workcenter']?>" id="workcenter_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_workcenter_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 50px;"><input type="text" value="<?=$value['plan']?>" id="plan_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_plan_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 50px;"><input type="text" value="<?=$value['fact']?>" id="fact_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_fact_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 50px;"><input type="text" value="<?=$value['operator']?>" id="operator_<?=$id?>"></input><span onclick="this.style.display = 'none'" id="save_operator_<?=$id?>" style="display: none;">&#128190;</span></td>
					<td style="width: 50px; width: 115px;"><input id="input_<?=$id?>" type="checkbox"></td>
				</tr>
			<?endforeach?>
		</tbody>
	</table>
	<br>
	
	<table class="iksweb" id="table-2" width="50%">
		<caption>ДОБАВИТЬ СТРОКУ<br></caption>
		<tbody>
			<tr>
				<?/*<th><b>date</b></th>*/?>
				<th><b>operation</b></th>
				<th><b>shift</b></th>
				<th><b>line</b></th>
				<th><b>workcenter</b></th>
				<th><b>plan</b></th>
				<th><b>fact</b></th>
				<th><b>operator</b></th>
			</tr>
				<?/*<td><input id="date" type="text"></td>*/?>
				<td><input id="operation" type="text"></td>
				<td><input id="shift" type="text"></td>
				<td><input id="line" type="text"></td>
				<td><input id="workcenter" type="text"></td>
				<td><input id="plan" type="text"></td>
				<td><input id="fact" type="text"></td>
				<td><input id="operator" type="text"></td>
			<tr>
			
			</tr>
		</tbody>
	</table>
	<br>
	<button id="submit" class="btn">ОТПРАВИТЬ</button>
	
	<script>
		for (let input of document.querySelectorAll("#table-1 input[type='checkbox']")) {
			//console.log(input.id);
			document.getElementById(input.id).checked = false;
		}
	</script>
	
	<script>
		document.getElementById("submit").addEventListener("click", function() {
			//const date = document.getElementById("date").value;
			const operation = document.getElementById("operation").value;
			const shift = document.getElementById("shift").value;
			const line = document.getElementById("line").value;
			const workcenter = document.getElementById("workcenter").value;
			const plan = document.getElementById("plan").value;
			const fact = document.getElementById("fact").value;
			const operator = document.getElementById("operator").value;
			
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "/jobs/handler.php" , true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("operation=" + operation + "&shift=" + shift + "&line=" + line + "&workcenter=" + workcenter + "&plan=" + plan + "&fact=" + fact + "&operator=" + operator + "&type=add");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if(xhr.status == 200) {
						if (xhr.responseText == "OK") {
							location.reload();
						}
					}
				}
			}
			
		}, false);
	</script>
	
	<script>
		for (let input of document.querySelectorAll("#table-1 input[type='text']")) {
			//console.log(input.id);
			document.getElementById(input.id).addEventListener('change', (event) => {
				//console.log(`Value changed: ${event.target.value}`);
				var xhr = new XMLHttpRequest();
				xhr.open("POST", "/jobs/handler.php" , true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("id=" + input.id + "&text=" + event.target.value + "&type=textarea");
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						if(xhr.status == 200) {
							if (xhr.responseText == "OK") {
								document.querySelector("#save_" + input.id).style.display = "block";
							}
						}
					}
				}
			});
		}
	</script>
	
	<script>
		for (let input of document.querySelectorAll("#table-1 input[type='checkbox']")) {
			document.querySelector("#" + input.id).onchange = function() {
				//console.log(this.checked ? "Флажок выбран" : "Флажок не выбран");
				if (this.checked) {
					if (confirm("Удалить запись ?")) {
						var id = this.id;
						id = id.replace("input_", "");
						var xhr = new XMLHttpRequest();
						xhr.open("POST", "/jobs/handler.php" , true);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						xhr.send("id=" + id + "&type=del");
						xhr.onreadystatechange = function() {
							if (xhr.readyState == 4) {
								if(xhr.status == 200) {
									if (xhr.responseText == "OK") {
										document.querySelector("#tr_" + id).remove();
									}
								}
							}
						}
					}
				}
			};
		}
	</script>
	
	<style>
		/* Стили таблицы (IKSWEB) */
		table.iksweb {
			text-decoration: none;
			border-collapse: collapse;
			width: 100%;
			text-align: center;
		}
		table.iksweb th {
			font-weight: normal;
			font-size: 14px;
			color: #ffffff;
			background-color: #0f65a3;
			text-transform: uppercase;
			
		}
		table.iksweb td {
			font-size: 13px;
			color: #354251;
		}
		table.iksweb td, table.iksweb th {
			white-space: pre-wrap;
			padding: 10px 5px;
			vertical-align: middle;
			border: 1px solid #0f65a3;
		}
		table.iksweb tr:hover {
			background-color: #f9fafb;
		}
		table.iksweb tr:hover td {
			color: #354251;
			cursor: default;
		}
		td textarea {
			width: 95%;
			height: 140px;
			margin-bottom: 8px;
		}
		
		
		/* Стили формы */
		.form-style-4{
			width: 90%;
			font-size: 16px;
			background: #495C70;
			padding: 30px 30px 15px 30px;
			border: 5px solid #53687E;
		}
		.form-style-4 input[type=submit],
		.form-style-4 input[type=button],
		.form-style-4 input[type=text],
		.form-style-4 input[type=email],
		.form-style-4 label
		{
			font-family: Georgia, "Times New Roman", Times, serif;
			font-size: 16px;
			color: #fff;
			padding-left: 5px;
		}
		#label-submit {
			cursor: pointer;
		}
		
		.form-style-4 label {
			display:block;
			margin-bottom: 10px;
		}
		.form-style-4 label > span{
			display: inline-block;
			float: left;
			width: 150px;
		}
		.form-style-4 input[type=text],
		.form-style-4 input[type=email] 
		{
			background: transparent;
			border: none;
			border-bottom: 1px dashed #83A4C5;
			width: 100%;
			outline: none;
			padding: 0px 0px 0px 0px;
			font-style: italic;
		}

		.form-style-4 input[type=text]:focus,
		.form-style-4 input[type=email]:focus,
		.form-style-4 input[type=email] :focus
		{
			border-bottom: 1px dashed #D9FFA9;
		}

		.form-style-4 input[type=submit],
		.form-style-4 input[type=button]{
			color: #86ad00;
			pointer-events: none;
		}
		.form-style-4 input[type=submit]:hover,
		.form-style-4 input[type=button]:hover{
			background: #394D61;
		}
		input[type=text]{
			padding: 5px !important;
		}
	</style>
	