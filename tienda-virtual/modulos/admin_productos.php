<?php
  global $mysqli;
  global $urlweb;
?>
    <h3 class="center">Administrador de Productos</h3>
    <div class="container center">
      <a href="?modulo=crear_producto" class="waves-effect waves-light btn blue "><i class="material-icons right">create</i>Agregar Nuevo Producto</a>
      
    </div>
    <table class="centered white responsive-table">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Categoria</th>
          <th>Descripcion</th>
          <th>Imagen</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Editar</th>
          <th>Eliminar</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $strsql = "SELECT productos.idproducto, productos.nombre_producto, categorias.nombre_categoria, productos.descripcion, productos.url_imagen, productos.precio, productos.cantidad  FROM `productos` INNER JOIN categorias ON categorias.idcategoria=productos.idcategoria";
        if ($stmt = $mysqli->prepare($strsql)) {
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
              $stmt->bind_result($idproducto, $nombre_producto, $categoria, $descripcion, $url_imagen, $precio, $cantidad );
              while ($stmt->fetch()) {
                ?>
              <tr id="<?php echo $idproducto?>">
                <td><?php echo $nombre_producto?></td>
                <td><?php echo $categoria?></td>
                <td><?php echo $descripcion?></td>
                <td><img class="responsive-img z-depth-1"  src="<?php echo $url_imagen ?>" alt="" width="100px" weight="100px"></td>
                <td><?php echo $precio?></td>
                <td><?php echo $cantidad?></td>
                <td><a href="?modulo=editar_producto&idproducto=<?php echo $idproducto ?>" class="btn green">Editar</a></td>
                <td><a href="javascript:eliminarp(<?php echo $idproducto ?>)" class="btn red">Eliminar</a></td>
      
      
              
              </tr>
              <?php
              }
            } else {
              echo "no hay registro";
            }
        } else {
          echo "no se pudo preparar la consulta";
        }
        ?>

      </tbody>
    </table>

    <script>
      function eliminarp(idproducto)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=eliminarp';
        var data = {
          
        }
        fetch(url, 
        {
          method: 'POST',
          body: JSON.stringify({
            "idproducto": idproducto
          })

        })
        .then((response) => response.json())
        .then((data) => {
          M.toast({html: data.text})
          const row = document.getElementById(idproducto);
          row.remove();
        })
        .catch(console.error)

      }

      
    </script>