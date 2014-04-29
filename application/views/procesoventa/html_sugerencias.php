<?if(count($sugerencias)>0):?>
<?foreach($sugerencias as $opcion):?>
<div class="opciones" id="<?=$opcion['rfc']?>"><?=$opcion['nombre']?></div>
<?endforeach;?>
<?else:?>
<div>No existen coincidencias</div>
<?endif;?>
