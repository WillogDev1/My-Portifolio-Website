<?php

namespace App\Model\Login\RecoverAccess;
use App\Model\Login\RecoverAccess\AuxRecoverAccess;
use App\Model\Database\Database;
class RecoverAccess
{
    public static function get()
    {
        // Implementação da função GET
        $DATA = str_replace('RecoverAccess', __CLASS__, 'RecoverAccess - Works');
        return $DATA;
    }

    public static function post($passwordRecover, $password, $passwordConfirm)
    {
        $conn = Database::conectaDB();

        $sql = 'SELECT COL_USERS_TEMPORARY_PASSWORD FROM TBL_USERS WHERE COL_USERS_FK_PEOPLE_ID = :people_id limit 1';
        $people_id = $_SESSION['SESSION_ID'];
        try{
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':people_id', $people_id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $_SESSION['TEMPORARY_PASSWORD'] = $result['COL_USERS_TEMPORARY_PASSWORD'];
            AuxRecoverAccess::verify_Password_Is_Equal($passwordRecover);
        }catch (\PDOException $e){
            error_log("Erro na consulta: " . $e->getMessage());
            return false;
        }
    }
}