<div class="container">
    <div class="col-md-12" id="centro">
        <div class="jumbotron text-center">
                <?if($existencias):?>
                    <div class="alert alert-danger">
                       <h5>Urgente: verifique que los almacenes no este por debajo del stock minimo. <strong><a href="">Información</a></strong></h5>
                    </div>
                <?endif;?>
            <h1>
                Galletas Integrales Sariah 
            </h1>
            <small>Tizimín, Yucatan.</small>
            <p>Desde 1990</p>
            <p class="text-info">Sistema de Ventas en linea</p>
            <p class="text-success">Bienvenido: <?=$this->session->userdata('usuario')." ".$this->session->userdata('apellido');?></p>
            <button class="btn btn-success btn-lg">Visitar</button>
        </div>
   </div>
</div>