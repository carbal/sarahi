<div class="col-md-8 col-md-offset-2" style="margin-bottom:2em;">
	<form action="" method="POST" class="form-inline" role="form" id="devolucion">
		<button type="button" class="btn btn-primary pull-right" id="search"><span class="glyphicon glyphicon-search"></span></button>
		<div class="form-group pull-right">
			<input type="text" class="form-control" name="fechafin"  placeholder="fecha fin">
		</div>
		<div class="form-group pull-right">
			<input type="text" class="form-control" name="fechaini"  placeholder="fecha">
		</div>
	</form>
</div>
<div class="col-md-8 col-md-offset-2">
	<div class="alert alert-danger" id="container-errors" style="display:none;">
		<p><strong>AVISO:</strong>Verifique los siguientes errores.<span class="glyphicon glyphicon-remove pull-right"></span></p>
		<br>
		<div id="errors"></div>
	</div>
</div>

<div class="col-md-8 col-md-offset-2" id="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h5>ULTIMAS DEVOLUCIONES</h5>
		</div>
		<table class="table table-hover">
			<tr>
				<th>VENDEDOR</th>
				<th>CLIENTE</th>
				<th>ZONA</th>
				<th>DESCRIPCION</th>
				<th>CANTIDAD</th>
				<th>FECHA</th>
				<th>ACCIONES</th>
			</tr>
				<?foreach($devoluciones as $devolucion):?>
					<tr>
						<td><?=$devolucion['vendedor']?></td>
						<td><?=$devolucion['cliente']?></td>
						<td><?=$devolucion['zona']?></td>
						<td><?=$devolucion['descripcion']?></td>
						<td><?=$devolucion['cantidad']?></td>
						<td><?=$devolucion['fecha']?></td>
						<td style="text-align:center;"><span class="glyphicon glyphicon-search pointer" id="describe" idx="<?=$devolucion['id_devolucion']?>"></span></td>				
					</tr>
				<?endforeach;?>
		</table>
	</div>
</div>
<?if(isset($js)):?>
	<?=$js?>
<?endif;?>
<div class="modal fade" id="modalDevolucion" style="text-transform:uppercase;">
</div>
