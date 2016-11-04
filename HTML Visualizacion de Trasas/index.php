<?php 
include ('../Arduino_Problema_Social/busine_logical/data_base/DataBase_Managment.php');
$database = new DataBase_Managment();
$con = $database->db_Connection();
$result = $con->query("SELECT * FROM trasa ORDER BY fecha DESC");

echo"
	<html>
		<head>
			<title>Dinero Movil</title>
			<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
			<script type='text/javascript' src='../TableFilter-master/dist/tablefilter/tablefilter.js'></script>
			<style>
				.myLoader{
        				position:absolute; padding: 5px;
        				margin:100px 0 0 5%; width:auto;
        				z-index:1000; font-size:12px; font-weight:bold;
        				border:1px solid #666; background:#ffffcc;
    					vertical-align:middle;
    					}
    				.myStatus{
        				width:auto; display:block;
    					}
			</style>
		</head>
		<body>
			<div class='w3-ciontainer w3-center'>
				<img class='w3-image' src='../images/hackBbv.jpg'>
				<p>Dinero m&oacute;vil para la gente sin acceso a servicios financieros: 
				&quot;Banking the Unbanked &amp; Wiring the Unwired&quot;</p>
				<p>&Uacute;ltimos Movimientos</p>
				<div id = 'tbl' class = 'w3-content'>
					<table id ='trasa'>
						<tr>
							<th>ID_TRASA</th>
							<th>ID_CLIENTE</th>
							<th>ID_PROVEEDOR</th>
							<th>OPERACION</th>
							<th>FECHA</th>
							<th>MONTO</th>
						</tr>";
				
				//iteracion sobre Sresult_trasa

				while($row = $result->fetch_assoc())
					{
						echo "<tr>
								<td>".$row['id_trasa']."</td>
								<td>".$row['id_cliente']."</td>
								<td>".$row['id_proveedor']."</td>
								<td>".$row['operacion']."</td>
								<td>".$row['fecha']."</td>
								<td>".$row['monto']."</td>
						</tr>";
					}			
				$con->close();
				echo"</table>
				<script language='javascript' type='text/javascript'>
					var filtersConfig = {
        							base_path: '../TableFilter-master/dist/tablefilter/',
        							paging: true,
        							state: {
          								types: ['local_storage'],
          								filters: true,
          								page_number: true,
          								page_length: true,
          								sort: true
        							},
        							results_per_page: ['Records: ', [10, 25, 50, 100]],
        							alternate_rows: true,
        							btn_reset: true,
        							rows_counter: true,
        							loader: true,
        							loader_html: '<div id= tbl></div>',
        							loader_css_class: 'myLoader',
        							status_bar: true,
        							status_bar_target_id: 'tbl',
        							status_bar_css_class: 'myStatus',
        							col_1: 'select',
        							col_2: 'select',
        							col_types: [
            								'string', 'string',
            								'string', 'string' 
        								],
        							extensions:[{
            								name: 'sort'
        							}]
    					};
    					var tf = new TableFilter('trasa', filtersConfig);
    					tf.init(); 
				</script> 
				</div><!--cierra contenedor de tabla-->
				</br>
				<div class='w3-container w3-blue'>
					<p>Technomadic Interactive &reg; 2016</p>
				</div>
			</div><!--cierra div container-->
		</body>
	</html>";
?>
