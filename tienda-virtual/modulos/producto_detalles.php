<?php
global $mysqli;
$idproducto = $_GET['idproducto'];
  $strsql = "SELECT `idproducto`, `nombre_producto`, `descripcion`, `precio`,
  `cantidad`, `url_imagen` FROM `productos` WHERE idproducto=? ";
  if ($stmt = $mysqli->prepare($strsql)) {
    $stmt->bind_param("i", $idproducto);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idproducto, $nombre_producto, $descripcion, $precio, $cantidad, $url_imagen);
        $stmt->fetch();
    } else {
      echo "No hay datos para mostrar";
    }

  } else {
    echo "No se pudo preparar el parametro";
  }

?>

<div class="container">
  
  
</div>
<div class="container">
  <img class="background-logo" src="app/img/apple-logo-1.png" alt="">
  <div class="row">
    <div class="col l6 m6 s12 center">
      <div class="wbox-prod">
        <img class="responsive-img" src="<?php echo $url_imagen ?>" alt="">
      </div>
    </div>
    <div class="col l6 m6 s12 ">
      <h4><?php echo $nombre_producto ?></h4>
      Descripcion del producto: <b><span><?php echo $descripcion ?></span></b></br>
      Cantidad en existencia: <b><span><?php echo $cantidad ?></span></b></br>
      <h5>Precio: <b><?php echo "$" .number_format($precio) ?></b></h5>
      <a href="javascript:agregar_a_bag(<?php echo $idproducto ?>)" class="blue darken-2 btn"><i class="material-icons left">add_shopping_cart</i>Add to bag</a>
      

    </div>

  </div>
</div>

<script>

function agregar_a_bag(idproducto) {
  {     var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=agregar_a_carrito';
        var data = {          
        }
        var body = {"idproducto":  idproducto};
        console.log(JSON.stringify(body));
        console.log(body);
        fetch(url, 
        {
          method: 'POST',
          body: JSON.stringify(body)
        })
        .then((response) => response.json())
        .then((data) => {
          M.toast({html: data.text})

        })
        .catch(console.error)
        
        return false;

      }

}


</script>