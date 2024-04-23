<?php

namespace App\Controller\Login\FirstAccess;

use App\Model\Login\FirstAccess\FirstAccess as FirstAccessModel;
use App\Controller\Login\FirstAccess\AuxFirstAccess;
class FirstAccess
{
    public static function get()
    {
        // Implementação da função GET
    }

    public static function post()
    {
        // Implementação da função POST
        //FirstAccessModel::post();
        //echo json_encode(["message" => "Password: " .$_POST['password'] . " | " . "Password Confirm: " . $_POST['passwordConfirm']]);
        //exit();


        $user_Input_Is_Valid = AuxFirstAccess::validate_User_Input_For_First_Access($_POST['password'], $_POST['passwordConfirm']);
        if($user_Input_Is_Valid)
        {
            FirstAccessModel::post($user_Input_Is_Valid['password']);
        }
    }
}

?>