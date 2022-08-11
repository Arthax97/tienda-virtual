<?php
  global $mysqli;
  global $urlweb;
?>
    <h3 class="center">Administrador de Categorias</h3>
    <div class="container center">
      <a href="?modulo=crear_categoria" class="waves-effect waves-light btn blue "><i class="material-icons right">create</i>Agregar Nueva Categoria</a>
      
    </div>
    <table class="centered white responsive-table">
      <thead>
        <tr>
          <th>Categoria</th>
          <th>Imagen</th>
          <th>Editar</th>
          <th>Eliminar</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $strsql = "SELECT idcategoria, nombre_categoria, url_imagen, feacha_creacion FROM categorias";
        if ($stmt = $mysqli->prepare($strsql)) {
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
              $stmt->bind_result($idcategoria, $nombre_categoria, $url_imagen, $feacha_creacion);
              while ($stmt->fetch()) {
                ?>
              <tr id="<?php echo $idcategoria?>">
                <td><?php echo $nombre_categoria?></td>
                <td><img class="responsive-img z-depth-1" src="<?php echo $url_imagen ?>" alt="" width="200px" weight="200px"></td>
                <td><a href="?modulo=editar_categoria&idcategoria=<?php echo $idcategoria ?>" class="btn green">Editar</a></td>
                <td><a href="javascript:eliminarc(<?php echo $idcategoria ?>)" class="btn red">Eliminar</a></td>
      
      
              
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
      function eliminarc(idcategoria)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=eliminarc';
        var data = {
          
        }
        fetch(url, 
        {
          method: 'POST',
          body: JSON.stringify({
            "idcategoria": idcategoria
          })

        })
        .then((response) => response.json())
        .then((data) => {
          M.toast({html: data.text})
          const row = document.getElementById(idcategoria);
          row.remove();
        })
        .catch(console.error)

      }
    </script>