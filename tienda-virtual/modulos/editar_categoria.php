
<div class="container center">
  <a href="?modulo=admin_categorias" class="waves-effect waves-light btn green "><i class="material-icons left">keyboard_arrow_left</i>Regresar</a>
      
</div>


<?php
global $mysqli;
$idcategoria = $_GET['idcategoria'];
  $strsql = "SELECT `nombre_categoria`, `idcategoria`,`url_imagen` FROM `categorias` WHERE idcategoria=? ";
  if ($stmt = $mysqli->prepare($strsql)) {
    $stmt->bind_param("i", $idcategoria);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nombre_cateogria, $idcategoria, $url_imagen);
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
  <form method="POST" enctype="multipart/form-data" onsubmit="return editarc(event)">

    <label for="idcategoria">ID Categoria</label>
    <input type="text" name="idcategoria" placeholder="ID de la Categoria" readonly="true" value="<?php echo $idcategoria?>">

    <label for="nombre_categoria">Categoria</label>
    <input type="text" name="nombre_categoria" placeholder="Nombre de la Categoria" value="<?php echo $nombre_cateogria?>">

    <label for="url_imagen">URL Imagen</label>
    <input type="text" name="url_imagen" placeholder="URL Imagen" value="<?php echo $url_imagen?>">
    
    <input type="submit" name="submit" value="Ingresar">
  </form>

</div>




<script>
  
  function editarc(e)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=editarc';
        var data = {          
        }
        var pForm = new FormData(e.target); 
        var body = {
          "nombre_categoria": pForm.get("nombre_categoria"),
          "idcategoria": pForm.get("idcategoria"),
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