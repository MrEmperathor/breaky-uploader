
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="<?php if($_SESSION['cargo']==="vigilante"){ echo 'assets/images/faces/face7.jpg';}else{
            if ($_SESSION['nombre'] == "admin2") {
              echo 'assets/images/faces/face7.jpg';
            }else {
              echo 'assets/images/faces/face19.jpg';
            }
            }?>" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo $_SESSION["nombre"]?></span>
          <span class="text-secondary text-small"><?php echo $_SESSION["cargo"]?></span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?id=cms">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <?php if($_SESSION["cargo"] === 'administrador'){
  echo '
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
            <span class="menu-title">Enlaces</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-link menu-icon"></i>
        </a>
        <div class="collapse" id="general-pages">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="/panel/?id=pelis">Peliculas</a></li>
              <li class="nav-item"> <a class="nav-link" href="/panel/?id=series">Series</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#general-pages-config" aria-expanded="false" aria-controls="general-pages">
            <span class="menu-title">Configuracion</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-link menu-icon"></i>
        </a>
        <div class="collapse" id="general-pages-config">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-item"> <a class="nav-link" href="/panel/?id=uptobox_sessid">Uptobox</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#general-pages-config1" aria-expanded="false" aria-controls="general-pages">
            <span class="menu-title">Herramientas</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-link menu-icon"></i>
        </a>
        <div class="collapse" id="general-pages-config1">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-item"> <a class="nav-link" href="/panel/?id=sc">Plugin</a></li>
              <li class="nav-item"> <a class="nav-item"> <a class="nav-link" href="/panel/?id=generar-comando">Comandos</a></li>
          </ul>
        </div>
      </li>



    '; }
    if($_SESSION["cargo"]==='vigilante'){ 
      echo '
    
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
              <span class="menu-title">Usuarios</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account menu-icon"></i>
          </a>
          <div class="collapse" id="general-pages">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/cms/?id=registro_usuario"> Registro </a></li>
                <li class="nav-item"> <a class="nav-link" href="/cms/?id=actualizar"> Actualizar Datos </a></li>
                <li class="nav-item"> <a class="nav-link" href="/cms/?id=listado"> Listado General</a></li>
            </ul>
          </div>
      </li>

      <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages1" aria-expanded="false" aria-controls="general-pages1">
          <span class="menu-title">Parqueadero</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-bike menu-icon"></i>
      </a>
      <div class="collapse" id="general-pages1">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/cms/?id=ingreso"> Ingreso </a></li>
            <li class="nav-item"> <a class="nav-link" href="/cms/?id=salida_usuario"> Salida </a></li>
            <li class="nav-item"> <a class="nav-link" href="/cms/?id=listado_parqueado"> Usuarios en Parqueadero</a></li>
        </ul>
      </div>
      </li>
      
      <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#general-pages2" aria-expanded="false" aria-controls="general-pages2">
          <span class="menu-title">Reportes</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-library menu-icon"></i>
      </a>
      <div class="collapse" id="general-pages2">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/cms/?id=reporte"> Listado de Parqueados </a></li>
            
        </ul>
      </div>
      </li>
    
 
    
 
   
    '; } ?>
    
  </ul>
</nav>