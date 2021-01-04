<?php
sleep(1);
require_once('config.php');

$utimoId = $_REQUEST['utimoId'];
$limite  = 5;

$sqlComentLimit     = ("SELECT * FROM comentarios WHERE id < '" .$utimoId . "' ORDER BY id DESC LIMIT  ".$limite." ");
$resultComentLimit  = mysqli_query($con, $sqlComentLimit);
$totalRegist        = mysqli_num_rows($resultComentLimit);

while ($dataComent = mysqli_fetch_assoc($resultComentLimit))
 {   ?>

    <div class="row border_special item-comentario" id="<?php echo $dataComent['id']; ?>">
            
            <div class="col-md-2 col-sm-12">
                 <div id="imgperfil">
                    <img src="fotosPerfil/<?php echo $dataComent['imagen'];?>" alt="">
                </div>
            </div> 

            <div class="col-md-10 text-center marb-35">
                <div class="contenidouser">
                    <h4><?php echo $dataComent['titulo'];?></h4>
                    <p><?php   echo $dataComent['contenido'];?></p>
                    <span><?php echo $dataComent['fecha'];?></span>
                </div>
            </div> 
        </div>

    <?php
 }
 
 if ($totalRegist < $limite) { ?>

    <div class="col-md-12 col-sm-12">
        <h4>No hay más Registros ...</h4>
    </div>
    
<?php }else{ ?>

<div class="col-md-12 col-sm-12">
    <div class="ajax-loader text-center">
        <img src="imgs/cargando.svg">
            <br>
         Cargando más Registros...
    </div>
</div>
<?php } ?>

