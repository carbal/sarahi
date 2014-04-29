<div class="row">
	<div class="text-center">
<div class="btn-group">
  <button type="button" class="btn btn-default btn-sm" id="carrito">Agregar</button>
  <button type="button" class="btn btn-default btn-sm" id="cancelar">Eliminar</button>

  <div class="btn-group">
    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
      Acciones
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a id="modal_efectivo">Efectivo</a></li>
      <li><a id="modal_credito">Credito</a></li>
    </ul>
  </div>
</div>
	</div>
</div>
<!--
<br>
<br>
<button class="btn btn-success btn-lg" id="carrito">Agregar</button>
<button class="btn btn-danger btn-lg" id="cancelar">Eliminar</button>
<br><br>
<button class="btn btn-primary btn-lg" id="modal_efectivo">Efectivo</button>
<button class="btn btn-warning btn-lg" id="modal_credito">&nbsp;Credito&nbsp;</button>
</div>
-->


<div class="row">
	<h4 class="text-center text-primary">Productos:</h4>
	<fom class="form form-horizontal" id="form-cliente">
					<div class="form-group">
						<label class="col-md-3 control-label">Producto:</label>
						<div class="col-md-8">
							<select id="id_producto" class="form-control input-sm">
								<option selected>Elegir producto</option>
								<?foreach($productos as $producto):?>
								<option id="<?=$producto['sku']?>" precio="<?=$producto['precio']?>"><?=$producto['descripcion']?></option>
								<?endforeach;?>
							</select>
						</div>
						</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Precio:</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm" id="precio" value="00.0" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Cantidad:</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm" id="cantidad">
						</div>
					</div>					
	</fom>	

</div>


<div class="row">
<h4 class="text-center text-primary">Detalles del Cliente</h4>
	<fom class="form form-horizontal" id="form-cliente">
					<div class="form-group">
						<label class="col-md-3 control-label">Cliente:</label>
						<div class="col-sm-8">
							<input type="text" value="<?=$cliente['nombre']?>" class="form-control input-sm" id="cliente" readonly>
						</div>
						</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">RFC:</label>
						<div class="col-sm-8">
							<input type="text" value="<?=$cliente['rfc']?>" class="form-control input-sm" id="rfc" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Cadena:</label>
						<div class="col-sm-8">
							<input type="text" value="<?=$cliente['representante']?>" class="form-control input-sm" id="cadena" readonly>
						</div>
					</div>
	</fom>	
</div>
