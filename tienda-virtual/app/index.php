<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="<?php echo $urlweb?>app/css/styles1.css">
  <title>Document</title>

</head>
<body>
  <div class="z-depth-1 blue lighten-5">
    <div class="blue lighten-5 container" id="above">
        <ul class="nav_links">
          <li><a class="modal-trigger" href="#modal1">Bienvenido</a></li>
          <li>Ofertas Diarias</li>
          <li>Foro Academico</li>
          <li>Ayuda y Contacto</li>
        </ul>
        <ul class="nav_links">

        </ul>
    </div>

  </div>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content center">
      <h4>Bienvenido</h4>
      <p>A continuacion encontrara los modulos disponibles para este sitio web</p>
      <ul class="collapsible">
        <li>
          <div class="collapsible-header">
            <i class="material-icons">filter_drama</i>Administracion de Productos
          </div>
          <div class="collapsible-body">
          <a href="?modulo=admin_productos" class="waves-effect waves-light  light-blue darken-1 btn"><i class="material-icons left">add_circle</i>Administrar Productos</a>
          </div>
          <div class="collapsible-body">
            <a href="?modulo=admin_categorias" class="waves-effect waves-light  cyan darken-1 btn"><i class="material-icons left">add_circle</i>Administrar Categorias</a>
          </div>
        </li>

        


      </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>

  <div id="modal2" class="modal">
    <div class="modal-content center">
      <h4>Categorias</h4>
      <p>A continuacion encontrara las categorias disponibles para este sitio web</p>
      <ul class="collapsible">
        <li>
          <div class="collapsible-header">
            <i class="material-icons">filter_drama</i>Heaven on Earth
          </div>
          <div class="collapsible-body">
          <a href="?modulo=applewatch" class="waves-effect waves-light  light-blue darken-1 btn"><i class="material-icons right">watch</i>Apple Watch</a>
          </div>
          <div class="collapsible-body">
            <a href="?modulo=iphone" class="waves-effect waves-light  cyan darken-1 btn"><i class="material-icons right">phone_iphone</i>iPhone</a>
          </div>
          <div class="collapsible-body">
            <a href="?modulo=mac" class="waves-effect waves-light  cyan darken-1 btn"><i class="material-icons right">desktop_mac</i>Mac</a>
          </div>
          <div class="collapsible-body">
            <a href="?modulo=ipad" class="waves-effect waves-light  cyan darken-1 btn"><i class="material-icons right">tablet_mac</i>iPad</a>
          </div>
          <div class="collapsible-body">
            <a href="?modulo=airpod" class="waves-effect waves-light  cyan darken-1 btn"><i class="material-icons right">headset</i>AirPods</a>
          </div>
        </li>
        <li>
          <div class="collapsible-header">
            <i class="material-icons">filter_drama</i>Coming Soon
          </div>
          <div class="collapsible-body">
          <a href="?modulo=home" class="waves-effect waves-light  light-blue darken-1 btn"><i class="material-icons right">live_tv</i>Apple TV</a>
        </li>

        


      </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>

  

  
  <div class="container">

    <!-- Nav Bar -->
    <div>
      <nav>
        <div class="nav-wrapper grey darken-3">
          <a href="?modulo=productos" class="brand-logo"><img src="app/img/logo-USAP-naranja-2.png" alt="USAP logo"></a>
          
          <ul id="navbar-items" class="right hide-on-med-and-down">
            <li><a href="?modulo=productos"><i class="material-icons right">devices</i>Productos</a></li>

            <li><a class="modal-trigger" href="#modal2"><i class="material-icons right">layers</i>Categorias</a></li>

            <li><a href="?modulo=carrito"><i class="material-icons right">shopping_cart</i></a></li>
            
          </ul>


        
          
          
        </div>
      </nav>
     </div>
    </div>

    <div class="dinamic">
      <?php $funciones->modulo($modulo); ?>
    </div>

    <footer class="page-footer blue darken-3 container">
      <div class="footer-copyright">
        <div class="container">
          &copy; 2022 Desarrollo de Aplicaciones en Internet
          <a class="grey-text text-lighten-4 right" href="https://www.usap.edu/" target="_blank">usap.edu</a>
        </div>
        
      </div>
    </footer>
  </div>

 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
        var modal = document.querySelectorAll('.modal');
        var collapsible = document.querySelectorAll('.collapsible');
        var instances_modal = M.Modal.init(modal);
        var instances_collapsible = M.Collapsible.init(collapsible);
      

      });
      





  </script>
 

</body>
</html>