<div class="col-md-8 col-md-offset-2">
	<legend>Formulario de visita a cliente : </legend>
	<div class="alert alert-info" id="info" style="display:none;">
		<p><strong>AVISO : </strong>el formulario de visita se ha completado con exito.</p>
	</div>
	<div class="alert alert-danger" id="container-errors" style="display:none;">
		<p><strong>AVISO :</strong>Verifique los siguientes errores.</p>
		<br>
		<div id="errors">			
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2">
	<form  class="form-horizontal" id="visitar">
		<div class="form-group">			
			<div class="col-md-12">
				<div class="input-group">				
				<input type="text" class="form-control" placeholder="buscar cliente...." id="autocompletar_clientes" name="rfc">	
				<div class="col-md-10" id="sugerencias">
					
				</div>
				<div class="input-group-btn">
					<button type="button" class="btn btn-primary">&nbsp&nbsp<span class="glyphicon glyphicon-search"></span>&nbsp&nbsp</button>
				</div>
				</div>
			</div>
		</div>
		<div class="form-group">			
			<div class="col-md-12">
				<textarea name="descripcion" id="" cols="30" rows="10" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-2 col-md-offset-9">
			<button type="button" class="btn btn-success btn-lg" id="visitar">Agregar</button>				
			</div>
		</div>	
	</form>
	</div>
</div>