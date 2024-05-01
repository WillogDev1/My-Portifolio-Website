<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/Css/Administrativo/Administrativo.css">

    <title>Administrativo</title>
</head>

<body>
    <div> <?php include __DIR__ . '/../Componentes/Navbar.php' ?> </div>
    <!--Container Main start-->
    <div class="height-100">
        <div class="grid-container">
            <div>
                <i style="font-size: 82px; color:rgb(108, 174, 126);" class='bx bxs-book-add'></i>
                <p>Criar um Curso</p>
            </div>
            <div>
                <i style="font-size: 82px; color:rgb(108, 174, 126);" class='bx bxs-file'></i>
                <p>Banco de questões</p>
            </div>
            <div onclick="window.location.href='/administrativo/usuarios';">
                <i style="font-size: 82px; color:rgb(108, 174, 126);" class='bx bxs-user'></i>
                <p>Usuários</p>
            </div>
        </div>

    </div>
    <!--Container Main end-->
</body>
<script type="text/javascript" src="Public/Js/Home/NavbarExpand.js"></script>

</html>