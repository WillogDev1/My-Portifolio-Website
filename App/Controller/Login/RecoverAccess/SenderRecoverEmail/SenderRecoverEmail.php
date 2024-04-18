<?php

namespace App\Controller\Login\RecoverAccess\SenderRecoverEmail;

use App\Model\Login\RecoverAccess\SenderRecoverEmail\SenderRecoverEmail as SenderRecoverEmailModel;
use App\Controller\Login\RecoverAccess\SenderRecoverEmail\AuxSenderRecover;
class SenderRecoverEmail
{
    public static function get()
    {
        // Implementação da função GET
    }

    public static function post()
    {
        // Implementação da função POST
        //SenderRecoverEmailModel::post();
        AuxSenderRecover::validate_User_Input_For_Email_Sender($_POST['email_Recover']);
    }
}

?>