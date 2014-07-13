<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h5 class="modal-title">EDITAR STOCK DEL ALMACEN</h5>
		</div>
		<div class="modal-body">
			<form class="form form-horizontal col-md-offset-2" id="formProducto" >
				<div class="form-group">
					<label for="" class="control-label col-md-3">Stock Min : </label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="stock_min" value="<?=$producto['stock_min']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-3">Stock Max : </label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="stock_max" value="<?=$producto['stock_max']?>">
					</div>
				</div>
				<input type="hidden" value="<?=$producto['id_proalmacen']?>">
			</form>
		</div>
		<div class="modal-footer">
			<input type="button" class="btn btn-primary"  onclick="almacen.updateProducto()" value="Editar">
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

