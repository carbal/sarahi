<div class="col-md-10 col-md-offset-1">
	<legend>Almacen General</legend>
	<div class="alert alert-success" id="success" style="display:none;">
		<h5>Se actualizó con éxito</h5>
	</div>
<?if(sizeof($productos)>0):?>
	<div class="panel panel-primary">
	<div class="panel-heading"><h5 class="panel-tittle"><?=$nombre?></h5></div>	

	<div class="table-responsive">
		<table class="table table-condensed">
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>SKU</th>
				<th class="text-center">COSTO</th>
				<th class="text-center">VENTA</th>
				<th class="text-center">ALMACEN</th>
				<th class="text-center">SUBALMACEN</th>
				<th class="text-center">TOTAL</th>
				<th class="text-center">MINÍMO</th>
				<th class="text-center">EDITAR</th>
			</tr>
			
		<?foreach ($productos as $producto):?>
		<?if($producto['total']<= $producto['stock_min']):?>
		<tr class="danger">
		<?elseif ($producto['total'] <= $producto['stock_min'] + TOLERANCIA):?>
		<tr class="warning">
		<?else:?>
		<tr class="success">
		<?endif;?>
			<td><?=$producto['descripcion']?></td>
			<td><?=$producto['sku']?></td>
			<td class="text-center"><?=$producto['costo']?></td>
			<td class="text-center"><?=$producto['venta']?></td>		
			<td class="text-center"><?=$producto['almacen']?></td>
			<td class="text-center"><?=$producto['subalmacen']?></td>
			<td class="text-center"><?=$producto['total']?></td>
			<td class="text-center"><?=$producto['stock_min']?></td>
			<td class="text-center"><span class="glyphicon glyphicon-pencil" title="Editar" onclick="almacen.modalZona(<?=$producto['id']?>)" ></span></td>
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

<div class="col-md-10 col-md-offset-1">
	
	<div class="panel panel-primary">
		<div class="panel-heading">
		<h5 class="panel-tittle"><?="USUARIO :"." ".strtoupper($subalmacen['usuario'])?></h5>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th>DESCRIPCIÓN</th>
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

