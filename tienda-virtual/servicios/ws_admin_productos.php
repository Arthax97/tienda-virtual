<?php
  require "../config.php";
  $accion = isset($_GET["accion"]) ? $_GET["accion"] : "default";
  $text = "Desconocido";

    switch($accion)
    {
      case "eliminarp":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $data->idproducto;
        if(isset($data)) {
          $strql = "DELETE FROM productos WHERE idproducto = ?";
          $stmt = $mysqli->prepare($strql);
          $stmt->bind_param("i", $data->idproducto);
          $stmt->execute();
          if ($stmt->errno == 0) {
            $text = "El producto se elimino de manera correcta";
          } else {
            $text = "no se pudo ejecutar la consulta";
          }
        } else {
          $text = "No se recibieron los parametros correctos";
        }
      break;

      case "agregarp":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if(isset($data)) {
          $strql = "INSERT INTO productos (nombre_producto, idcategoria, descripcion, url_imagen, precio, cantidad)
          VALUES ('$data->nombre_producto','$data->idcategoria','$data->descripcion','$data->url_imagen','$data->precio','$data->cantidad')";
          try {
            $stmt = $mysqli->prepare($strql);
            $stmt->execute();
            if ($stmt->errno == 0) {
              $last_id = $stmt->insert_id;
              $text = "Id del nuevo producto: " . $last_id;
            }
          } catch (Exception $e) {
            $text = "no se pudo agregar el producto";
          }
        } else {
           $text = "No se recibieron los parametros correctos";
        }
      break;

      case "editarp":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if(isset($data)) {         
          $strql = "UPDATE productos SET nombre_producto = '$data->nombre_producto', idcategoria = '$data->idcategoria', descripcion = '$data->descripcion', url_imagen = '$data->url_imagen', precio = '$data->precio', cantidad = '$data->cantidad' WHERE idproducto = '$data->idproducto' ";
         
          try {
            $stmt = $mysqli->prepare($strql);
            $stmt->execute();
            if ($stmt->errno == 0) {
              $text = "Producto Actualizado";
            }
          } catch (Exception $e) {
            $text = "no se pudo actualizar el producto";
          }
        } else {
           $text = "No se recibieron los parametros correctos para cambiar el producto";
        }
      break;

      case "eliminarc":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $data->idcategoria;
        if(isset($data)) {
          $strql = "DELETE FROM categorias WHERE idcategoria = ?";
          $stmt = $mysqli->prepare($strql);
          $stmt->bind_param("i", $data->idcategoria);
          $stmt->execute();
          if ($stmt->errno == 0) {
            $text = "La categoria se elimino de manera correcta";
          } else {
            $text = "no se pudo ejecutar la consulta";
          }
        } else {
          $text = "No se recibieron los parametros correctos";
        }
      break;

      case "agregarc":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if(isset($data)) {
          $strql = "INSERT INTO categorias (nombre_categoria, idcategoria, url_imagen)
          VALUES ('$data->nombre_categoria','$data->idcategoria','$data->url_imagen')";
          try {
            $stmt = $mysqli->prepare($strql);
            $stmt->execute();
            if ($stmt->errno == 0) {
              $last_id = $stmt->insert_id;
              $text = "Categoria Actualizada";
            }
          } catch (Exception $e) {
            $text = "no se pudo agregar la categoria";
          }
        } else {
           $text = "No se recibieron los parametros correctos";
        }
      break;


      case "editarc":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if(isset($data)) {         
          $strql = "UPDATE categorias SET nombre_categoria = '$data->nombre_categoria', idcategoria = '$data->idcategoria', url_imagen = '$data->url_imagen' WHERE idcategoria = '$data->idcategoria'";
         
          try {
            $stmt = $mysqli->prepare($strql);
            $stmt->execute();
            if ($stmt->errno == 0) {
              $text = "Categoria Actualizada";
            }
          } catch (Exception $e) {
            $text = "no se pudo actualizar la categoria";
          }
        } else {
           $text = "No se recibieron los parametros correctos para cambiar la categoria";
        }
      break;
      
      case "eliminarp_carrito":
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $data->idproducto;
        if(isset($data)) {
          $strql = "DELETE FROM carrito WHERE idproducto = ?";
          $stmt = $mysqli->prepare($strql);
          $stmt->bind_param("i", $data->idproducto);
          $stmt->execute();
          if ($stmt->errno == 0) {
            $text = "El Producto se elimino de manera correcta del carrito";
            
          } else {
            $text = "No se pudo ejecutar la consulta";
          }
        } else {
          $text = "No se recibieron los parametros correctos";
        }
        
      break;



      case "agregar_a_carrito":     
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if(isset($data)) {
          $strsql = "SELECT `cantidad` FROM `carrito` WHERE idproducto='$data->idproducto' AND idusuario=0 ";
          if ($stmt = $mysqli->prepare($strsql)) {
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
              $stmt->bind_result($cantidad);
              $stmt->fetch();
              $cantidad = $cantidad + 1;
              $strsql = "UPDATE carrito SET cantidad = '$cantidad' WHERE idproducto='$data->idproducto' AND idusuario=0 ";
            } else {
              $strsql = "INSERT INTO carrito (idusuario, idproducto, cantidad)
              VALUES ('0','$data->idproducto','1')";
            }
            if ($stmt = $mysqli->prepare($strsql)) {
              $stmt->execute();
              if($stmt->errno == 0) {
                $text = "Producto Agregado";
              } else {
                $text = "Error agregando el producto";
              }
            }
          }
        } else {
          echo "No hay datos para mostrar";
        }
      break;

      case "reducir_uno":     
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if(isset($data)) {
          $strsql = "SELECT `cantidad` FROM `carrito` WHERE idproducto='$data->idproducto' AND idusuario=0 ";
          if ($stmt = $mysqli->prepare($strsql)) {
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
              $stmt->bind_result($cantidad);
              $stmt->fetch();
              $cantidad = $cantidad - 1;
              if ($cantidad > 0) {
                $strsql = "UPDATE carrito SET cantidad = '$cantidad' WHERE idproducto='$data->idproducto' AND idusuario=0 ";
              } else {
                $strsql = "DELETE FROM carrito  WHERE idproducto='$data->idproducto' AND idusuario=0 ";
              }
              if ($stmt = $mysqli->prepare($strsql)) {
                $stmt->execute();
                if($stmt->errno == 0) {
                  $text = "Producto Agregado";
                } else {
                  $text = "Error agregando el producto";
                }
              }
            }
          }
        } else {
          echo "No hay datos para mostrar";
        }
      break;

      case "default":
      
      break;






    }

    $jsonreturn = array(

      "text" => $text
    );
    
    echo json_encode($jsonreturn)
?>


