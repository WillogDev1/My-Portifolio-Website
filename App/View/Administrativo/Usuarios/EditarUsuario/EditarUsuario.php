<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/Css/Administrativo/Usuarios/EditarUsuario/EditarUsuario.css">
    <title>Atualizar Usuario</title>
</head>

<body id="body-pd">
    <?php include __DIR__ . "/../../../Componentes/Navbar.php" ?>
    <div class="height-100 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Page title -->
                    <div class="my-5">
                        <h3>Atualizar Usuario</h3>
                        <hr>
                        <div style="text-align: left;">
                            <h4>Status do Cadastro:</h4>
                            <?php if ($DATA['userData']['COL_USERS_IS_ACTIVE'] == 1) : ?>
                                <span style="color: green;"></i> Ativado</span>
                            <?php else : ?>
                                <span style="color: red;"></i> Desativado</span>
                            <?php endif; ?>
                        </div>
                        <div style="text-align: right;">
                            <select id="meuSelect" onchange="opcaoSelecionada()">
                                <option value="1">Ações</option>
                                <option value="/enviar-senha">Enviar Senha</option>
                                <option value="/alterar-senha">Alterar Senha</option>
                                <option value="/ativar-usuario">Ativar Usuario</option>
                                <option value="/desativar-usuario">Desativar Usuario</option>
                            </select>
                        </div>

                    </div>
                    <!-- Form START -->
                    <form id="profileForm" class="file-upload" method="post">
                        <div class="row mb-5 gx-5">
                            <!-- Contact detail -->
                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Dados Pessoais</h4>
                                        <!-- First Name -->
                                        <div class="col-md-12">
                                            <label class="form-label">Nome Completo</label>
                                            <!-- Use o valor de $userInfo para preencher o campo -->
                                            <input id="novoNome" type="text" class="form-control" placeholder="Nome" aria-label="First name" value="<?= htmlspecialchars($DATA['userData']['COL_PEOPLE_NAME'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Email</label>
                                            <!-- Aqui, supomos que o email é parte dos dados do usuário, ajuste conforme sua estrutura -->
                                            <input id="novoEmail" type="text" class="form-control" placeholder="Email" aria-label="Email" value="<?= htmlspecialchars($DATA['userData']['COL_USERS_EMAIL'] ?? '') ?>">
                                        </div>
                                        <div style="text-align: right">
                                            <button type="button" onclick="send_Fetch_Editar_Usuario()" class="btn-success-soft btn-lg">Atualizar</button>
                                        </div>
                                    </div> <!-- Row END -->
                                </div>

                            </div>
                        </div>
                </div>
                <div style="text-align: left">
                    <button type="button" onclick="atualizar_Permissao()" class="btn-success-soft btn-lg">Atualizar</button>
                </div>
                <h4>Permissões do Usuário:</h4>
                <?php
                // Agrupando permissões por módulos
                $modulos = [];
                foreach ($DATA['permissao_total'] as $item) {
                    $modulos[$item['COL_MODULES_NOME']][] = $item;
                }
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Módulo</th>
                            <th>Permissão</th>
                            <th>Toggle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-divider">
                            <td colspan="3"></td>
                        </tr>
                        <?php foreach ($modulos as $nome_modulo => $permissoes) : ?>
                            <tr>
                                <td class="rowspan" rowspan="<?= count($permissoes) + 1 ?>"><?= htmlspecialchars($nome_modulo) ?></td>

                                <?php foreach ($permissoes as $index => $permissao) : ?>

                                    <?php if ($index > 0) : ?>
                            <tr>
                            <?php endif; ?>
                            <td><?= htmlspecialchars($permissao['COL_PERMISSIONS_NOME']) ?></td>
                            <td>
                                <div class='toggle-switch'>
                                    <?php
                                    $permissao_id = $permissao['COL_PERMISSIONS_ID'];
                                    $checked = '';
                                    foreach ($DATA['permissions_do_usuario'] as $permissao_usuario) {
                                        if ($permissao_usuario['COL_PERMISSIONS_ID'] == $permissao_id) {
                                            $checked = 'checked';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type='checkbox' id='toggle_<?= $permissao_id ?>' name='toggle_<?= $permissao_id ?>' value='<?= $permissao_id ?>' <?= $checked ?> data-orig='<?= $checked ?>'>
                                    <label class='toggle-slider' for='toggle_<?= $permissao_id ?>'></label>
                                </div>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Adicionando uma linha simulada de HR -->
                        <tr class="table-divider">
                            <td colspan="3"></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="gap-3 d-md-flex justify-content-md-end text-center">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
<script type="text/javascript" src="/Public/Js/Componentes/Navbar/Navbar.js"></script>
<script type="text/javascript" src="/Public/Js/Administrativo/Usuarios/EditarUsuario/EditarUsuario.js"> </script>

</html>