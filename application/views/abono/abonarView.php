<form class="form-horizontal" id="form_abonar">
	<div class="col-md-6 col-md-offset-3">
	  <div class="input-group">
		  <input name="suggestion" type="text" class="form-control" placeholder="escriba una cadena o nombre de cliente" id="cadena_abono">
		  <div class="col-md-10" id="caja"></div>
		  <span class="input-group-btn">
		  	<button type="button" class="btn btn-primary" id="buscar_abono">			  		
		  		&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-search"></span>&nbsp&nbsp&nbsp
		  	</button>		  	
		  </span>
	  </div>
	</div>
	<input type="hidden" name="table" value="">
	<input type="hidden" name="id"    value="">
</form>
	<br>
	<br>
	<br>

	<div class="alert alert-danger col-md-6 col-md-offset-3" id="container-errores" style="display:none;">
		<p><strong>AVISO : </strong>Verifique los siguientes errores</p>
		<div id="errores">
			
		</div>		
	</div>
	<div class="alert alert-info col-md-6 col-md-offset-3" id="info">
		<?if($this->session->userdata('tipo')==1):?>
		<p><strong>Nota : </strong>Usted solo puedeo terminar cuentas a clientes pertenecientes a cadenas mayoristas</p>
		<?elseif ($this->session->userdata('tipo')==0):?>
		<p><strong>Nota :</strong>Usted solo puede terminar cuentas a clientes minorista de su zona</p>		
		<?endif;?>
	</div>

	<div class="row">		
	<div class="col-md-10 col-md-offset-1" id="resultados">
		
	</div>
	</div>
	<div class="modal fade" id="info_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title" id="myModalLabel">INFORMACIÓN SOBRE LA VENTA</h5>
      </div>
      <div class="modal-body">
                
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



