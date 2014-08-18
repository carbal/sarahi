<div class="col-md-8 col-md-offset-2">
		
			
	<?if(count($ventas)>0):?>
	<?
	//declaramos el contador
	$total   = 0;
	$iva     = 0;
	$importe = 0;
	?>
	
	<div class="panel panel-primary">
		<div class="panel-heading"><h5>Resultados....</h5></div>

		<table class="table table-bordered">
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>SKU</th>
				<th>UNIDADES</th>
				<th>TOTAL</th>
				<th>IVA</th>
				<th>IMPORTE</th>
			</tr>
			<?foreach ($ventas  as $venta):?>
				<?$total+=$venta['TOTAL'];
				  $iva+=$venta['IVA'];
				  $importe+=$venta['IMPORTE']
				?>
				<tr>
					 <td><?=$venta['DESCRIPCION']?></td>
					 <td><?=$venta['SKU']?></td>
					 <td><?=$venta['UNIDADES']?></td>
					 <td><?=$venta['TOTAL']?></td>
					 <td><?=$venta['IVA']?></td>
					 <td><?=$venta['IMPORTE']?></td>		 
				</tr>
			<?endforeach;?>
			<tr>
				<td colspan="6"><p class="text-info text-center"><strong>Informe de ventas totales:</strong></p></td>
			</tr>
			<tr class="success">
				<td><strong>TOTAL:</strong></td>
				<td><?=$total?></td>
				<td><strong>IVA:</strong></td>		
				<td><?=$iva?></td>
				<td><strong>IMPORTE:</strong></td>		
				<td><?=$importe?></td>
			</tr>
		</table>
	</div>
<?else:?>
<div class="alert alert-danger">
<h5>No existen resultados para esta busqueda, verifique sus parámetros</h5>
</div>

<?endif;?>
		
</div>