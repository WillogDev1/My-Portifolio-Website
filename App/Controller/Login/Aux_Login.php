<?php 
namespace App\Controller\Login;

class Aux_Login
{

    public static function validate_User_Input_For_Login($username, $password)
    {
        if (!self::is_Vazio($username, $password))
        {
            $_SESSION['Error'] = "Por favor, preencha todos os campos.";
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
            return false;
        } elseif (!self::is_Email($username))
        {
            $_SESSION['Error'] = "Por favor, preencha um email valido.";
            echo json_encode(["message" => "Por favor, preencha um email valido."]);
            return false;
        } elseif (!self::is_Set($username, $password)){
            $_SESSION['Error'] = "Por favor, preencha todos os campos.";
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
        } elseif(!self::is_White_Space($username, $password)){
            $_SESSION['Error'] = "Por favor, não use Barra de Espaço.";
            echo json_encode(["message" => "Por favor, não use Barra de Espaço."]);
        }
        else{
            //echo json_encode(["message" => "Input Validado"]);
            return ['username' => $username, 'password' => $password];
        }
    }

    public static function is_Email($username)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
            }
    }

    public static function is_Vazio($username, $password)
    {
        return !(empty($username) || empty($password));
    }

    public static function is_Set($username,$password )
    {
        return (isset($username) && $password);
    }

    public static function is_White_Space($username, $password)
    {
        return !(ctype_space($username) || ctype_space($password));
    }

}