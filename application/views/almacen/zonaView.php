<div class="col-md-8 col-md-offset-2">
	<legend>Almacen General</legend>
	<div class="alert alert-success" id="success" style="display:none;">
		<h5>Se actualizó con éxito</h5>
	</div>
<?if(sizeof($cuerpo)>0):?>
	<div class="panel panel-primary">
	<div class="panel-heading"><h4 class="panel-tittle"><?=strtoupper($nombre)?></h4></div>	

	<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>SKU</th>
				<th>CATEGORÍA</th>
				<th>P. COSTO</th>
				<th>P. VENTA</th>
				<th>EXISTENCIA</th>
				<th>EDITAR</th>
			</tr>
			
		<?foreach ($cuerpo as $fila):?>
		<tr>
			<td><?=$fila['descripcion']?></td>
			<td><?=$fila['sku']?></td>
			<td><?=$fila['categoria']?></td>
			<td class="text-center"><?=$fila['costo']?></td>
			<td class="text-center"><?=$fila['venta']?></td>		
			<td class="text-center"><?=$fila['existencia']?></td>
			<td class="text-center"><span class="glyphicon glyphicon-pencil" title="Editar" style="cursor:pointer;" onclick="almacen.modalZona(<?=$fila['id']?>);"></span></td>
		</tr>
		<?endforeach;?>

		</table>
	</div>
	</div>
<?else:?>
<div class="alert alert-danger">
	<p>El almacen no tiene <strong>productos</strong> agregados.</p>
</div>
<?endif;?>	

<legend>Sub-almacenes</legend>
	
	<?if(count($subalmacenes)>0):?>	
	<?foreach($subalmacenes as $subalmacen):?>

	<div class="panel panel-primary">
		<div class="panel-heading">
		<h4 class="panel-tittle"><?="USUARIO :"." ".strtoupper($subalmacen['usuario'])?></h4>
		</div>
		<div class="table-responsive">
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
		<div class="alert alert-danger">
			<p>No existen <strong>usuarios</strong> para este almacen.</p>
		</div>

	<?endif;?>
</div>

<div class="modal fade" id="modalEditar">	
</div>
