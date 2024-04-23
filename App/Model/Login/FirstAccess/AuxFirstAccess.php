<?php

namespace App\Model\Login\FirstAccess;

use App\Model\Database\Database;

class AuxFirstAccess
{
    public static function update_User_Password($passwordConfirm)
    {
        $passwordConfirmHash = password_hash($passwordConfirm, PASSWORD_BCRYPT);
        $SET_USER_IS_FIRST_ACCESS_FALSE = 0;
        $people_id = $_SESSION['SESSION_ID'];
        $conn = Database::conectaDB();

        $sql = "UPDATE  TBL_USERS
        SET     COL_USERS_PASSWORD = :passwordConfirmHash, COL_USERS_IS_FIRST_LOGGIN  = :SET_USER_IS_FIRST_ACCESS_FALSE
        WHERE   COL_USERS_FK_PEOPLE_ID = :people_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':passwordConfirmHash', $passwordConfirmHash, \PDO::PARAM_STR);
        $stmt->bindParam(':people_id', $people_id, \PDO::PARAM_INT);
        $stmt->bindParam(':SET_USER_IS_FIRST_ACCESS_FALSE', $SET_USER_IS_FIRST_ACCESS_FALSE, \PDO::PARAM_INT);

        $stmt->execute();

        $response = ['success' => true, 'message' => "Senha Atualizada!", 'redirect' => '/home'];
        echo json_encode($response);
        return true;
    }
}
