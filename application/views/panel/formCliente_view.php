<div class="col-md-10 col-md-offset-1">
	<legend>Agregar Cliente Nuevo</legend>
	<div class="alert alert-info" id="info" style="display:none;">		
	</div>


<div class="row">
	<div class="col-md-7">
		<form  class="form form-horizontal" id="cliente">
		<div class="form-group">
			<label class="col-md-3 control-label">Nombre : </label>
			<div class="col-md-6"><input type="text" class="form-control" name="nombre"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">RFC : </label>
			<div class="col-md-6"><input type="text" class="form-control" name="rfc"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Cadena : </label>
			<div class="col-md-6">
				<select class="form-control" name="cadena">
					<option selected value="">Eligir opción</option>
					<?foreach ($cadenas as $cadena):?>
					<option value="<?=$cadena['id_cadena']?>"><?=$cadena['cadena']?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Regimen :</label>
			<div class="col-md-6">
				<select class="form-control" name="regimen">
					<option selected value="">Elegir opción</option>
					<option value="fisico">Físico</option>
					<option value="moral">Moral</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Zona</label>
			<div class="col-md-6">
				<select name="zona" class="form-control">
					<option selected value="">Elegir opción</option>
					<?foreach($zonas as $zona):?>
					<option value="<?=$zona['id_zona']?>"><?=$zona['zona']?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Calle :</label>
			<div class="col-md-6"><input type="text" class="form-control" name="calle"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">No. Interior</label>
			<div class="col-md-6"><input type="text" class="form-control" name="interior"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">No. Exterior</label>
			<div class="col-md-6"><input type="text" class="form-control" name="exterior"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Colonia</label>
			<div class="col-md-6"><input type="text" class="form-control" name="colonia"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Municipio</label>
			<div class="col-md-6"><input type="text" class="form-control" name="municipio"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Correo :</label>
			<div class="col-md-6"><input type="text" class="form-control" name="correo"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Rerefencia :</label>
			<div class="col-md-6"><input type="text" class="form-control" name="referencia"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Codigo Postal :</label>
			<div class="col-md-6"><input type="text" class="form-control" name="codigo"></div>
		</div>
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Representante :</label>
			<div class="col-md-6"><input type="text" class="form-control" name="representante"></div>
		</div>
		<div class="col-md-3 col-md-offset-5">
			<button type="button" class="btn btn-success btn-lg" id="add_cliente">Agregar</button>
		</div>
		</form>
		
	</div>
	<div class="col-md-5">
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