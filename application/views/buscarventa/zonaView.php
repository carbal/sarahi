
<div class="col-md-8 col-md-offset-2">

	<?if(count($query)>0):?>
<table class="table table-bordered">
	<tr class="success">
		<th>IMPORTE</th>
		<th>CLIENTE</th>
		<th>VENDEDOR</th>
		<th>FECHA</th>
		<th>TIPO</th>
		<th>ESTADO</th>
		<th>OTROS</th>		
	</tr>
	<?foreach($query as $fila):?>
	<tr>
		<td><?=$fila['importe']?></td>
		<td><?=$fila['cliente']?></td>
		<td><?=$fila['vendedor']?></td>
		<td><?=$fila['fecha']?></td>
		<?if($fila['tipo']==1):?>
		<td><span class="label label-success">Efectivo</span></td>
		<?else:?>
		<td><span class="label label-warning">Credito</span></td>
		<?endif;?>
		<?if($fila['estado']==1):?>
		<td><span class="label label-success">Terminado</span></td>
		<?else:?>
		<td><span class="label label-danger">En Proceso</span></td>
		<?endif;?>
		<td class="text-center"><img src="<?=base_url()?>img/info.png" id="<?=$fila['id_venta']?>" title="información" class="info"></td>
	</tr>
	<?endforeach;?>
</table>
<?=$page?>
<?else:?>
<div class="alert alert-danger">
	<h5>No existen resultados para sus parametros de busqueda, intente con otras opciones...</h5>
</div>
<?endif;?>
</div>
