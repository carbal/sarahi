<div class="col-md-10 col-md-offset-1">
  <legend>Agregar nuevo producto</legend>
<form class="form-horizontal" role="form" id="producto">
  <div class="alert alert-danger" id="container-errores" style="display:none;">
    <p><strong>AVISO:</strong>Verifique los siguientes errores .</P>
      <br>
    <div id="errores">
    </div>
  </div>
  <div class="alert alert-info" id="exito" style="display:none;">
    <P>
      <strong>AVISO:</strong> Se ha agregado un nuevo producto con exito.
    </P>
  </div>


    <div class="form-group">
      <label for="input1" class="col-md-2 control-label">Referencia :</label>
      <div class="col-md-4">
        <input name="referencia" type="text" class="form-control" id="input1" placeholder="Requerido">
      </div>
    </div>
    <div class="form-group">
      <label for="input2" class="col-md-2 control-label">SKU :</label>
      <div class="col-md-4">
        <input name="sku" type="text" class="form-control" id="input2" placeholder="Requerido">
      </div>
    </div>
    <div class="form-group">
      <label for="input3" class="col-md-2 control-label">Descripcion :</label>
      <div class="col-md-4">
        <textarea name="descripcion" class="form-control" rows="3" cols="10"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="input4" class="col-md-2 control-label">Unidad de Medida :</label>
      <div class="col-md-4">
        <input name="um" class="form-control" id="input4" placeholder="Requerido">
      </div>      
    </div>
    <div class="form-group">
    <label for="input5" class="col-md-2 control-label">Categoria :</label>
    <div class="col-md-4">
      <input name="categoria" class="form-control" id="input5" placeholder="Requerido">
    </div>
    </div>
    <div class="form-group">
      <label for="input6" class="col-md-2 control-label">Precio Costo:</label>
      <div class="col-md-4">
        <input name="precioc" class="form-control" id="input6" placeholder="Requerido">
      </div>
    </div>
    <div class="form-group">
      <label for="input7" class="col-md-2 control-label">Precio Venta:</label>
      <div class="col-md-4">
        <input name="preciov" class="form-control" id="input7" placeholder="Requerido">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-offset-4">
      <input type="button" class="btn btn-lg btn-success" id="producto" value="Agregar">
      </div>
    </div>

</form>
</div>