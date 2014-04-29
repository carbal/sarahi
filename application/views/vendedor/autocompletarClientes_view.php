<?if(count($clientes)>0):?>
<?foreach($clientes as $cliente):?>
<div class="opcion_cliente" id="<?=$cliente['rfc']?>"><?=$cliente['nombre']?></div>
<?endforeach;?>
<?else:?>
<div>No existen coincidencias.</div>
<?endif;?>
