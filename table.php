<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Parser</title>
	<?php require_once 'parseExcel.php' ?>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="icons/css/font-awesome.min.css">
</head>
<body>
	<form class="table" method="POST">
		<button class="send__btn">Загрузить на сайт</button>
	</form>
	<script src="script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		let data = JSON.parse('<?= str_replace('\n', ' ', json_encode(parse_excel_file($_POST['file']), JSON_UNESCAPED_UNICODE)) ?>');

		$(document).ready(function () {
			const containerTable = $('<div>').addClass('container-table');
			
			for (let i = 0, length = data[0].length; i < length; i++) {
				let wrapperCol = $('<div>').addClass('wrapper-col');
				for (let j = 0, length = data.length; j < length; j++) {
					let icon = $('<i>').attr({class: 'fa fa-times-circle', 
						style: 'opacity: 0; align-self: flex-start;', 'aria-hidden': 'true'});
					let cell = $('<div>').addClass('cell');
					let value = $('<span>');
					value.addClass('value');
					cell.attr({name: 'cell-value'});
					cell.addClass('row_' + j);
					cell.addClass('col_' + i);
					value.text(data[j][i]);
					cell.append(value);
					cell.append(icon);
					wrapperCol.append(cell);

				}
				containerTable.append(wrapperCol);
			}
			$('.table').append(containerTable);

			$('.table').submit(function () {
		        const table = {};
		        let colls = $('.wrapper-col');

		        for (let i = 0, numOfCols = $('.wrapper-col').length; i < numOfCols; i++) {
		        	let col = $('.col_' + i);
		        	
		        	if (col.children('.value').length > 0) {
		        		let key = col.children()[0].innerText;
		        		table[key] = [];
			        	for (let j = 1, numOfRows = $('.col_0').length; j < numOfRows; j++) {
			        		table[key].push($('.col_' + i + ':eq('+j+')').children()[0].innerText);
			        	}
			        } else {
			        	numOfCols++;
			        }
		        }
		        
		        console.table(table);
		        $.ajax({
		            type: 'POST',
		            url: 'request.php',
		            data: 'stringfy_json=' + JSON.stringify(table),
		            success: function (responseMsg) {
		            	alert(responseMsg);
		            	window.location = "index.php";
            	    }
        		});

		        return false;
	    	});
		});
	</script>
	<script src="script/script.js"></script>
</body>
</html>

