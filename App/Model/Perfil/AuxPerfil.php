<?php
namespace App\Model\Perfil;
use App\Model\Database\Database;
class AuxPerfil
{
    public static function get_Old_Password_From_Database()
    {
        $USER_ID = $_SESSION['SESSION_ID'];
        $conn = Database::conectaDB();

        $sql="SELECT COL_USERS_PASSWORD FROM TBL_USERS WHERE COL_USERS_FK_PEOPLE_ID = :USER_ID LIMIT 1";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':USER_ID', $USER_ID, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result['COL_USERS_PASSWORD'];
        } catch (\PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }

    public static function compare_Old_Password_To_User_Insert($old_Password_From_User_Insert, $confirmNewPassword)
    {
        $old_Password_From_Database = self::get_Old_Password_From_Database();
        
        if (password_verify($old_Password_From_User_Insert, $old_Password_From_Database))
        {
            self::update_Password($confirmNewPassword);
        } else {
            echo json_encode(["message" => "Senhas Antigas não Conferem"]);
            exit();
            //return false;
        }
    }

    public static function update_Password($confirmNewPassword)
    {
        $USER_ID = $_SESSION['SESSION_ID'];
        $newHashedPassword = password_hash($confirmNewPassword, PASSWORD_DEFAULT); // Hash da nova senha
        $conn = Database::conectaDB();
    
        // Atualiza a senha na tabela
        $sql = "UPDATE TBL_USERS SET COL_USERS_PASSWORD = :newHashedPassword WHERE COL_USERS_FK_PEOPLE_ID = :USER_ID";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newHashedPassword', $newHashedPassword, \PDO::PARAM_STR);
            $stmt->bindParam(':USER_ID', $USER_ID, \PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo json_encode(["message" => "Atualizado com Sucesso"]);
                return true;
            } else {
                echo json_encode(["message" => "Erro ao inserir no banco de dados"]);
                return false;
            }
        } catch (\PDOException $e) {
            die("Erro na atualização da senha: " . $e->getMessage());
        }
    }
}