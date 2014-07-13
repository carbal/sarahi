<script type="text/javascript">
	var producto  = function(){
		this.data = {};
		this.id = '';

		this.trigger = function(id){
			this.id = id;
		}
		this.setData = function(obj){
			this.data = obj;
		}
		this.insert =  function(){
			document.getElementById(this.id).onclick = this.onInsert;
		}

		this.onInsert = function(){
			$.ajax({
				url: '<?=base_url()?>index.php/productos/insert',
				type: 'POST',
				dataType: 'json',
				data: $('form#producto').serialize()
			})
			.done(function(data) {
				if(data.success) {
					//ocultar msj de errores
	                $("#container-errors").slideUp('slow');
	                //mostrar msj de exito
	                $('div#insert').show('slow');
                    //vaciar formulario
                    $("form#producto").each(function() {
                        this.reset();
                    });

				}else{
					$(".alert-info").fadeOut('slow');
                    $('div#container-errors').hide('slow',function(){
                        $(this).slideDown('slow');
                        $('div#errors').html(data.html);
                    });   

				}
			})
			.fail(function(data) {
				console.log(data);
			});
			
		}

		this.update = function(){
			document.getElementById(this.id).onclick =  this.onUpdate;
			$("[name='sku']").parents('.form-group').remove(); //eliminamos de la vista
			$('legend').html('Actualizar Producto');
			for(i in this.data){
				$("[name='"+i+"']").prop('value',this.data[i]);
			}
			$('form#producto').append($('<input/>',{
				type:'hidden',
				name:'sku',
				value:this.data.sku
			}));
		}

		this.onUpdate = function(){
			$.ajax({
				url: '<?=base_url()?>index.php/productos/update',
				type: 'POST',
				dataType: 'json',
				data: $('form#producto').serialize()
			})
			.done(function(data){
				if(data.success){
					//ocultar msj de errores
	                $("#container-errores").slideUp('slow');
	                //mostrar msj de exito
	                $('div#update').show('slow');
                    //vaciar formulario
                    $("form#producto").each(function() {
                        this.reset();
                    });

				}else{

					$(".alert-info").fadeOut('slow');
                    $('div#container-errors').hide('slow',function(){
                        $(this).slideDown('slow');
                        $('div#errors').html(data.html);
                    });   
				}
			})
			.fail(function(data) {
				console.log(data);
			});
		}
	}

	<?if(isset($producto)):?>
		var obj = new producto;
		obj.trigger('add_producto');
		obj.setData(<?=json_encode($producto)?>);
		obj.update();
	<?else:?>
		var obj  = new producto;
		obj.trigger('add_producto');
		obj.insert();
	<?endif;?>
</script>