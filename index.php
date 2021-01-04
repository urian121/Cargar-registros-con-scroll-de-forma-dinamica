<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Datos con Scroll usando PHP - MYSQL - AJAX - JQUERY de forma Dinamica</title>
    <link type="text/css" rel="shortcut icon" href="imgs/logo-mywebsite-urian-viera.svg"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
       <span class="navbar-brand">
          <img src="imgs/logo-mywebsite-urian-viera.svg" alt="Web Developer Urian Viera" width="120">
            Web Developer Urian Viera
      </span>
    </nav>

<br><br>
<br>  

<h3 class="text-center">Carga de Datos con Scroll usando PHP -MYSQL - AJAX - JQUERY de forma Dinamica</h3>


<div class="container" id="lista-comentarios">
    
<?php
require_once ('config.php');

$sqlQueryComentarios  = ("SELECT * FROM comentarios");
$resultComentarios    = mysqli_query($con, $sqlQueryComentarios);
$total_registro       = mysqli_num_rows($resultComentarios);

$QueryComentarios      = ("SELECT * FROM comentarios ORDER BY id DESC LIMIT 5");
$resultadoComentarios  = mysqli_query($con, $QueryComentarios);
?>

<input type="hidden" name="total_registro" id="total_registro" value="<?php echo $total_registro; ?>" />

<?php
while ($dataComentarios = mysqli_fetch_assoc($resultadoComentarios)) { ?>

<div class="row border_special item-comentario" id="<?php echo $dataComentarios['id']; ?>">
    
    <div class="col-md-2 col-sm-12">
         <div id="imgperfil">
            <img src="fotosPerfil/<?php echo $dataComentarios['imagen'];?>" alt="">
        </div>
    </div> 

    <div class="col-md-10 text-center marb-35">
        <div class="contenidouser">
            <h4><?php echo $dataComentarios['titulo'];?></h4>
            <p><?php echo $dataComentarios['contenido'];?></p>
            <span><?php echo $dataComentarios['fecha'];?></span>
        </div>
    </div> 

</div>
<?php } ?>

<div class="col-md-12 col-sm-12">
    <div class="ajax-loader text-center">
        <img src="imgs/cargando.svg">
            <br>
         Cargando más Registros...
    </div>
</div>

</div>



<script type="text/javascript">
$(document).ready(function(){
        pageScroll();
});

function pageScroll() {
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPos    = $(window).height() + $(window).scrollTop();
        console.log(scrollHeight + scrollPos );

        if((((scrollHeight - 250) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 300) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 350) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 400) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 450) >= scrollPos) / scrollHeight == 0) || (((scrollHeight - 500) >= scrollPos) / scrollHeight == 0)){
            if($(".item-comentario").length < $("#total_registro").val()) {
                var utimoId = $(".item-comentario:last").attr("id");
                console.log('ultimo Registro ' + utimoId);
                
                $(window).off("scroll");
                $.ajax({
                    url: 'obteniendoMasDatos.php?utimoId=' + utimoId,
                    type: "get",
                    beforeSend: function ()
                    {
                        $('.ajax-loader').show();
                    },
                    success: function (data) {
                        setTimeout(function() {
                            $('.ajax-loader').hide();
                            $("#lista-comentarios").append(data);
                        pageScroll(); 
                        }, 1000);
                    }
               });

            }else{
                console.log('No hay mas Registros...');
            }
        }
    });
}
</script>


</body>
</html>
