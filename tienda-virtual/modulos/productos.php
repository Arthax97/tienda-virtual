<?php
global $mysqli;
?>



<div class="container">

    <div>
            <h5><b>iPad</b></h5>
            <div class="row center">
              <?php
              $strsql = "SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`,
              `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos`  LIMIT 4";
              if($stmt = $mysqli->prepare($strsql)) {
                  $stmt->execute();
                  $stmt->store_result();
                  if ($stmt->num_rows > 0) {
                    $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $cantidad, $url_imagen, $fecha_creacion);
                    while($stmt->fetch()){
                      ?>
                        
                        <a href="?modulo=producto_detalles&idproducto=<?php echo $idproducto ?>">
                          <div class="col s12 m6 l3">
                            <div class="wbox">
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


      <div>
        <h5><b>Macbook</b></h5>
        <div class="row center">
          <?php
          $strsql = "SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`,
          `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` WHERE idcategoria = 1 LIMIT 2  ";
            if($stmt = $mysqli->prepare($strsql)){
              $stmt->execute();
              $stmt->store_result();
              if ($stmt->num_rows > 0) {
                $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $cantidad, $url_imagen, $fecha_creacion);
                while($stmt->fetch()) {
                  ?>

                    <a href="?modulo=producto_detalles&idproducto=<?php echo $idproducto ?>">
                      <div class="col s12 m6 l6">
                        <div class="wbox">
                          <div><img  src="<?php echo $url_imagen?>" alt=""></div>
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
              ?>
          
        </div>
      </div>


      <div>
        <h5><b>iPhone</b></h5>
        <div class="row center">
        <?php
          $strsql = "SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`,
          `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` WHERE idcategoria = 2 LIMIT 4  ";
            if($stmt = $mysqli->prepare($strsql)){
              $stmt->execute();
              $stmt->store_result();
              if ($stmt->num_rows > 0) {
                $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $cantidad, $url_imagen, $fecha_creacion);
                while($stmt->fetch()) {
                  ?>
                  <a href="?modulo=producto_detalles&idproducto=<?php echo $idproducto ?>">
                      <div class="col s12 m6 l3">
                        <div class="wbox">
                          <div><img  src="<?php echo $url_imagen?>" alt=""></div>
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
              ?>
        </div>
      </div>

    

     
</div>    
