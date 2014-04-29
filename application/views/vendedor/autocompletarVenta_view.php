<?if(count($clientes)>0):?>
<?foreach($clientes as $cliente):?>
<a href="<?=base_url()?>index.php/vendedor/busquedaCliente/<?=$cliente['rfc']?>"><p><?=$cliente['nombre']?></p></a>
<?endforeach;?>
<?else:?>
<p>No existen coincidencias</p>
<?endif;?>