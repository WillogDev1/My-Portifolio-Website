<?php
namespace App\Controller\Perfil;

class AuxPerfil
{
    public static function is_Vazio($oldPassword, $newPassword, $confirmNewPassword)
    {
        return !(empty($oldPassword) || empty($newPassword) || empty($confirmNewPassword));
    }

    public static function is_White_Space($oldPassword, $newPassword, $confirmNewPassword)
    {
        return !(ctype_space($oldPassword) || ctype_space($newPassword) || ctype_space($confirmNewPassword));
    }

    public static function is_Password_Equal_To_Each_Other($newPassword, $confirmNewPassword)
    {
        return ($newPassword === $confirmNewPassword);
    }

    public static function validate_User_Input_For_Change_Password($oldPassword, $newPassword, $confirmNewPassword)
    {
        if (!self::is_Vazio($oldPassword, $newPassword, $confirmNewPassword)) {
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
            return false;
        } elseif (!self::is_White_Space($oldPassword, $newPassword, $confirmNewPassword)) {
            echo json_encode(["message" => "Por favor, sem espaços em branco."]);
            return false;
        } elseif (!self::is_Password_Equal_To_Each_Other($newPassword, $confirmNewPassword)) {
            echo json_encode(["message" => "Senhas não são iguais."]);
            return false;
        } else {
            return ['oldPassword' => $oldPassword, 'newPassword' => $newPassword, 'confirmNewPassword' => $confirmNewPassword];
        }
    }
}