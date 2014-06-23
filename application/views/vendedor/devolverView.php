<div class="col-md-10 col-md-offset-1">
	<legend>Formulario de devolución de productos.</legend>
	<div class="alert alert-info" id="info">
		<p><strong>Info : </strong>eliga un cliente, para continuar</p>
	</div>
	<div class="alert alert-danger" id="container-errors" style="display:none;">
		<p><strong>AVISO : </strong>verifique los siguientes errores</p>
		<br>
		<div id="errors">			
		</div>
	</div>
		<div class="row">
		<div class="col-md-6">
			
		<form class="form-horizontal" id="devolver">
			<div class="form-group">
				<div class="col-md-11">
					
					<div class="input-group">					
						<input name="cliente" type="text" class="form-control" placeholder="buscar cliente..." id="autocompletar_clientes">
						<!--
						aqui se cargan las sugerencias de clientes del método autocompletar
						-->
						<div class="col-md-8" id="sugerencias" style="display:none;">							
						</div>
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary" id="productos">siguiente</button>
						</div>
					</div>
				</div>
			</div>			
			<div id="productos">				
			</div>			
		</form>
		</div>


		<div class="col-md-6">
			
		</div>		
		</div>
</div>