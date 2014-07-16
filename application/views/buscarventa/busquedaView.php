<div class="col-md-8 col-md-offset-2">
		
			
	<?if(count($query)>0):?>
	<?
	//declaramos el contador
	$totales=0;
	?>
	
	<div class="panel panel-primary">
		<div class="panel-heading"><h5>Resultados de la busqueda....</h5></div>

		<table class="table table-bordered">
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>SKU</th>
				<th>UNIDADES</th>
				<th>TOTAL</th>
				<th>IVA</th>
				<th>IMPORTE</th>
			</tr>
			<?foreach ($query as $fila):?>
				<tr>
			 <?foreach($fila as $campo):?>
			 		<td><?=$campo?></td>
			 <?endforeach;?>
				</tr>
				<?
				$totales+=$fila['TOTAL'];
				?>
			<?endforeach;?>
			<?
			if($this->session->userdata('idzona') == 2)
				$iva = $totales * IVA_FRONTERA;
			else
				$iva = $totales * IVA_NORMAL;

			$importe=$iva+$totales;

			?>
			<tr>
				<td colspan="6"><p class="text-info text-center"><strong>Informe de ventas totales:</strong></p></td>
			</tr>
			<tr class="success">
				<td><strong>TOTAL:</strong></td>
				<td><?=$totales?></td>
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