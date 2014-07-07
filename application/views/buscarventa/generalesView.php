<div class="col-md-12" >
  <div class="alert alert-danger" style="display:none;" id="container-errores">
    <p><strong>AVISO : </strong> Verifique los siguientes errores.<span class="pull-right glyphicon glyphicon-remove"></span></p>
    <br>
    <div id="errores"></div>
  </div>

	<div class="alert alert-success">
	<form class="form-inline col-md-offset-1" role="form" id="search">		
    <div class="form-group">
       <input class="form-control" placeholder="busqueda..." name="parametro" id="auto">
       <div id="caja"></div>   
    </div> 
    <div class="form-group">    
        <input type="text" class="form-control" id="fecha" name="fecha" placeholder="fecha"></input>    
    </div>
    <div class="form-group">    
        <input type="text" class="form-control" id="fecha2" name="intervalo" placeholder="fecha (opcional)"></input>    
    </div>  
  <div class="form-group">  
    <div class="checkbox">
      <label class="checkbox-inline" id="efectivo">
        <input type="checkbox" name="tipo" id="efectivo" value="1">&nbspEfectivo
      </label>  
    </div>
    <div class="checkbox">    
      <label class="checkbox-inline" id="credito">
        <input type="checkbox" name="tipo" id="credito" value="0">&nbspCredito
      </label>  
    </div>
    <div class="checkbox">    
      <label class="checkbox-inline" id="general">
        <input type="checkbox" name="tipo" id="general" value="g" checked>&nbspGeneral
      </label>
    </div>
  </div>

  &nbsp&nbsp&nbsp
  <div class="form-group">    
  <button type="button" class="form-control btn btn-primary" id="buscar" title="buscar">&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-search"></span>&nbsp&nbsp&nbsp</button>
  </div>
</form>
  </div>
  </div>
    <div class="alert alert-info col-md-8 col-md-offset-2" id="info">
      <p>&#8226;escriba en el primer campo para comenzar una busqueda.</p>
      <p>&#8226;el campo fecha es obligatorio.</p>
      <p>&#8226;el segundo campo fecha es opcional.</p>
      <p>&#8226;selecciones la opcion de venta.</p>
      <p>&#8226;de clic sobre el boton busqueda</p>
    </div>
  <div class="col-md-12" id="resultados" style="display:none;"> 
    
  </div>

  </div>



