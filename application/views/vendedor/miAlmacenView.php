<div class="col-md-8 col-md-offset-2">
	<legend>Almacen General</legend>
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h4 class="panel-tittle">Productos :<?=strtoupper($nombre)?></h4>
	</div>	
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th>DESCRIPCIÓN</th>
					<th>SKU</th>
					<th>CATEGORÍA</th>
					<th>P. COSTO</th>
					<th>P. VENTA</th>
					<th>EXISTENCIA</th>
				</tr>
			<?foreach ($cuerpo as $fila):?>
			<tr>
				<td><?=$fila['descripcion']?></td>
				<td><?=$fila['sku']?></td>
				<td><?=$fila['categoria']?></td>
				<td><?=$fila['costo']?></td>
				<td><?=$fila['venta']?></td>
				<td><?=$fila['existencia']?></td>
			</tr>
			<?endforeach;?>

			</table>	
		</div>

	</div>
</div>


