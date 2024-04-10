<?php 
namespace App\Model\Login;
use App\Model\Database\Database;

class Login
{
    public static function get()
    {
        $DATA = "Login - Works!";

        return $DATA;
    }

    public static function loggin($username, $password)
    {
        $conn = Database::conectaDB();

        $sql = "SELECT COL_USERS_ID, COL_USERS_EMAIL, COL_USERS_PASSWORD, COL_USERS_FK_PEOPLE_ID FROM TBL_USERS WHERE COL_USERS_EMAIL = :username LIMIT 1";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result['COL_USERS_PASSWORD'])) {
                echo json_encode(["message" => "Bateu no Model $username , $password"]);
                //header("Location: /home");
                
                exit();
            } else {
                echo json_encode(["message" => "Credenciais Invalidas"]);
            }
        } catch (\PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
}

?>