<div class="input-group input-group-sm col-md-4 col-md-offset-4">
  <span class="input-group-btn"><button class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span></button></span>
  <input type="text" class="form-control" placeholder="filtrar usuario..." onkeypress="filterTable(this.value,'.table')">
</div>
<br>
<br>
<br>
<div class="col-md-8 col-md-offset-2">
	<table class="table table-condesed">
		<tr>
			<th>CLAVE</th>
			<th>NOMBRES</th>
			<th>APELLIDOS</th>
			<th>ZONA</th>
			<th>DOMICILIO</th>
			<th>ACCIONES</th>
		</tr>
		<?foreach($usuarios as $usuario):?>
			<tr>
				<td><?=$usuario['id_usuario']?></td>
				<td><?=$usuario['nombres']?></td>
				<td><?=$usuario['apellidos']?></td>
				<td><?=getZona($usuario['id_zona'])?></td>
				<td><?=$usuario['domicilio']?></td>
				<td style="text-align:center;"><a href="<?=base_url()?>index.php/usuarios/formUsuario/<?=$usuario['id_usuario']?>"><span class="glyphicon glyphicon-pencil" style="cursor:pointer;"></span></a></td>
			</tr>
		<?endforeach;?>
	</table>
</div>