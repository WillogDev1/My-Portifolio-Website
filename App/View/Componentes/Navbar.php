<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="/Public/Css/Componentes/Navbar/Navbar.css">

<body id="body-pd">
   <header class="header" id="header">
      <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
      <p><?php echo $_SESSION['username'] ?></p>
      <div class="header_img">
         <img src="<?php //echo $_SESSION['dados_usuario']['img_Pessoa'] . '?timestamp=' . time(); ?>" alt="">
      </div>
   </header>
   <div class="l-navbar" id="nav-bar">
      <nav class="nav">
         <div>
            <a href="/home" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Colégio Ser!</span> </a>
            <div class="nav_list"> <a href="#" class="nav_link active">
                  <i class='bi bi-megaphone nav_icon'></i>
                  <span class="nav_name">Comunicação</span> </a> <a href="#" class="nav_link">
                  <i class='bx bx-calendar'></i>
                  <span class="nav_name">Calendario</span> </a> <a href="#" class="nav_link">
                  <i class='bx bx-message-square-detail nav_icon'></i>
                  <span class="nav_name">Mensagens</span> </a> <a href="/perfil" class="nav_link">
                  <i class='bi bi-person-circle nav_icon'></i>
                  <span class="nav_name">Perfil</span> </a>
            </div>
         </div>
         <a href="/administrativo" class="nav_link"> <i class='bi bi-building  nav_icon'></i>
            <span class="nav_name">Administrativo</span> </a>
         <a href="/sair" class="nav_link"> <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">SignOut</span> </a>
      </nav>
   </div>
   <script type="text/javascript" src="Public/Js/Componentes/Navbar/Navbar.js"></script>