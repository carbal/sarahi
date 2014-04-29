<?if(count($cadenas)>0):?>

<?foreach($cadenas as $cadena):?>
<div class="opcion_abono" id="<?=$cadena['id_cadena']?>" table="cadena"><?=$cadena['cadena']?></div>
<?endforeach;?>

<?elseif(count($clientes)>0):?>

<?foreach($clientes as $cliente):?>
<div class="opcion_abono" id="<?=$cliente['rfc']?>" table="clientes"><?=$cliente['nombre']?></div>
<?endforeach;?>

<?else:?>
<strong>No existen coincidencias</strong>
<?endif;?>

