<div class="input-group input-group-sm col-md-4 col-md-offset-4">
 	<span class="input-group-btn"><button class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span></button></span>
	<input type="text" class="form-control" placeholder="filtrar cadena" onkeypress="filterTable(this.value,'.table')">
</div>
	<br>
	<br>
	<br>
	<br>
<div class="col-md-8 col-md-offset-2">
	<table class="table table-condensed">
		<tr>
			<th>CLAVE</th>
			<th>CADENA</th>
			<th>ZONA</th>
			<th>REPRESENTANTE</th>
			<th>TELEFONO</th>
			<th>ACCIONES</th>
		</tr>
		<?foreach($cadenas as $cadena):?>
			<tr>
				<td><?=$cadena['id_cadena']?></td>
				<td><?=$cadena['cadena']?></td>
				<td><?=$cadena['id_zona']?></td>
				<td><?=$cadena['representante']?></td>
				<td><?=$cadena['telefono']?></td>
				<td style="text-align:center;"><a href="<?=base_url()?>index.php/cadenas/formCadena/<?=$cadena['id_cadena']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
			</tr>
		<?endforeach;?>
	</table>
</div>