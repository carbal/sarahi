
<?if(count($productosCadena)>0):?>
<div class="table-responsive">	
<table class="col-md-12 table-bordered">
<tr class="success">
	<th>Descripción</th>
	<th>SKU</th>
	<th>Venta</th>
	<th colspan="2">Acciones</th>
</tr>
<?foreach($productosCadena as $producto):?>
<tr>
	<td><?=$producto['descripcion']?></td>
	<td><?=$producto['sku']?></td>
	<td><?=$producto['precio']?></td>
	<td class="text-center"><img src="<?=base_url()?>img/delete.png" title="Eliminar" class="precio" tipo="eliminar" id="<?=$producto['id_precio']?>"></td>
	<td class="text-center"><img src="<?=base_url()?>img/edit.png" title="Actualizar" class="precio" tipo="actualizar" id="<?=$producto['id_precio']?>"></td>

</tr>
<?endforeach;?>

</table>

</div>
<?else:?>
<div class="alert alert-danger">
	<p><strong>ADVERTENCIA :</strong>Esta cadena no tiene productos agregados</p>
</div>
<?endif;?>

