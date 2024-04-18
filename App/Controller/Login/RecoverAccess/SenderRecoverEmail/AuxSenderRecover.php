<?php
namespace App\Controller\Login\RecoverAccess\SenderRecoverEmail;
use App\Model\Login\RecoverAccess\SenderRecoverEmail\SenderRecoverEmail;
class AuxSenderRecover
{
    public static function validate_User_Input_For_Email_Sender($email_To_Send)
    {
        if (!self::is_Vazio($email_To_Send))
        {
            $response = ['message' => false, 'message' => 'Preencha o campo!'];
            echo json_encode($response);
            return false;
        } elseif (!self::is_Email($email_To_Send))
        {
            $response = ['message' => false, 'message' => 'Insira um E-mail Valido'];
            echo json_encode($response);
            return false;
        }
        else{
            SenderRecoverEmail::post($email_To_Send);
        }
    }

    public static function is_Email($email_To_Send)
    {
        if (filter_var($email_To_Send, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
            }
    }

    public static function is_Vazio($email_To_Send)
    {
        return !(empty($email_To_Send));
    }
}