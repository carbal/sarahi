<script type="text/javascript">
	
	var cadena = function(){
		this.id = 'add_cadena';
		this.data = {};

		this.onInsert = function(){
			document.getElementById(this.id).onclick = this.insert;
		}
		this.insert = function(){

			$.ajax({
				url: '<?=base_url()?>index.php/cadenas/insert',
				type: 'POST',
				dataType:'json',
				data: $('form#cadena').serialize()
			})
			.done(function(data) {
				if(data.success){
					 $("#container-errores").slideUp('slow');
                     $("form#cadena").each(function(){
                        this.reset();
                     });
                    $("#exito").slideDown('slow');
				}else{
					$("#errores").html(data.html);
                    $("#container-errores").hide('slow',function(){
                        $(this).slideDown('slow');
                    });
				}
			})
			.fail(function(data) {
				console.log(data);
			});
		}
		this.onUpdate = function(){
			document.getElementById(this.id).onclick =this.insert;
			this.actions();
		}
		this.setData = function(data){
			this.data = data;
		}
		this.actions = function(){
			$('form#cadena').append($('<input/>',{
				type:'hidden',
				name:'id_cadena',
				value:this.data.id_cadena
			}));
			$('legend').html('Actualizar Cadena');
			for(i in this.data){
				$("[name='"+i+"']").prop('value',this.data[i]);
			}
		}
	}

	<?if(isset($cadena)):?>
		var obj =  new cadena;
		obj.setData(<?=json_encode($cadena)?>);
		obj.onUpdate();
	<?else:?>
		var obj = new cadena;
		obj.onInsert();
	<?endif;?>
</script>