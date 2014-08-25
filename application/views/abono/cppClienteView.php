<div class="col-md-8 col-md-offset-2">
<?if(count($abonos) > 0):?>

<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">DETALLE DE ABONOS.</div>
	<table class="table">
		 <thead>
			<tr>
				<th>TOTAL</th>
				<th>IVA</th>
				<th>IMPORTE</th>
				<th>VENDEDOR</th>
				<th colspan="2">ACCIONES</th>
			</tr>
		 </thead>
		 <tbody>
			<?foreach($abonos as $abono):?>
				<tr>			
					<td><?=$abono['total']?></td>
					<td><?=$abono['iva']?></td>
					<td><?=$abono['importe']?></td>
					<td><?=$abono['vendedor']?></td>
					<td><img src="<?=base_url()?>img/info.png" id="<?=$abono['id_venta']?>" title="información" class="info"></td>
					<td><a href="<?=base_url()?>index.php/abono/addabono/<?=$abono['id_venta']?>/"><img src="<?=base_url()?>img/currency_usd.png" id="<?=$abono['id_venta']?>" title="abonar" class="abonar"></a></td>
				</tr>
			<?endforeach;?>
		 </tbody>
		</table>
		
</div>
	<?=$page?>
<?else:?>
	<div class="alert alert-danger">
		<h5>No existen clientes con cuentas por pagar para esta cadena</h5>
	</div>
<?endif;?>
</div>