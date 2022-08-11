
<div class="container center">
  <a href="?modulo=admin_productos" class="waves-effect waves-light btn green "><i class="material-icons left">keyboard_arrow_left</i>Regresar</a>
      
</div>


<?php
global $mysqli;
$idproducto = $_GET['idproducto'];
  $strsql = "SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`,
  `cantidad`, `url_imagen` FROM `productos` WHERE idproducto=? ";
  if ($stmt = $mysqli->prepare($strsql)) {
    $stmt->bind_param("i", $idproducto);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $cantidad, $url_imagen);
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
  <form method="POST" enctype="multipart/form-data" onsubmit="return editarp(event)">

    <label for="idproducto">ID Producto</label>
    <input type="text" name="idproducto" placeholder="ID del Producto" readonly="true" value="<?php echo $idproducto?>">

    <label for="nombre_producto">Producto</label>
    <input type="text" name="nombre_producto" placeholder="Nombre del Producto" value="<?php echo $nombre_producto?>">

    <label for="idcategoria">Categoria</label>
    <input type="text" name="idcategoria" placeholder="Categoria" value="<?php echo $idcategoria?>">

    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" placeholder="Descripcion" value="<?php echo $descripcion?>">

    <label for="url_imagen">URL Imagen</label>
    <input type="text" name="url_imagen" placeholder="URL Imagen" value="<?php echo $url_imagen?>">

    <label for="precio">Precio</label>
    <input type="text" name="precio" placeholder="Precio" value="<?php echo $precio?>">

    <label for="cantidad">Cantidad</label>
    <input type="text" name="cantidad" placeholder="Cantidad" value="<?php echo $cantidad?>">
    
    <input type="submit" name="submit" value="Ingresar">
  </form>

</div>




<script>
  
  function editarp(e)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=editarp';
        var data = {          
        }
        var pForm = new FormData(e.target); 
        var body = {
          "idproducto":  pForm.get("idproducto"),
          "nombre_producto": pForm.get("nombre_producto"),
          "idcategoria": pForm.get("idcategoria"),
          "descripcion": pForm.get("descripcion"), 
          "url_imagen": pForm.get("url_imagen"),
          "precio": pForm.get("precio"), 
          "cantidad": pForm.get("cantidad")};
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

