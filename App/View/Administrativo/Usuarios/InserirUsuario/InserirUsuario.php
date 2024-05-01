<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar usuario</title>
</head>

<body id="body-pd">
    <?php include __DIR__ . "/../../../Componentes/Navbar.php" ?>
    <div class="height-100 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Page title -->
                    <div class="my-5">
                        <h3>Adicionar Usuario</h3>
                        <hr>
                    </div>
                    <!-- Form START -->
                    <form id="profileForm" class="file-upload">
                        <button type="button" onclick="send_Fetch_Criar_Usuario()" class="btn btn-primary btn-lg">+ Inserir</button>
                        <div class="row mb-5 gx-5">
                            <!-- Contact detail -->
                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Dados Pessoais</h4>
                                        <!-- First Name -->
                                        <div class="col-md-12">
                                            <label class="form-label">Nome completo</label>
                                            <input id="nomeCompleto" type="text" class="form-control" placeholder="Nome" aria-label="First name" value="">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Email</label>
                                            <input id="email" type="text" class="form-control" placeholder="Email" aria-label="Email" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">CPF</label>
                                            <input id="cpf" type="text" class="form-control" placeholder="CPF" aria-label="CPF" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Senha Provisória</label>
                                            <input id="password" type="password" class="form-control" placeholder="Senha" aria-label="password" value="">
                                        </div>
                                    </div> <!-- Row END -->
                                </div>

                            </div>
                        </div>
                </div>
                <div class="gap-3 d-md-flex justify-content-md-end text-center">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
<script type="text/javascript" src="/Public/Js/Componentes/Navbar/Navbar.js"></script>
<script type="text/javascript" src="/Public/Js/Administrativo/Usuarios/InserirUsuario/InserirUsuario.js"> </script>

</html>