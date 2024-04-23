<?php
namespace App\Controller\Login\FirstAccess;

class AuxFirstAccess
{
    public static function is_Vazio($password, $passwordConfirm)
    {
        return !(empty($password) || empty($passwordConfirm));
    }

    public static function is_White_Space($password, $passwordConfirm)
    {
        return !(ctype_space($password) || ctype_space($passwordConfirm));
    }

    public static function is_Password_Equal_To_Each_Other($password, $passwordConfirm)
    {
        return ($password === $passwordConfirm);
    }

    public static function validate_User_Input_For_First_Access($password, $passwordConfirm)
    {
        if (!self::is_Vazio($password, $passwordConfirm)) {
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
            exit();
            return false;
        } elseif (!self::is_White_Space($password, $password)) {
            echo json_encode(["message" => "Por favor, sem espaços em branco."]);
            exit();
            return false;
        } elseif (!self::is_Password_Equal_To_Each_Other($password, $passwordConfirm)) {
            echo json_encode(["message" => "Senhas não são iguais."]);
            exit();
            return false;
        } else {
            return ['password' => $password, 'passwordConfirm' => $passwordConfirm];
        }
    }
}