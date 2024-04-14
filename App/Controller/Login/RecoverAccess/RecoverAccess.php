<?php

namespace App\Controller\Login\RecoverAccess;

use App\Model\Login\RecoverAccess\RecoverAccess as RecoverAccessModel;
use App\Controller\Login\RecoverAccess\AuxRecoverAccess;


class RecoverAccess
{
    public static function get()
    {
        // Implementação da função GET
    }

    public static function post()
    {

        $user_Input_Is_Valid = AuxRecoverAccess::validate_User_Input_For_Login($_POST['passwordRecover'], $_POST['password'], $_POST['passwordConfirm']);

        if($user_Input_Is_Valid)
        {
            RecoverAccessModel::post($user_Input_Is_Valid['passwordRecover'], $user_Input_Is_Valid['password'],$user_Input_Is_Valid['passwordConfirm']);
        }
    }
}

?>