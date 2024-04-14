<?php
namespace App\Model\Login\RecoverAccess;
use App\Model\Database\Database;
class AuxRecoverAccess
{
    public static function start_Session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function verify_Password_Is_Equal($passwordRecover)
    {
        self::start_Session();

        if($_SESSION['TEMPORARY_PASSWORD'] === $passwordRecover)
        {
            $response = ['success' => true, 'message' => 'Senha atualiza com sucesso' ,'redirect' => '/home'];
            echo json_encode($response);
        }else{
            $response = ['message' => false, 'message' => 'Senha temporaria não confere'];
            echo json_encode($response);
        }
        
    }
}