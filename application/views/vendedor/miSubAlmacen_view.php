<div class="col-md-8 col-md-offset-2">

	<legend>Mi Almacen</legend>
	
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="panel-tittle">Productos en existencia:</h4>
</div>	

<div class="panel-body">
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>Descripción</th>
			<th>SKU</th>
			<th>Categoría</th>			
			<th>Existencia</th>
		</tr>
		<?foreach($productos as $producto):?>
		<tr>			
			<td><?=$producto['descripcion']?></td>
			<td><?=$producto['sku']?></td>
			<td><?=$producto['categoria']?></td>
			<td><?=$producto['existencia']?></td>
		</tr>
		<?endforeach;?>
	

	</table>	
</div>

<div class="contenedor-paginas">
	
</div>
</div>
</div>
</div>

