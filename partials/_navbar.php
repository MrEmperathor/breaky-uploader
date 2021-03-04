<body>
    <div class="container-scroller">
       <!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.png" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    
    <ul class="navbar-nav navbar-nav-right">
      
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
      
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="controlador/salir.php">
          <i class="mdi mdi-power"></i>
        </a>
      </li>

      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="<?php if($_SESSION['cargo']==="vigilante"){ echo 'assets/images/faces/face7.jpg';}else{echo 'assets/images/faces/face19.jpg';}?>" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black"><?php echo $_SESSION["nombre"]?></p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="controlador/salir.php">
            <i class="mdi mdi-logout mr-2 text-primary"></i>Salir</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>

 <!-- partial -->
 <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->