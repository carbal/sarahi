<script type="text/javascript">
	var usuario = function(){
		this.data = {};
		this.id;
		this.setData = function(obj){
			this.data = obj;
		}
		this.trigger = function(id){
			this.id = id;
		}
		this.insert = function(){
			document.getElementById(this.id).onclick = this.onInsert;

			
		}
		this.onInsert = function(){

			$.ajax({
				url:"<?=base_url()?>index.php/usuarios/validar",
				type:'POST',
				dataType:'json',
				data:$('form#usuario').serialize()
			})
			.done(function(data){
				if(data.success){
                    //escondemos el div con msj de error
                    $("#container-errores").slideUp('slow');                        
                    //vaciamos el formulario
                    $('form#usuario').each(function() {
                        this.reset();
                    });
                    //mostramos msj de exito                            
                    $("div#insert").slideDown('slow');
				}else{
					$('.alert-info').fadeOut('slow');
                    $("div#container-errores").hide('slow',function(){
                        $(this).slideDown('slow');
                    	$("#errores").html(data.html);
                    });                            
					
				}
			})
			.fail(function(data){
				console.log(data);
			});
			 
		}

		this.update =  function(){
			document.getElementById(this.id).onclick = this.onUpdate;
			for(i in this.data){
				$("[name='"+i+"']").prop('value',this.data[i]);
			}
			$("[name='pass2']").prop('value',this.data.password);
			$('legend').html('Actualizar Usuario')
			$('form#usuario').append($('<input/>',{
				type:'hidden',
				name:'id_usuario',
				value:this.data.id_usuario
			}));
		}

		this.onUpdate = function(){
			$.ajax({
				url: '<?=base_url()?>index.php/usuarios/validar',
				type: 'POST',
				dataType: 'json',
				data:$('form').serialize(),
			})
			.done(function(data) {
				if (data.success) {
					//escondemos el div con msj de error
                    $("#container-errores").slideUp('slow');                        
                    //vaciamos el formulario
                    $('form#usuario').each(function() {
                        this.reset();
                    });
                    //mostramos msj de exito                            
                    $("div#update").slideDown('slow');

				}else{
					$('.alert-info').fadeOut('slow');
                    $("div#container-errores").hide('slow',function(){
                        $(this).slideDown('slow');
						$("#errores").html(data.html);
                    });    
				}
			})
			.fail(function(data) {
				console.log(data);
			});
			
		}

	}

	<?if(isset($usuario)):?>
		var user = new usuario;
		user.setData(<?=json_encode($usuario)?>);
		user.trigger('add_usuario');
		user.update();
	<?else:?>
		var user = new usuario;
		user.trigger('add_usuario');
		user.insert();
	<?endif;?>
</script>