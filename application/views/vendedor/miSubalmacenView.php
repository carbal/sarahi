<div class="col-md-8 col-md-offset-2">

	<legend>Mi Almacen</legend>
		
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h4 class="panel-tittle">Productos :</h4>
	</div>	

	<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>SKU</th>
				<th>CATEGORÍA</th>			
				<th>EXISTENCIA</th>
			</tr>
			<?foreach($productos as $producto):?>
			<tr>			
				<td><?=strtoupper($producto['descripcion'])?></td>
				<td><?=strtoupper($producto['sku'])?></td>
				<td><?=strtoupper($producto['categoria'])?></td>
				<td><?=strtoupper($producto['existencia'])?></td>
			</tr>
			<?endforeach;?>
		</table>	

	<div class="contenedor-paginas"></div>
	</div>
	</div>
</div>

