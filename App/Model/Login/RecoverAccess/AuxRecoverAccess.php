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

    public static function verify_Password_Is_Equal($passwordRecover, $passwordConfirm)
    {
        self::start_Session();

        if($_SESSION['TEMPORARY_PASSWORD'] === $passwordRecover)
        {
            self::update_Password($passwordRecover, $passwordConfirm);
            $response = ['success' => true, 'message' => 'Senha atualiza com sucesso' ,'redirect' => '/home'];
            echo json_encode($response);
        }else{
            $response = ['message' => false, 'message' => 'Senha temporaria não confere'];
            echo json_encode($response);
        }
    }

    public static function update_Password($passwordConfirm)
    {
        $passwordConfirmHash = password_hash($passwordConfirm, PASSWORD_BCRYPT);
        $SET_PASSWORD_RECOVER_FALSE = 0;
        $SET_TEMPORARY_PASSWORD_AS_NULL= null;
        self::start_Session();
        $people_id = $_SESSION['SESSION_ID'];
        $conn = Database::conectaDB();

        $sql = "UPDATE  TBL_USERS
                SET     COL_USERS_PASSWORD = :passwordConfirmHash, COL_USERS_IS_CHANGING_PASSWORD = :SET_PASSWORD_RECOVER_FALSE, COL_USERS_TEMPORARY_PASSWORD = :SET_TEMPORARY_PASSWORD_AS_NULL
                WHERE   COL_USERS_FK_PEOPLE_ID = :people_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':passwordConfirmHash', $passwordConfirmHash, \PDO::PARAM_STR);
        $stmt->bindParam(':people_id', $people_id, \PDO::PARAM_INT);
        $stmt->bindParam(':SET_PASSWORD_RECOVER_FALSE', $SET_PASSWORD_RECOVER_FALSE, \PDO::PARAM_INT);
        $stmt->bindParam(':SET_TEMPORARY_PASSWORD_AS_NULL', $SET_TEMPORARY_PASSWORD_AS_NULL, \PDO::PARAM_STR);
        $stmt->execute();
    }


    
}