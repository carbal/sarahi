<div class="input-group input-group-sm col-md-4 col-md-offset-4">
  <span class="input-group-btn"><button class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span></button></span>
  <input type="text" class="form-control" placeholder="filtrar producto" onkeypress="filterTable(this.value,'.table')">
</div>
<br>
<br>
<br>
<br>
<div class="col-md-8 col-md-offset-2">
	<table class="table table-condensed">
		<tr>
			<th>REFERENCIA</th>
			<th>SKU</th>
			<th>DESCRIPCIÓN</th>
			<th>UNIDAD</th>
			<th>CATEGORIA</th>
			<th>COSTO</th>
			<th>VENTA</th>
			<th>ACCIONES</th>
		</tr>
		<?foreach($productos as $producto):?>
			<tr>
				<td><?=$producto['referencia']?></td>
				<td><?=$producto['sku']?></td>
				<td><?=$producto['descripcion']?></td>
				<td><?=$producto['unidad_medida']?></td>
				<td><?=$producto['categoria']?></td>
				<td><?=$producto['precio_costo']?></td>
				<td><?=$producto['precio_venta']?></td>
				<td style="text-align:center;"><a href="<?=base_url()?>index.php/productos/formProducto/<?=$producto['sku']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
			</tr>
		<?endforeach;?>
	</table>
</div>