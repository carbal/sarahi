<div class="col-md-10 col-md-offset-1">
	<legend>Cliente Nuevo</legend>
	<div class="alert alert-info" id="info" style="display:none;">		
	</div>


<div class="row">
	<div class="col-md-6">
		<form  class="form form-horizontal" id="cliente">
		<div class="form-group">
			<label class="col-md-4 control-label">Nombre : </label>
			<div class="col-md-8"><input type="text" class="form-control" name="nombre" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">RFC : </label>
			<div class="col-md-8"><input type="text" class="form-control" name="rfc" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Cadena : </label>
			<div class="col-md-8">
				<select class="form-control" name="cadena">
					<option selected value="">Eligir opción</option>
					<?foreach ($cadenas as $cadena):?>
					<option value="<?=$cadena['id_cadena']?>"><?=$cadena['cadena']?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Regimen :</label>
			<div class="col-md-8">
				<select class="form-control" name="regimen">
					<option selected value="">Elegir opción</option>
					<option value="fisico">Físico</option>
					<option value="moral">Moral</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Zona</label>
			<div class="col-md-8">
				<select name="zona" class="form-control">
					<option selected value="">Elegir opción</option>
					<?foreach($zonas as $zona):?>
					<option value="<?=$zona['id_zona']?>"><?=$zona['zona']?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Calle :</label>
			<div class="col-md-8"><input type="text" class="form-control" name="calle" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">No. Interior</label>
			<div class="col-md-8"><input type="text" class="form-control" name="interior" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">No. Exterior</label>
			<div class="col-md-8"><input type="text" class="form-control" name="exterior" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Colonia</label>
			<div class="col-md-8"><input type="text" class="form-control" name="colonia" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Municipio</label>
			<div class="col-md-8"><input type="text" class="form-control" name="municipio" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Correo :</label>
			<div class="col-md-8"><input type="text" class="form-control" name="correo" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Rerefencia :</label>
			<div class="col-md-8"><input type="text" class="form-control" name="referencia" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Codigo Postal :</label>
			<div class="col-md-8"><input type="text" class="form-control" name="codigo" placeholder="Requerido"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-4 control-label">Representante :</label>
			<div class="col-md-8"><input type="text" class="form-control" name="representante" placeholder="Requerido"></div>
		</div>
		<div class="col-md-12">
			<button type="button" class="btn btn-success btn-lg pull-right" id="add_cliente">Agregar</button>
		</div>
		</form>
		
	</div>
	<div class="col-md-6">
		<div class="alert alert-danger" id="container-errors" style="display:none;">
		<p><strong>AVISO : </strong>Verifique los siguientes errores</p>		
		<br>
		<div id="errors">
			
		</div>
	</div>
	</div>
</div>
	
	<br>
	<br>
	<br>

</div>