<?if(sizeof($usuarios) > 0):?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h5 class="panel-title">DETALLE DE USUARIOS - VENTA/ABONO</h5>
	</div>
	<table class="table table-condensed">
		<thead>
			<th>VENDEDOR</th>
			<th>VENTA</th>
			<th>ABONO</th>
		</thead>
		<tbody>
			<?foreach($usuarios as $usuario):?>
				<td><?=$usuario['vendedor']?></td>
				<td><span class="label label-info"><?=$usuario['venta']?></span></td>
				<td><span class="label label-danger"><?=$usuario['abono']?></span></td>
			<?endforeach;?>
		</tbody>
	</table>
</div>
<?else:?>
	<div class="alert alert-danger">No existen resultados....</div>
<?endif;?>