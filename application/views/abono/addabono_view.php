<div class="col-md-10 col-md-offset-1">	
	<div class="alert alert-danger" id="container-errors" style="display:none">
		<p><strong>AVISO : </strong>Verifique los siguientes errores</p>
		<br>		
		<div id="errores">
			
		</div>
	</div>
	<legend>Cuenta por pagar : </legend>
	<?if($ultimo['porpagar']==0):?>
	<div class="alert alert-danger text-center">
		<strong>ESTA VENTA YA HA SIDO FINALIZADA</strong>
	</div>
	<?endif;?>
	<div class="row">
		<form class="form-inline">
			<div class="col-md-3">

				<div class="input-group">
				  <span class="input-group-btn">
				  	<?if($ultimo['porpagar']==0):?>
				  	<button type="button" class="btn btn-danger">
				  	<?else:?>
				  <button type="button" class="btn btn-danger" id="abonar">
				  	<?endif;?>
				  	Abonar :
				  </button>	 
				  </span>
				<?if($ultimo['porpagar']==0):?>
				<input type="text" class="form-control" placeholder="Abonar a Cuenta" title="Abonar a cuenta" readonly>			  
				<?else:?>
				 <input type="text" class="form-control" placeholder="Abonar a Cuenta" title="Abonar a cuenta" id="valor_abono">			  
				<?endif;?>
				</div>
			</div>
			<div class="col-md-3">				
				<div class="input-group">
				  <span class="input-group-btn">
				  <button type="button" class="btn btn-primary">
				  	Saldo :
				  </button>	 
				  </span>
				  <?if(count($pagos)==1):?>
				  <input type="text" class="form-control" placeholder="Saldo Actual" title="Saldo Actual" value="<?=$primero['porpagar']?>" readonly>
				  <?else:?>
				  <input type="text" class="form-control" placeholder="Saldo Actual" title="Saldo Actual" value="<?=$ultimo['porpagar']?>" readonly>
				  <?endif;?>

					
				</div>
			</div>
			<div class="col-md-3">				
				<div class="input-group">
				  <span class="input-group-btn">
				  <button type="button" class="btn btn-success">
				  	Inicial :
				  </button>	 
				  </span>
				  <??>
				  <input type="text" class="form-control" placeholder="Deuda Inicial" title="Deuda Inicial" value="<?=$primero['porpagar']?>" readonly>
				</div>
			</div>
			<div class="col-md-3">
				<input type="hidden" id="<?=$id_venta?>" class="id_venta">
				<input type="button" class="info btn btn-default" id="<?=$id_venta?>" title="información" class="info" value="Detalles">
			</div>
		</form>
	</div>
	<br>
	<br>
	<br>
	<div class="row">

		<legend>Historial de pagos:</legend>
		<div class="col-md-6 col-md-offset-3">
			
	<?if(count($pagos)>0):?>	
	<table class="table table-bordered">
		<tr class="success">
			<th>Fecha</th>
			<th>Cantidad Abonada</th>
			<th>Saldo Actual</th>			
		</tr>
		<?foreach($pagos as $pago):?>
		<tr>
			<td><?=$pago['fecha']?></td>
			<td><?=$pago['abono']?></td>
			<td><?=$pago['porpagar']?></td>
		</tr>
		<?endforeach;?>
	</table>
	<?else:?>
	<div class="alert alert-danger">
		<h5>No existen abonos para esta venta.</h5>
	</div>
	<?endif;?>
		</div>
	</div>

</div>
<div class="modal fade" id="pregunta_abono" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Desea agregar la cantidad a la cuenta del cliente?</h4>
      </div>
      <div class="modal-body">

      	<button type="button" class="btn btn-primary" id="fin_abono">Aceptar</button>
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="info_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Información sobre la venta</h4>
      </div>
      <div class="modal-body">
                
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


