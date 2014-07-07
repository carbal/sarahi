<script type="text/javascript">
	
	var devolucion = function(){
		this.trigger = 'search';
		this.upDatePicker = function(){
			$("[name='fechaini']").datepicker();
			$("[name='fechafin']").datepicker();
		}
		
		this.search = function(){

			document.getElementById(this.trigger).onclick = function(){

				$.ajax({
					url: '<?=base_url()?>index.php/devoluciones/getfecha',
					type: 'POST',
					dataType: 'json',
					beforeSend:function(){loading(true);},
					data:$('form#devolucion').serialize()
				})
				.done(function(data){
					if(data.success){
						$('#container').html(data.html);
						$('#container-errors').slideUp('slow');
					}else{
						$('#container-errors').slideUp('slow',function(){
							$(this).slideDown('slow');
							$('#errors').html(data.html);
						});
					}
					loading(false);			
				})
				.fail(function(data) {
					console.log(data);
					loading(false);
				});
				
			}
		}

		this.describe = function(){
			$('#container').on('click','#describe' ,function(){
				$.ajax({
					url: '<?=base_url()?>index.php/devoluciones/getdescribe',
					type: 'POST',
					dataType: 'json',
					beforeSend:function(){loading(true)},
					data:{id:$(this).attr('idx')}
				})
				.done(function(data){
					if(data.success){
						$('#modalDevolucion').html(data.html);
						$('#modalDevolucion').modal();
					}
					loading(false);
				})
				.fail(function(data){
					console.log(data);
					loading(false);
				});
			});
		}
	}

	var obj = new devolucion;
	obj.upDatePicker();
	obj.search();
	obj.describe();

</script>