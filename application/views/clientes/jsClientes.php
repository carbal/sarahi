 <script type="text/javascript">
    var cliente =  function(){
       
        this.data ={};
        this.trigger = new Object();
        this.request = {};
        this.insert = function(){
           
            $.ajax({
                url: '<?=base_url()?>index.php/clientes/validar',
                type: 'POST',
                dataType: 'json',
                data:$('form#cliente').serialize()
            })       
            .done(function(data) {
               if(data.success){

                    $('div#insert').show('slow',function(){
                        $('div#container-errors').slideUp('slow');
                    });
                    //vaciamos el formulario
                     $("form#cliente").each(function(){
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

        this.setData = function(obj){
            this.data = obj;
        }
        this.update = function(){
            $.ajax({
                url:'<?=base_url()?>index.php/clientes/update',
                type:'POST',
                dataType:'json',
                data:$('form#cliente').serialize()

            })
            .done(function(data){
                if(data.success){
                    $('div#update').show('slow',function(){
                        $('div#container-errors').slideUp('slow');
                    });
                    //vaciamos el formulario
                     $("form#cliente").each(function(){
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
            .fail(function(data){
                console.log(data);
            });


        }
        this.setInsert =  function(id){
            document.getElementById(id).onclick = this.insert;
        }
        this.setUpdate =  function(id){
            document.getElementById(id).onclick = this.update;
            $('form#cliente').append($('<input/>',{
                type:'hidden',
                name:'rfc',
                value:this.data.rfc
            }));
            $('input[name=rfc]').parents('.form-group').remove();
            this.insertData();
        }
        this.insertData =  function(){
            for(var i in this.data){
                $('[name='+i+']').prop('value',this.data[i]);
            }
        }
    }

    <?if(isset($cliente)):?>
        var obj = new cliente;
        obj.setData(<?=json_encode($cliente)?>);
        obj.setUpdate('add_cliente');
    <?else:?>
        var obj  = new cliente;
        obj.setInsert('add_cliente');
    <?endif;?>
 </script>
