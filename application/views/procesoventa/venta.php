
	<div class="col-md-10 col-md-offset-2">
	<div class="row">
		<div class="col-md-5">
				<legend>Detalles del Cliente</legend>
				<fom class="form form-horizontal" id="form-cliente">
					<div class="form-group">
						<label class="col-md-3 control-label">Cliente:</label>
						<div class="col-md-8">
						<select class="form-control" id="cliente">
							<option selected>Elegir cliente</option>
							<?foreach($datos_clientes as $cliente):?>
							<option id="<?=$cliente['rfc']?>" cadena="<?=$cliente['cadena']?>"><?=$cliente['nombre']?></option>
							<?endforeach;?>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">RFC :</label>
						<div class="col-md-5">
							<input type="text" class="form-control" id="rfc" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Cadena :</label>
						<div class="col-md-5">
							<input type="text" class="form-control" id="cadena" readonly>
						</div>
					</div>
				</fom>		
		</div>
		<div class="col-md-5" id="contenedor-producto">
			<legend>Detalles del Producto</legend>
			<form class="form-horizontal" id="form-producto">
				<div class="form-group">
				<label class="col-md-3 control-label">Producto :</label>
				<div class="col-md-8">
					<select class="form-control" id="producto">
							<option selected>seleccione producto</option>
							<?foreach($datos_productos as $producto):?>
							<option id="<?=$producto['sku']?>"><?=$producto['referencia']." : ".$producto['descripcion']?></option>
							<?endforeach;?>
						</select>
				</div>
				</div>
				<div class="form-group">
				<label class="col-md-3 control-label">Precio :</label>
				<div class="col-md-8">
					<input class="form-control" type="text" name="precio">
				</div>
				</div>
				<div class="form-group">
				<label class="col-md-3 control-label">Cantidad :</label>
				<div class="col-md-8">
					<input class="form-control" type="text" name="cantidad">
				</div>
				</div>
			</form>
		</div>


	</div>
	<br>
	<br>
	<br>
	<div class="col-md-8" id="detalles-producto">
		<table class="table table-hover">
			<thead>
			<tr>
				<th>SKU</th>
				<th>Cantidad</th>
				<th>Precio unitario</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">Venta Total</td>
					<td>500.00$$</td>
				</tr>
			</tfoot>

		</table>
	</div>

	</div>



