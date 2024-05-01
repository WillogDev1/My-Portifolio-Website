<?php

namespace App\Model\Administrativo\Usuarios;
use App\Model\Database\Database;
class Usuarios
{
    public static function pode_Visualizar_Usuarios()
    {
        $DATA = self::get_All_Users_From_Database();
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }

    public static function get_All_Users_From_Database()
    {
        $conn = Database::conectaDB();

        try {
            $sql = "SELECT p.*, u.COL_USERS_ID, u.COL_USERS_IS_ACTIVE
            FROM TBL_PEOPLE p 
            LEFT JOIN TBL_USERS u ON p.COL_PEOPLE_ID = u.COL_USERS_FK_PEOPLE_ID";
            $stmt = $conn->prepare($sql);
    
            $stmt->execute();
    
            $listaUsuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            return $listaUsuarios;
        } catch (\PDOException $e) {
            die("Erro ao buscar pessoas e usuários: " . $e->getMessage());
        }
    }
}

?>