<?php

namespace App\Controller\Administrativo\Usuarios\EditarUsuario;

use App\Model\Administrativo\Usuarios\EditarUsuario\EditarUsuario as EditarUsuarioModel;
use App\Controller\Administrativo\Usuarios\EditarUsuario\AuxEditarUsuario;

class EditarUsuario
{
    public static function pode_Visualizar_Edicao_De_Usuario()
    {
    }

    public static function pode_Editar_Usuario()
    {
        $user_Input_Is_Valid = AuxEditarUsuario::validate_Admin_Input_For_Change_Password($_POST['novoNome'], $_POST['novoEmail']);
        if ($user_Input_Is_Valid) {
            EditarUsuarioModel::update_User_Information_In_Database($user_Input_Is_Valid['newName'], $user_Input_Is_Valid['newEmail'], $_POST['USER_ID']);
        }
    }

    public static function pode_Enviar_Senha_Do_Usuario()
    {
        EditarUsuarioModel::enviar_Senha($_POST['userId'], $_POST['novoEmail']);
    }

    public static function pode_Alterar_Senha_Do_Usuario()
    {
        EditarUsuarioModel::pode_Alterar_Senha_Do_Usuario($_POST['userId'], $_POST['novaSenha']);
    }

    public static function pode_Desativar_Usuario()
    {
        EditarUsuarioModel::pode_Desativar_Usuario($_POST['userId']);
    }

    public static function pode_Ativar_Usuario()
    {
        EditarUsuarioModel::pode_Ativar_Usuario($_POST['userId']);
    }

    public static function pode_Atualizar_Permissao_Usuario()
    {
        // Verificar se os dados necessários estão presentes
        if (isset($_POST['permissions'])) {
            $permissions = json_decode($_POST['permissions'], true);
            $userId = $_POST['userId'];
            $updatePermissions = [];
    
            foreach ($permissions as $permissionId => $status) {
                // Convertendo o status para um valor inteiro (0 ou 1)
                $status = $status ? 1 : 0;
                $updatePermissions[] = [
                    'userId' => $userId,
                    'permissionId' => $permissionId,
                    'status' => $status
                ];
            }
    
            // Passar o array de atualizações para o Model para processamento
            EditarUsuarioModel::pode_Atualizar_Permissao_Usuario($updatePermissions);
        } else {
            echo json_encode(["message" => "Nenhum dado de permissão recebido"]);
        }
    }
}