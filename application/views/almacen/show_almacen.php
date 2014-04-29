<div class="col-md-8 col-md-offset-2">
	<legend>Almacen General</legend>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="panel-tittle">Productos en existencias : <?=strtoupper($nombre)?></h4>
</div>	

<div class="panel-body">
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>Descripción</th>
			<th>SKU</th>
			<th>Categoría</th>
			<th>Precio Costo</th>
			<th>Precio Venta</th>
			<th>Existencia</th>
		</tr>
	<?foreach ($cuerpo as $fila):?>
	<tr>
		<?foreach ($fila as $registro):?>
			<td><?=$registro?></td>
		<?endforeach;?>
	</tr>
	<?endforeach;?>

	</table>	
</div>


</div>
</div>
<legend>Sub-almacenes</legend>
	

	
	<?if(count($subalmacenes)>0):?>	
	<?foreach($subalmacenes as $subalmacen):?>

	<div class="panel panel-primary">
		<div class="panel panel-heading">
			<h4 class="panel-tittle">
				<?="USUARIO :"." ".strtoupper($subalmacen['usuario'])?>
			</h4>
		</div>
		<div class="panel panel-body">
			<table class="table table-hover">
			<tr>
				<th>DESCRIPCION</th>
				<th>SKU</th>
				<th>CATEGORIA</th>
				<th>EXISTENCIA</th>
			</tr>		
			<?foreach($subalmacen['productos'] as $producto):?>
			<tr>
				<td><?=$producto['descripcion']?></td>
				<td><?=$producto['sku']?></td>
				<td><?=$producto['categoria']?></td>
				<td><?=$producto['existencia']?></td>
			</tr>
			<?endforeach;?>
		</table>
		</div>
	</div>
	<?endforeach;?>

	<?else:?>
		<div class="alert alert-danger col-md-10 col-md-offset-1">
			<h5>No existen <strong>usuarios</strong> para este almacen</h5>
		</div>

	<?endif;?>
</div>


