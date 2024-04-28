<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/Css/Global.css">
    <link rel="stylesheet" href="/Public/Css/Perfil/Perfil.css">
    <link rel="stylesheet" href="/Public/Css/Home/Home.css">
    <title>Perfil</title>
</head>

<body id="body-pd">
    <?php include __DIR__ . "/../Componentes/Navbar.php" ?>
    <div class="height-100 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Page title -->
                    <div class="my-5">
                        <h3>Meu Perfil</h3>
                        <hr>
                    </div>
                    <!-- Form START -->
                    <form id="profileForm" class="file-upload" method="post">
                        <div class="row mb-5 gx-5">
                            <!-- Contact detail -->
                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Dados</h4>
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Nome</label>
                                            <input readonly="readonly" type="text" class="form-control" placeholder="Nome" aria-label="First name" value="<?php echo $_SESSION['nome'] ?>">
                                        </div>
                                    </div> <!-- Row END -->
                                </div>
                                <div class="col-xxl-6">
                                    <div class="bg-secondary-soft px-4 py-5 rounded">
                                        <div class="row g-3">
                                            <h4 class="my-4">Trocar minha senha</h4>
                                            <!-- Old password -->
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1" class="form-label">Senha antiga *</label>
                                                <input id="oldPassword" type="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <!-- New password -->
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword2" class="form-label">Nova senha *</label>
                                                <input id="newPassword" type="password" class="form-control" id="exampleInputPassword2">
                                            </div>
                                            <!-- Confirm password -->
                                            <div class="col-md-12">
                                                <label for="exampleInputPassword3" class="form-label">Confirme nova senha *</label>
                                                <input id="confirmNewPassword" type="password" class="form-control" id="exampleInputPassword3">
                                            </div>
                                            <button type="button" onclick="send_Fetch_Change_Password()" class="btn btn-primary btn-lg">Atualizar Senha</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload profile -->
                            <div class="col-xxl-4">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Mudar Imagem de perfil</h4>
                                        <div class="text-center">

                                            <!-- Image upload -->
                                            <div class="square position-relative display-2 mb-3">
                                                <img id="imagePreview" src="#" alt="Imagem de Preview" style="display: none;" />
                                                <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                            </div>
                                            <!-- Button -->
                                            <input type="file" id="customFile" name="file" hidden="">
                                            <label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
                                            <button type="button" class="btn btn-danger-soft">Remove</button>
                                            <!-- Content -->
                                            <?php if (!empty($feedbackMessageImg)) : ?>
                                                <div class="feedback-message">
                                                    <?= htmlspecialchars($feedbackMessageImg) ?>

                                                </div>
                                            <?php
                                            endif; ?>
                                            <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                                            <button type="button" onclick="updatePicProfile()" class="btn btn-primary ">Atualizar Foto</button>
                                        </div>
                                    </div>
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
<script type="text/javascript" src="Public/Js/Perfil/Fetch_Perfil.js"></script>

</html>