<div class="table-responsive">
<table class="table table-hover" id="lista">
	<tr>
		<th>Descripción</th>
		<th>SKU</th>
		<th>Precio</th>
		<th>Cantidad</th>
		<th>Total</th>
		<th>Acciones</th>
	</tr>
	<?foreach($detalles as $detalle):?>
	<tr class="<?=$detalle['sku']?>">
		<td><?=$detalle['describe']?></td>
		<td><?=$detalle['sku']?></td>
		<td><?=$detalle['precio']?></td>
		<td><?=$detalle['cantidad']?></td>
		<td><?=$detalle['total']?></td>
		<td><img src="<?=base_url()?>img/delete.png" id="<?=$detalle['sku']?>" class="delete" style="cursor:pointer;"></td>
	</tr>
	<?endforeach;?>
	<?if($importe):?>
	<tr>
		<?
		$iva=$importe*0.16;
		$totales=$importe+$iva;
		?>
		<td><strong>Total :</strong></td>
		<td><?=$importe?></td>
		<td><strong>I.V.A :</strong></td>
		<td><?=$iva?></td>
		<td><strong>Importe :</strong></td>
		<td><?=$totales?></td>
	</tr>
		<?endif;?>
</table>
</div>