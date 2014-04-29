	<div class="row">
		
	<table class="table table-bordered col-md-6">
		<tr class="success">
			<th colspan="2">VENTA</th>
		</tr>
		<tr>
			<th>Total : </th>
			<td><?=$venta['total_venta']?></td>
		</tr>
		<tr>
			<th>IVA : </th>
			<td><?=$venta['iva_venta']?></td>
		</tr>
		<tr>
			<th>Importe</th>
			<td><?=$venta['importe']?></td>
		</tr>
		<tr>
			<th>Fecha : </th>
			<td><?=$venta['fecha']?></td>
		</tr>
	</table>

	<table class="table table-bordered">
		<tr class="success"><th colspan="2 text-center">VENDEDOR</th></tr>
		<tr>
			<th>Nombre :</th>
			<td><?=$vendedor['nombres']?></td>
		</tr>
		<tr>
			<th>Apellidos :</th>
			<td><?=$vendedor['apellidos']?></td>
		</tr>	
		<tr class="success"><td colspan="2 text-center"><strong>CLIENTE</strong></td></tr>
		<tr>
			<th>Nombre :</th>
			<td><?=$cliente['nombre']?></td>			
		</tr>
		<tr>
			<th>RFC :</th>
			<td><?=$cliente['rfc']?></td>			
		</tr>	
		<tr>
			<th>Regimen :</th>
			<td><?=$cliente['regimen']?></td>
		</tr>
		<tr>
			<th>Cadena :</th>
			<td><?=$cliente['representante']?></td>
		</tr>
	</table>
	</div>
	
	<table class="table table-bordered">
		<tr>
			<tr class="success"><td colspan="4"><strong>PRODUCTOS</strong></td></tr>			
		</tr>
		<tr>
			<th>PRODUCTO</th>
			<th>SKU</th>
			<th>Precio</th>
			<th>Cantidad</th>			
		</tr>		
		<?foreach($productos as $producto):?>
		<tr>
			<td><?=$producto['descripcion']?></td>
			<td><?=$producto['sku']?></td>
			<td><?=$producto['precio_unitario']?></td>
			<td><?=$producto['cantidad']?></td>
		</tr>
		
		<?endforeach;?>
	</table>
	


