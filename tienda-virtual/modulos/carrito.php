<?php
  global $mysqli;
  global $urlweb;
  global $cantidad;
?>
  <div class="container">
   <h3 class="left">Shopping Cart</h3>
   


  <table class="centered white responsive-table">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th></th>

      </tr>
    </thead>
    <tbody>
      <?php
      global $mysqli;
        $strsql = "  SELECT p.idproducto, c.cantidad, p.nombre_producto, p.url_imagen, p.precio, c.cantidad * p.precio as total from productos as p, carrito as c where c.idusuario=0 and p.idproducto = c.idproducto; ";
        if ($stmt = $mysqli->prepare($strsql)) {
          $stmt->execute();
          $stmt->store_result(); 
          if ($stmt->num_rows > 0) {
            $stmt->bind_result($idproducto, $cantidad, $nombre_producto, $url_imagen, $precio, $idusuario);
            while ($stmt->fetch()) {
              ?>
              <tr id="<?php echo $idproducto?>">
                <td><?php echo $nombre_producto?></td>
                <td><img class="responsive-img z-depth-1"  src="<?php echo $url_imagen ?>" alt="" width="100px" weight="100px"></td>
                <td><?php echo $precio?></td>
                <td><?php echo $cantidad?></td>
                <td>
                  <div class="botones">
                  <div class="up_down">
                    <a href="javascript:agregar_uno(<?php echo $idproducto ?>)" class="btn green"><i class="large material-icons">arrow_drop_up</i></a>
                    <a href="javascript:reducir_uno(<?php echo $idproducto ?>)" class="btn green"><i class="large material-icons">arrow_drop_down</i></a>
                  </div>
                <a href="javascript:eliminarp_carrito(<?php echo $idproducto ?>)" class="btn red"><i class="large material-icons">delete</i></a></td>
            </div>

              
              </tr>
              <?php
            }
            $strsql = "with tot as (SELECT (c.cantidad * p.precio) as total from productos as p, carrito as c where c.idusuario=0 and p.idproducto = c.idproducto) select sum(total) as grandtotal from tot";
            if ($stmt = $mysqli->prepare($strsql)) {
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($grandtotal);
              $stmt->fetch();
              ?>
              <td></td>
              <td><h5><b>Total a Pagar: </b>
              <td><h5><?php echo $grandtotal ?></h5></td>


              <?php
            } else {
              echo "no se accedio al valor total de la tabla";
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
  
</div>


<script>
      function eliminarp_carrito(idproducto)
      {
        var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=eliminarp_carrito';
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
          location.reload();
        })
        .catch(console.error)

      }

  function agregar_uno(idproducto) {
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
          location.reload();
        })
        .catch(console.error)
        
        return false;

      }

}  

function reducir_uno(idproducto) {
  {     var url = '<?php $urlweb ?>servicios/ws_admin_productos.php?accion=reducir_uno';
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
          location.reload();

        })
        .catch(console.error)
        
        return false;

      }

}

      
    </script>