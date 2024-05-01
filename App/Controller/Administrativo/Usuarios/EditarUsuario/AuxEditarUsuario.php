<?php
namespace App\Controller\Administrativo\Usuarios\EditarUsuario;

class AuxEditarUsuario
{

    public static function is_Email($newEmail)
    {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_Set($newName,$newEmail )
    {
        return (isset($newName) && $newEmail);
    }

    public static function is_White_Space($newName, $newEmail)
    {
        return !(ctype_space($newName) || ctype_space($newEmail));
    }

    public static function is_Vazio($newName, $newEmail)
    {
        return !(empty($newName) || empty($newEmail));
    }

    public static function validate_Admin_Input_For_Change_Password($newName, $newEmail)
    {
        if (!self::is_Vazio($newName, $newEmail))
        {
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
            return false;
        } elseif (!self::is_Email($newEmail))
        {
            echo json_encode(["message" => "Por favor, preencha um email valido."]);
            return false;
        } elseif (!self::is_Set($newName, $newEmail)){
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
        } elseif(!self::is_White_Space($newName, $newEmail)){
            echo json_encode(["message" => "Por favor, não use Barra de Espaço."]);
        }
        else{
            return ['newName' => $newName, 'newEmail' => $newEmail];
        }
    }
}