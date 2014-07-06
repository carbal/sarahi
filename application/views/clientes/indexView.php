
	<div class="input-group input-group-sm col-md-4 col-md-offset-4">
	  <span class="input-group-btn"><button class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span></button></span>
	  <input type="text" class="form-control" placeholder="buscar...">
	</div>
	<br>
	<br>
	<br>
	<br>
<div class="col-md-8 col-md-offset-2">
	<table class="table table-condensed" style="font-size:0.85em;">
		<tr>
			<th>CLIENTE</th>
			<th>RFC</th>
			<th>DIRRECCIÓN</th>
			<th>COLONIA</th>
			<th>PAIS</th>
			<th>CONTACTO</th>
			<th colspan="2">ACCIONES</th>		
		</tr>
		<?foreach($clientes as $cliente):?>
		<tr>
			<td><?=strtoupper($cliente['nombre'])?></td>
			<td><?=strtoupper($cliente['rfc'])?></td>
			<td><?=strtoupper($cliente['calle'])?></td>
			<td><?=strtoupper($cliente['colonia'])?></td>
			<td><?=strtoupper($cliente['pais'])?></td>
			<td><?=strtoupper($cliente['correo'])?></td>
			<td class="text-center">
			<a href="<?=base_url()?>index.php/clientes/formCliente/<?=$cliente['rfc']?>"><span class="glyphicon glyphicon-pencil" style="cursor:pointer;"></span></a></td>
			<td class="text-center"></td>
		</tr>
		<?endforeach;?>
	</table>
</div>