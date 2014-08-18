<?if(count($clientes) > 0):?>

	<?foreach($clientes as $cliente):?>
	<div class="opciones" id="<?=$cliente['rfc']?>" table="clientes"><?=$cliente['nombre']?></div>
	<?endforeach;?>

<?elseif(count($vendedores)>0):?>

	<?foreach($vendedores as $vendedor):?>
	<div class="opciones" id="<?=$vendedor['id_usuario']?>" table="vendedor"><?=$vendedor['nombres']." ".$vendedor['apellidos']?></div>
	<?endforeach;?>

<?elseif(count($zonas)>0):?>

	<?foreach($zonas as $zona):?>
	<div class="opciones" id="<?=$zona['id_zona']?>" table="zona"><?=$zona['zona']?></div>
	<?endforeach;?>

<?elseif(count($cadenas)>0):?>

	<?foreach($cadenas as $cadena):?>
	<div class="opciones" id="<?=$cadena['id_cadena']?>" table="cadena"><?=$cadena['cadena']?></div>
	<?endforeach;?>

<?endif;?>

