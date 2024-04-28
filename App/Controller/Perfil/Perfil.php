<?php

namespace App\Controller\Perfil;

use App\Model\Perfil\Perfil as PerfilModel;

class Perfil
{
    public static function pode_Visualizar_Perfil()
    {
        // Implementação da função GET
    }

    public static function pode_Atualizar_Senha()
    {
        
        $user_Input_Is_Valid = AuxPerfil::validate_User_Input_For_Change_Password($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword']);
        if($user_Input_Is_Valid)
        {
            //LoginModel::loggin($user_Input_Is_Valid['username'], $user_Input_Is_Valid['password']);
            PerfilModel::pode_Atualizar_Senha($user_Input_Is_Valid['oldPassword'], $user_Input_Is_Valid['newPassword'], $user_Input_Is_Valid['confirmNewPassword']);
        }
    }
}

?>