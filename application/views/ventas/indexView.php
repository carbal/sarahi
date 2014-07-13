
<div class="col-md-6 col-md-offset-3">
  <div class="alert alert-danger" id="deuda" style="display:none;">
    <p><strong>ADVERTENCIA : </strong> El cliente seleccionado tiene cuentas pendiente, por favor verifique.</p>
  </div>
<form class="form form-horizontal">
  <div class="form-group">
    <br>
    <div class="input-group">
		<input class="form-control" id="autocompletar" placeholder="Escriba para buscar cliente">
    <span class="input-group-btn">
      <a  class="btn btn-primary">&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-search"></span>&nbsp&nbsp&nbsp</a>
    </span>
      
    </div>
		<div class="col-md-4" id="sugerencias"></div>
	</div>
</form>
	</div>

<div class="row">


<div class="col-md-3 col-md-offset-1" id="2paso" style="display:none;">

</div>
<div class="col-md-8">
<br>
<!--Div para mostrar los errores de validacion para el cliente-->
<div class="alert alert-danger col-md-8" id="errores" style="display:none;">
</div>
<br>
<!--Div para cargar las tablas de productos-->
<div class="col-md-10" id="tercero" style="display:none;">
	<h3 class="text-info text-center">Detalle de Productos :</h3>
	<div id="3paso">
	</div>
</div>

</div>


</div>


<!-- SECCIÓN DE VENTANAS MODALES-->
<div class="modal fade" id="modalVenta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#428bca;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Desea Eliminar los productos agregados?</h4>
      </div>
      <div class="modal-body">               
        <div class="text-center">
        	<button class="btn btn-default btn-lg" id="vaciar">Aceptar</button>
        	<button class="btn btn-default btn-lg" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="venta_efectivo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#428bca;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title">DESEA FINALIZAR LA VENTA?</h5>
      </div>
      <div class="modal-body">
      <h4 class="text-info"><strong>Nota : </strong>La venta se hará en pago en efectivo</h4>              
        <div class="text-center">
          <button class="btn btn-default btn-lg" id="efectivo">Aceptar</button>
          <button class="btn btn-default btn-lg" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="venta_credito">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#428bca;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title">DESEA FINALIZAR LA VENTA?</h5>
      </div>
      <div class="modal-body">
      <h4 class="text-info"><strong>Nota : </strong>La venta se hará en pago a crédito</h4>              
        <div class="text-center">
          <button class="btn btn-default btn-lg" id="credito">Aceptar</button>
          <button class="btn btn-default btn-lg" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

