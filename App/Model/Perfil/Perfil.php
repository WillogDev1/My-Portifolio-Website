<?php

namespace App\Model\Perfil;

class Perfil
{
    public static function pode_Visualizar_Perfil ()
    {
        // Implementação da função GET
        $DATA = str_replace('Perfil', __CLASS__, 'Perfil - Works');
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }

    public static function pode_Atualizar_Senha($oldPassword, $newPassword, $confirmNewPassword)
    {
        AuxPerfil::compare_Old_Password_To_User_Insert($oldPassword, $confirmNewPassword);
    }
}

?>