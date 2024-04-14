<?php

namespace App\Model\Login\FirstAccess;

class FirstAccess
{
    public static function get()
    {
        // Implementação da função GET
        $DATA = str_replace('FirstAccess', __CLASS__, 'FirstAccess - Works');
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }
}

?>