<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-tittle">Ultimas devoluciones</h4>
		</div>
		<table class="table table-hover">
			<tr>
				<td>VENDEDOR</td>
				<td>CLIENTE</td>
				<td>ZONA</td>
				<td>SKU</td>
				<td>DESCRIPCION</td>
				<td>CANTIDAD</td>
				<td>FECHA</td>
			</tr>
				<?foreach($devoluciones as $devolucion):?>
			<tr>
				<td><?=$devolucion['vendedor']?></td>
				<td><?=$devolucion['cliente']?></td>
				<td><?=$devolucion['zona']?></td>
				<td><?=$devolucion['sku']?></td>
				<td><?=$devolucion['descripcion']?></td>
				<td><?=$devolucion['cantidad']?></td>
				<td><?=$devolucion['fecha']?></td>				
			</tr>
				<?endforeach;?>
		</table>
	</div>
</div>