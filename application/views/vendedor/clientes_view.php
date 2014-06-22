<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-primary">
		<div class="panel-heading">			
			<h1 class="panel-title">CLIENTES EN MI ZONA</h1>
		</div>
		<div class="panel-body">
			<table class="table table-hover" style="font-size:0.9em;">
				<tr>
					<th>CLIENTE</th>
					<th>RFC</th>
					<th>REGIMEN</th>
					<th>REPRESENTANTE</th>
					<th>C. POSTAL</th>
					<th>COLONIA</th>
					<th>CALLE</th>
					<th>ZONA</th>
				</tr>
				<?foreach($clientes as $cliente):?>
					<tr>
						<td><?=$cliente['nombre']?></td>
						<td><?=$cliente['rfc']?></td>
						<td><?=$cliente['regimen']?></td>
						<td><?=$cliente['representante']?></td>
						<td><?=$cliente['cp']?></td>
						<td><?=$cliente['colonia']?></td>
						<td><?=$cliente['calle']?></td>
						<td><?=$cliente['estado']?></td>
					</tr>
				<?endforeach;?>
			</table>
		</div>
	</div>
</div>