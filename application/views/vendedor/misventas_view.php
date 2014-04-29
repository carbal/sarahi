
<br>
<br>
<div class="col-md-8 col-md-offset-2" id="contenedor-ventas">
	<div class="table-responsive">
	<table class="table">
		<tr>
			<th>CLIENTE</th>
			<th>TOTAL</th>
			<th>IVA</th>
			<th>IMPORTE</th>
			<th>FECHA</th>
			<th>TIPO</th>
			<th>ESTADO</th>
			<th>ACCIONES</th>
		</tr>
			<?foreach($query as $fila):?>
		<tr>
			<td><?=$fila['nombre']?></td>
			<td><?=$fila['total_venta']?></td>
			<td><?=$fila['iva_venta']?></td>
			<td><?=$fila['importe']?></td>
			<td><?=$fila['fecha']?></td>
			<?if($fila['tipo_venta']==1):?>
			<td><span class="label label-success">Efectivo</span></td>
			<td><span class="label label-success">Terminado</span></td>
			<td class="text-center" colspan="2"><a><img class="info" id="<?=$fila['id_venta']?>" src="<?=base_url()?>img/paperclip.png" title="detalles"></a></td>
			<?else:?>
			<td><span class="label label-warning">Credito</span></td>
			<?if($fila['estado']==1):?>
			<td><span class="label label-success">Terminado</span></td>
			<?else:?>
			<td><span class="label label-danger">En Proceso</span></td>
			<?endif;?>
			<td class="text-center">
				<a><img class="info" id="<?=$fila['id_venta']?>" src="<?=base_url()?>img/paperclip.png" title="detalles"></a>				
				&nbsp&nbsp
				<!--<a href="<?=base_url().'index.php/abono/addabono/'.$fila['id_venta'];?>"><img src="<?=base_url()?>img/add.png" title="abonar"></a>
				-->
			</td>
			<?endif;?>


			
		</tr>
			<?endforeach;?>


	</table>
</div>
	<div class="text-center">
	<?=$paginacion?>
	</div>
	<div class="modal fade" id="info_venta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Información sobre la venta</h4>
      </div>
      <div class="modal-body">
        
      </div>     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
										

</div>