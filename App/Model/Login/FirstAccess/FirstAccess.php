<?php

namespace App\Model\Login\FirstAccess;
use App\Model\Login\FirstAccess\AuxFirstAccess;
class FirstAccess
{
    public static function get()
    {
        // Implementação da função GET
        $DATA = str_replace('FirstAccess', __CLASS__, 'FirstAccess - Works');
        return $DATA;
    }

    public static function post($passwordConfirm)
    {
        // Implementação da função POST
        AuxFirstAccess::update_User_Password($passwordConfirm);
    }
}

?>