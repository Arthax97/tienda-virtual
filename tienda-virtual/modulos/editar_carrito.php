
<div class="container center">
  <a href="?modulo=carrito" class="waves-effect waves-light btn green "><i class="material-icons left">keyboard_arrow_left</i>Regresar</a>
      
</div>


<?php
global $mysqli;
$idproducto = $_GET['idproducto'];
  $strsql = " SELECT p.idproducto, c.cantidad, p.nombre_producto, p.url_imagen, p.precio, c.cantidad * p.precio as total from productos as p, carrito as c where c.idusuario=0 and p.idproducto = c.idproducto; ";
  if ($stmt = $mysqli->prepare($strsql)) {
    $stmt->bind_param("i", $idproducto);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idproducto, $cantidad, $nombre_producto, $url_imagen, $precio, $cantidad, $idusuario);
        $stmt->fetch();
    } else {
      echo "No hay datos para mostrar";
    }

  } else {
    echo "No se pudo preparar el parametro";
  }

?>

<div class="container">
<h3 class="center">Modificar Datos</h3>
  <form method="POST" enctype="multipart/form-data" onsubmit="return editar_carrito(event)">

    <label for="nombre_producto">Nombre del Producto</label>
    <input type="text" name="nombre_producto"  readonly="true" value="<?php echo $nombre_producto?>">

    <label for="url_imagen">URL Imagen</label>
    <input type="text" name="url_imagen" readonly="true" value="<?php echo $url_imagen?>">

    <label for="precio">Precio</label>
    <input type="text" name="precio" readonly="true" value="<?php echo $precio?>">

    <label for="cantidad">Cantidad</label>
    <input type="text" name="cantidad" value="<?php echo $cantidad?>">

    
    <input type="submit" name="submit" value="Ingresar">
  </form>

</div>




<script>
  
  function editar_carrito(e)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=editar_carrito';
        var data = {          
        }
        var pForm = new FormData(e.target); 
        var body = {
          "nombre_producto": pForm.get("nombre_producto"),
          "precio": pForm.get("precio"),
          "cantidad": pForm.get("cantidad"),
          "url_imagen": pForm.get("url_imagen")};
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

</script>