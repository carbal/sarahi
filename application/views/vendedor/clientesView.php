<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-primary">
		<div class="panel-heading">			
			<h1 class="panel-title">CLIENTES EN MI ZONA</h1>
		</div>
		<div class="table-responsive">
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
						<td><?=strtoupper($cliente['nombre'])?></td>
						<td><?=strtoupper($cliente['rfc'])?></td>
						<td><?=strtoupper($cliente['regimen'])?></td>
						<td><?=strtoupper($cliente['representante'])?></td>
						<td><?=strtoupper($cliente['cp'])?></td>
						<td><?=strtoupper($cliente['colonia'])?></td>
						<td><?=strtoupper($cliente['calle'])?></td>
						<td><?=strtoupper($cliente['estado'])?></td>
					</tr>
				<?endforeach;?>
			</table>
		</div>
	</div>
</div>