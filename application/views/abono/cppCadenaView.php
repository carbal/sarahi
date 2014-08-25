<div class="col-md-8 col-md-offset-2">
<?if(count($abonos) > 0):?>

<?=die(var_dump($abonos))?>
	<div class="panel panel-default">
		<h5 class="panel-heading">DETALLE DE ABONOS</h5>

		<table class="table table-condensed">
		 <thead>
			<tr>
				<th>TOTAL</th>
				<th>IVA</th>
				<th>IMPORTE</th>
				<th>CLIENTE</th>
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
					<td><?=$abono['cliente']?></td>
					<td><?=$abono['vendedor']?></td>
					<td><img src="<?=base_url()?>img/info.png" id="<?=$abono['id_venta']?>" title="información" class="info"></td>
					<td><a href="<?=base_url()?>index.php/abono/addabono/<?=$abono['id_venta']?>/"><img src="<?=base_url()?>img/currency_usd.png" id="<?=$fila['id_venta']?>" title="abonar" class="abonar"></a></td>
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