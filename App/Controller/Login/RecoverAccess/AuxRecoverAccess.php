<?php

namespace App\Controller\Login\RecoverAccess;

class AuxRecoverAccess
{
    public static function is_Vazio($passwordRecover, $password, $passwordConfirm)
    {
        return !(empty($passwordRecover) || empty($password) || empty($passwordConfirm));
    }

    public static function is_White_Space($passwordRecover, $password, $passwordConfirm)
    {
        return !(ctype_space($passwordRecover) || ctype_space($password) || ctype_space($passwordConfirm));
    }

    public static function is_Password_Equal_To_Each_Other($password, $passwordConfirm)
    {
        return ($password === $passwordConfirm);
    }

    public static function validate_User_Input_For_Login($passwordRecover, $password, $passwordConfirm)
    {
        if (!self::is_Vazio($passwordRecover, $password, $passwordConfirm)) {
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
            return false;
        } elseif (!self::is_White_Space($passwordRecover, $password, $passwordConfirm)) {
            echo json_encode(["message" => "Por favor, sem espaços em branco."]);
            return false;
        } elseif (!self::is_Password_Equal_To_Each_Other($password, $passwordConfirm)) {
            echo json_encode(["message" => "Senhas não são iguais."]);
            return false;
        } else {
            return ['passwordRecover' => $passwordRecover, 'password' => $password, 'passwordConfirm' => $passwordConfirm];
        }
    }
}