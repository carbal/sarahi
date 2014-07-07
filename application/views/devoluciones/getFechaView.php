<?if(sizeof($devoluciones) > 0):?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-tittle">Resultados...</h4>
		</div>
		<table class="table table-hover">
			<tr>
				<th>VENDEDOR</th>
				<th>VENDEDOR</th>
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
				<td style="text-align:center;"><span class="glyphicon glyphicon-search pointer" id="describe" idx=<?=$devolucion['id_devolucion']?>></span></td>				
			</tr>
				<?endforeach;?>
		</table>
	</div>
<?else:?>
	<div class="alert alert-warning">
		<p>La busqueda no generó ningun <strong>resultado</strong>.</p>
	</div
<?endif;?>