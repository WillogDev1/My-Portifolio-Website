<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/Css/Administrativo/Usuarios/Usuarios.css">

    <title>Usuarios</title>
</head>

<body>
    <div> <?php include __DIR__ . '/../../Componentes/Navbar.php' ?> </div>
    <!--Container Main start-->
    <div class="height-100">
    <div style="text-align: right; padding-top:2%; padding-right: 2%;">
        <button type="button" onclick="window.location.href='/administrativo/usuarios/inserirusuario'" class="btn btn-primary">+ Adicionar Usuario</button>
    </div>

    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Busque pelo Nome" title="Type in a name">
    <ul id="myUL">
        <?php foreach ($DATA as $usuario) : ?>
            <?php
            $isActive = htmlspecialchars($usuario['COL_USERS_IS_ACTIVE']);
            $liClass = $isActive == 1 ? 'active-user' : 'inactive-user';
            ?>
            <li class="<?php echo $liClass; ?>"><a href="<?php echo '/administrativo/usuarios/editarusuario?userId=' . htmlspecialchars($usuario['COL_PEOPLE_ID']) ?>"><?php echo htmlspecialchars($usuario['COL_PEOPLE_NAME']) ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>





    <!--Container Main end-->
</body>
<script type="text/javascript" src="/Public/Js/Componentes/Navbar/Navbar.js"></script>
<script type="text/javascript" src="/Public/Js/Administrativo/Usuarios/Usuarios.js"></script>

</html>