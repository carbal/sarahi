<div class="col-md-8 col-md-offset-2" >
  <div class="alert alert-danger" style="display:none;" id="container-errores">
    <p><strong>AVISO : </strong> Verifique los siguientes errores.</p>
    <br>
    <div id="errores">
      
    </div>
    
  </div>
	<div class="alert alert-success">
	<form class="form-inline" role="form" id="search">		
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

  &nbsp&nbsp&nbsp
  <div class="form-group">    
  <button type="button" class="form-control btn btn btn-primary" id="detalle" title="buscar">&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-search"></span>&nbsp&nbsp&nbsp</button>
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
  <div class="col-md-12" id="resultados"> 
    
  </div>

  </div>

  <div class="modal fade" id="info_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Información sobre la venta</h4>
      </div>
      <div class="modal-body">
                
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


