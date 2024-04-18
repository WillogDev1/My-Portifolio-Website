<?php

namespace App\Model\Login\RecoverAccess\SenderRecoverEmail;
use App\Model\Login\RecoverAccess\SenderRecoverEmail\AuxSenderRecoverEmail;
class SenderRecoverEmail
{
    public static function get()
    {
        // Implementação da função GET
        $DATA = str_replace('SenderRecoverEmail', __CLASS__, 'SenderRecoverEmail - Works');
        return $DATA;
    }

    public static function post($email_To_Send_Recover)
    {
        AuxSenderRecoverEmail::email_Exist_In_Data_Base($email_To_Send_Recover);
    }
}

?>