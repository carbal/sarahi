<div class="col-md-12">
	<legend>Agregar productos a una cadena</legend>
	<div class="alert alert-danger" id="error" style="display:none;">
		<p><strong>ADVERTENCIA : </strong>Este producto ya ha sido agregado.</p>
	</div>
	<div class="row">

	<div class="col-md-5">
<form class="form form-horizontal" id="addProducto">
	<div class="form-group">
		<label class="col-md-5 control-label">Cadena :</label>
		<div class="col-md-7">
		<input class="form-control" name="cadena" id="auto_cadena" placeholder="Requerido">
		<div id="caja">
		</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-5 control-label pull-left">Producto :</label>
		<div class="col-md-7">

		<select name="producto" class="form-control">
			<option selected>Elegir producto</option>
			<?foreach($productos as $producto):?>
			<option value="<?=$producto['sku']?>"><?=$producto['descripcion']?></option>
			<?endforeach;?>
		</select>		
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-5 control-label">Precio Venta :</label>
		<div class="col-md-7">
			<input class="form-control" name="precio" placeholder="requerido">
		</div>
	</div>	
	<div class="form-group text-center">
		<button type="button" class="btn btn-success" id="agregar">Agregar</button>		
	</div>

</form>
</div>
<div class="col-md-5 col-md-offset-1"><!-- panel derecho-->
  <div class="alert alert-danger" id="container-errores" style="display:none;">
    <p><strong>AVISO : </strong>Verifique los siguientes errores</p>
    <div id="errores"></div>
  </div>
	<div id="productos">
	</div>

</div>
</div><!-- div.row-->
<div class="alert alert-info">
		<p><strong>AVISO :</strong> Agrege los productos que serán permitidos para esta cadena</p>
	</div>

</div>



<!--
	SECCION DE VENTANAS MODALES
-->
<div class="modal fade" id="modal_cadena_update">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Actualizar el precio del producto</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="update">        	
        	<div class="form-group">
        		<label class="control-label col-md-3">Precio Nuevo:</label>
        		<div class="col-md-5">
        			<input class="form-control" name="nuevo">
        		</div>
        	</div>
        </form>
          <div class="alert alert-danger" id="modal-error" style="display:none;">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="update_producto">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_cadena_delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Desea eliminar este producto?</h4>
      </div>
      <div class="modal-body">        
        <button type="button" class="btn btn-primary" id="delete_producto">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>