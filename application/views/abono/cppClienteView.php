<div class="col-md-8 col-md-offset-2">
	
<?if(count($query)>0):?>
	<table class="table">
		<tr class="success">
			<th>TOTAL</th>
			<th>IVA</th>
			<th>IMPORTE</th>
			<th>VENDEDOR</th>			
			<th colspan="2">ACCIONES</th>
		</tr>
		<?foreach($query as $fila):?>
		<tr>
		<td><?=$fila['total']?></td>
		<td><?=$fila['iva']?></td>
		<td><?=$fila['importe']?></td>
		<td><?=$fila['vendedor']?></td>		
		<td><img src="<?=base_url()?>img/info.png" id="<?=$fila['id_venta']?>" title="información" class="info"></td>
		<td><a href="<?=base_url()?>index.php/abono/addabono/<?=$fila['id_venta']?>/"><img src="<?=base_url()?>img/currency_usd.png" id="<?=$fila['id_venta']?>" title="abonar" class="abonar"></a></td>
		</tr>
		<?endforeach;?>		
	</table>
	<?=$page?>
<?else:?>
<div class="alert alert-danger">
	<h5>El cliente no tiene cuentas por pagar pendientes</h5>
</div>
<?endif;?>
</div>