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
				<td><?=$usuario['id_zona']?></td>
				<td><?=$usuario['domicilio']?></td>
				<td style="text-align:center;"><a href="<?=base_url()?>index.php/usuarios/formUsuario/<?=$usuario['id_usuario']?>"><span class="glyphicon glyphicon-pencil" style="cursor:pointer;"></span></a></td>
			</tr>
		<?endforeach;?>
	</table>
</div>