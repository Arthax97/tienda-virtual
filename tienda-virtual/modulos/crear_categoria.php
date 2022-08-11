<?php
global $mysqli;
?>
<div class="container center">
  <a href="?modulo=admin_categorias" class="waves-effect waves-light btn green "><i class="material-icons left">keyboard_arrow_left</i>Regresar</a>
      
</div>

<div class="container">
<h3 class="center">Ingrese Nuevo Producto</h3>
  <form method="POST" enctype="multipart/form-data" onsubmit="return agregarc(event)">
    <input type="text" name="nombre_categoria" placeholder="Nombre de la Categoria">
    <input type="text" name="idcategoria" placeholder="Categoria">
    <input type="text" name="url_imagen" placeholder="URL Imagen">
    <input type="submit" name="submit" value="Ingresar">
  </form>

</div>

<script>
  
  function agregarc(e)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=agregarc';
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