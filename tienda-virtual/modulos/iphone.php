<?php
global $mysqli;
?>

<div class="container">
  <div class="wbox-large">
    <img class="responsive-img" src="app/img/applewatch-header.jpg" alt="">

  </div>

</div>

<div class="container row center">
  <video class="responsive-video" controls autoplay muted>
      <source src="app/img/home-video.mp4" type="video/mp4">
  </video>
</div>


<div class="container">
  <div>
            <h5><b>iPhone </b><span>&#9679; This Changes Everything </span></h5>
            <div class="row center">
              <?php
              $strsql = "SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`,
              `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` WHERE idcategoria=2";
              if($stmt = $mysqli->prepare($strsql)) {
                  $stmt->execute();
                  $stmt->store_result();
                  if ($stmt->num_rows > 0) {
                    $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $cantidad, $url_imagen, $fecha_creacion);
                    while($stmt->fetch()){
                      ?>
                        
                        <a href="?modulo=producto_detalles&idproducto=<?php echo $idproducto ?>">
                          <div class="col s12 m6 l4">
                            <div class="wbox-applewatch">
                              <div><img  src="<?php echo $url_imagen ?>" alt=""></div>
                              <div>
                              <h6><?php echo $nombre_producto ?></h6>
                              </div>
                              <div>
                                <h6><?php echo "$" .number_format($precio) ?></h6>
                              </div>
                            </div>

                          </div>
                          
                        </a>  
                    <?php
                    }
                  } else {
                    echo "no hay datos para mostrar";
                  }
              } else {
                echo "Error al preparar la consulta";
              }

              ?></a>
            </div>
            
      </div>


</div>
