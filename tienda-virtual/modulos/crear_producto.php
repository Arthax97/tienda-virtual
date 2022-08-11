<?php
global $mysqli;
?>
<div class="container center">
  <a href="?modulo=admin_productos" class="waves-effect waves-light btn green "><i class="material-icons left">keyboard_arrow_left</i>Regresar</a>
      
</div>

<div class="container">
<h3 class="center">Ingrese Nuevo Producto</h3>
  <form method="POST" enctype="multipart/form-data" onsubmit="return agregarp(event)">
    <input type="text" name="nombre_producto" placeholder="Nombre del Producto">
    <input type="text" name="idcategoria" placeholder="Categoria">
    <input type="text" name="descripcion" placeholder="Descripcion">
    <input type="text" name="url_imagen" placeholder="URL Imagen">
    <input type="text" name="precio" placeholder="Precio">
    <input type="text" name="cantidad" placeholder="Cantidad">
    <input type="submit" name="submit" value="Ingresar">
  </form>

</div>

<script>
  
  function agregarp(e)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=agregarp';
        var data = {          
        }
        var pForm = new FormData(e.target); 
        var body = {
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







