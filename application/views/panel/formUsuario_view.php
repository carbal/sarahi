
<div class="col-md-10 col-md-offset-1">
<legend>Agregar nuevo usuario</legend>
<div class="alert alert-danger" style="display:none;" id="container-errores">
   
  <p><strong>AVISO : </strong>Verifique los siguientes errores.</p>
  <br>
  <div id="errores">
  </div>

</div>
<div class="alert alert-info" id="exito" style="display:none;">
  <p><strong>AVISO :</strong>Se ha agregado un nuevo usuario con exito</p>
</div>

<form id="usuarios" class="form-horizontal text-center" role="form">
  <div class="form-group">
    <label for="input1" class="col-sm-2 control-label">Nombres :</label>
    <div class="col-sm-3">
      <input name="nombre"  type="text" class="form-control" id="nombre" placeholder="Requerido">      
    </div>
  </div>
  <div class="form-group">
    <label for="input2" class="col-sm-2 control-label" >Apellidos :</label>
    <div class="col-sm-3">
      <input name="apellido" type="text" class="form-control" id="input2" placeholder="Requerido">
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">Zona</label>
    <div class="col-md-3">
      <select class="form-control" name="zonas">
        <option selected>Elegir Zona</option>
        <?foreach($zonas as $zona):?>
        <option value="<?=$zona['id_zona']?>"><?=$zona['zona']?></option>
        <?endforeach;?>
      </select>

    </div>
  </div>
  <div class="form-group">
    <label for="inputx" class="col-sm-2 control-label" >Domicilio</label>
    <div class="col-sm-3">
    <input name="domicilio" type="text" class="form-control" id="inputx" placeholder="Requerido">
    </div>
  </div>
  <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Contraseña :</label>
    <div class="col-sm-3">
        <input name="pass" type="password" class="form-control" id="input3" placeholder="Requerido">
    </div>
  </div>
   <div class="form-group">
    <label for="input3" class="col-sm-2 control-label">Confirmar :</label>
    <div class="col-sm-3">
        <input name="pass2" type="password" class="form-control" id="input3" placeholder="Requerido">
    </div>
  </div>  
  <br>  
  <div class="form-group">
  <div class="col-md-5">
      <button type="button" class="btn btn-lg btn-success" id="add_user">Agregar</button>   
  </div>      
  </div>
</form>
</div>
