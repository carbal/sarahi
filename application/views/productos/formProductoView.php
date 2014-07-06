<div class="col-md-10 col-md-offset-1">
  <legend>Producto Nuevo</legend>
  <div class="alert alert-info" id="insert" style="display:none;">
  <p><strong>AVISO :</strong>Se ha agregado un nuevo producto con éxito<span class="pull-right glyphicon glyphicon-ok"></span></p>
</div> 
<div class="alert alert-info" id="update" style="display:none;">
  <p><strong>AVISO :</strong>Se ha actualizado el registro con éxito<span class="pull-right glyphicon glyphicon-ok"></span></p>
</div>


  <div class="col-md-6">
    <form class="form-horizontal" role="form" id="producto">
        <div class="form-group">
          <label for="input1" class="col-md-4 control-label">Referencia :</label>
          <div class="col-md-8">
            <input name="referencia" type="text" class="form-control" id="input1" placeholder="Requerido">
          </div>
        </div>
        <div class="form-group">
          <label for="input2" class="col-md-4 control-label">SKU :</label>
          <div class="col-md-8">
            <input name="sku" type="text" class="form-control" id="input2" placeholder="Requerido">
          </div>
        </div>
        <div class="form-group">
          <label for="input3" class="col-md-4 control-label">Descripcion :</label>
          <div class="col-md-8">
            <textarea name="descripcion" class="form-control" rows="3" cols="10"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="input4" class="col-md-4 control-label">Unidad de Medida :</label>
          <div class="col-md-8">
            <input name="unidad_medida" class="form-control" id="input4" placeholder="Requerido">
          </div>      
        </div>
        <div class="form-group">
        <label for="input5" class="col-md-4 control-label">Categoria :</label>
        <div class="col-md-8">
          <input name="categoria" class="form-control" id="input5" placeholder="Requerido">
        </div>
        </div>
        <div class="form-group">
          <label for="input6" class="col-md-4 control-label">Precio Costo :</label>
          <div class="col-md-8">
            <input name="precio_costo" class="form-control" id="input6" placeholder="Requerido">
          </div>
        </div>
        <div class="form-group">
          <label for="input7" class="col-md-4 control-label">Precio Venta :</label>
          <div class="col-md-8">
            <input name="precio_venta" class="form-control" id="input7" placeholder="Requerido">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <input type="button" class="btn btn-lg btn-success pull-right" id="add_producto" value="Guardar">
          </div>
        </div>
    </form>
  </div>


  <div class="col-md-6">
    <div class="alert alert-danger" id="container-errors" style="display:none;">
      <p><strong>AVISO:</strong>Verifique los siguientes errores. <span class="pull-right glyphicon glyphicon-remove"></span></P>
        <br>
      <div id="errors">
      </div>
    </div>
  </div>
</div>
<?if(isset($js)):?>
  <?=$js?>
<?endif;?>