<table class="table table-condensed table-bordered">
	<tr>
		<th colspan="2">Informacion del Vendedor</th>
	</tr>
	<tr>
		<td>NOMBRE :</td>
		<td><?=strtoupper($vendedor['nombres'])?></td>
	</tr>
	<tr>
		<td>APELLIDOS :</td>
		<td><?=strtoupper($vendedor['apellidos'])?></td>
	</tr>
	<tr>
		<td>ZONA :</td>
		<?switch($vendedor['id_zona']):?><?case 1:?><td>YUCATÁN</td><?break;?>
			<?case 2:?>
				<td>QUINTANA ROO</td>
			<?break;?>
			<?case 3:?>
				<td>CAMPECHE</td>
			<?break;?>
		<?endswitch;?>
	</tr>
	<tr>
		<td>DOMICILIO :</td>
		<td><?strtoupper($vendedor['domicilio'])?></td>
	</tr>
</table>

<table class="table table-condensed table-bordered">
	<tr>
		<th colspan="2">Información del Cliente</th>
	</tr>
	<tr>
		<td>NOMBRES :</td>
		<td><?=strtoupper($cliente['nombre'])?></td>
	</tr>
	<tr>
		<td>RFC :</td>
		<td><?=strtoupper($cliente['rfc'])?></td>
	</tr>
	<tr>
		<td>CORREO :</td>
		<td><?=strtoupper($cliente['correo'])?></td>
	</tr>
	<tr>
		<td>REFERENCIA :</td>
		<td><?=strtoupper($cliente['referencia'])?></td>
	</tr>
</table>

<table class="table table-condensed table-bordered">
	
	<tr>
		<th colspan="5">Productos</th>
	</tr>
	<tr>
		<td>SKU</td>
		<td>DESCRIPCIÓN</td>
		<td>PRECIO</td>
		<td>CANTIDAD</td>
		<td>TOTAL</td>
	</tr>
	<?foreach($productos as $producto):?>
	<tr>
		<td><?=strtoupper($producto['sku'])?></td>
		<td><?=strtoupper($producto['descripcion'])?></td>
		<td><?=strtoupper($producto['precio_unitario'])?></td>
		<td><?=strtoupper($producto['cantidad'])?></td>
		<td><?=strtoupper($producto['total'])?></td>
	</tr>
	<?endforeach;?>
</table>
