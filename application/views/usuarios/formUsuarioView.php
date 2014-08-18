<div class="col-md-10 col-md-offset-1">
<legend>Usuario Nuevo</legend>
<div class="alert alert-info" id="insert" style="display:none;">
  <p><strong>AVISO :</strong>Se ha agregado un nuevo usuario con éxito<span class="pull-right glyphicon glyphicon-ok"></span></p>
</div> 
<div class="alert alert-info" id="update" style="display:none;">
  <p><strong>AVISO :</strong>Se ha actualizado el registro con éxito<span class="pull-right glyphicon glyphicon-ok"></span></p>
</div>

<div class="col-md-6">
  <form id="usuario" class="form-horizontal text-center" role="form">
  <div class="form-group">
    <label  class="col-md-4 control-label">Nombres :</label>
    <div class="col-md-8">
      <input name="nombres"  type="text" class="form-control" id="nombre" placeholder="Requerido">      
    </div>
  </div>
  <div class="form-group">
    <label for="input2" class="col-md-4 control-label" >Apellidos :</label>
    <div class="col-md-8">
      <input name="apellidos" type="text" class="form-control" id="input2" placeholder="Requerido">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="control-label col-md-4">Usuario :</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="usuario" placeholder="Requerido">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="control-label col-md-4">Tipo :</label>
    <div class="col-md-8">
      <div class="radio-inline">
        <label>
          <input type="radio" name="tipo" value="1">
        Administrador
        </label>
      </div>
      <div class="radio-inline">
        <label>
          <input type="radio" name="tipo" value="0" checked>
        Vendedor
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label">Zona :</label>
    <div class="col-md-8">
      <select class="form-control" name="id_zona">
        <option selected>Elegir Zona</option>
        <?foreach($zonas as $zona):?>
        <option value="<?=$zona['id_zona']?>"><?=$zona['zona']?></option>
        <?endforeach;?>
      </select>

    </div>
  </div>
  <div class="form-group">
    <label for="inputx" class="col-md-4 control-label" >Domicilio :</label>
    <div class="col-md-8">
    <input name="domicilio" type="text" class="form-control" id="inputx" placeholder="Requerido">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-md-4 control-label">Contraseña :</label>
    <div class="col-md-8">
        <input name="password" type="password" class="form-control" id="input3" placeholder="Requerido">
    </div>
  </div>
   <div class="form-group">
    <label for="input3" class="col-md-4 control-label">Confirmar :</label>
    <div class="col-md-8">
        <input name="pass2" type="password" class="form-control" id="input3" placeholder="Requerido">
    </div>
  </div>  
  <br>  
  <div class="form-group">
  <div class="col-md-12">
      <button type="button" class="btn btn-lg btn-success pull-right" id="add_usuario">Guardar</button>   
  </div>      
  </div>
</form>
</div>

<div class="col-md-6">
  <div class="alert alert-danger" style="display:none;" id="container-errores">
     
    <p><strong>AVISO : </strong>Verifique los siguientes errores.<span class="pull-right glyphicon glyphicon-remove"></span></p>
    <br>
    <div id="errores">
    </div>

  </div>
</div>
</div>

<?if(isset($js)):?>
<?=$js?>
<?endif;?>
