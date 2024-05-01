<?php

namespace App\Model\Administrativo\Usuarios\EditarUsuario;

use App\Model\Database\Database;
use App\Model\Login\RecoverAccess\SenderRecoverEmail\SenderRecoverEmail;

class EditarUsuario
{
    public static function pode_Visualizar_Edicao_De_Usuario()
    {
        $USER_ID = $_GET['userId'];
        $DATA = self::get_User_Data_From_Database($USER_ID);
        $PERMISSIOES_TOTAL =self::obter_Todas_Permissoes();
        $PERMISSOES_DO_USUARIO = self::obter_Permissoes_Do_Usuario($USER_ID); // Obtém as permissões do usuário
        return ['userData' => $DATA, 'permissions_do_usuario' => $PERMISSOES_DO_USUARIO, 'permissao_total' => $PERMISSIOES_TOTAL];
    }

    public static function pode_Editar_Usuario()
    {
        // Implementação da função POST
    }

    public static function get_User_Data_From_Database($USER_ID)
    {
        $conn = Database::conectaDB();

        try {
            // Ajuste a consulta para incluir um JOIN com tbl_Usuarios
            // Isso pressupõe que tbl_Usuarios tem uma coluna pessoa_id que referencia id_pessoa em tbl_Pessoas
            $sql = "SELECT p.*, u.COL_USERS_ID, u.COL_USERS_EMAIL, u.COL_USERS_IS_ACTIVE 
            FROM TBL_PEOPLE p 
            LEFT JOIN TBL_USERS u ON p.COL_PEOPLE_ID = u.COL_USERS_FK_PEOPLE_ID
            WHERE u.COL_USERS_ID = :user_id"; // Adiciona uma cláusula WHERE para filtrar pelo USER_ID
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $USER_ID); // Liga o parâmetro USER_ID à consulta

            $stmt->execute();

            // Fetch o usuário com o ID especificado
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $usuario;
        } catch (\PDOException $e) {
            die("Erro ao buscar pessoa e usuário: " . $e->getMessage());
        }
    }


    public static function update_User_Information_In_Database($newName, $newEmail, $USER_ID)
    {
        try {
            $conn = Database::conectaDB();

            // Consulta SQL para atualizar COL_PEOPLE_NAME em TBL_PEOPLE
            $sqlPeople = "UPDATE TBL_PEOPLE SET COL_PEOPLE_NAME = :newName WHERE COL_PEOPLE_ID =:USER_ID";

            // Consulta SQL para atualizar COL_USERS_EMAIL em TBL_USERS
            $sqlUsers = "UPDATE TBL_USERS SET COL_USERS_EMAIL = :newEmail WHERE COL_USERS_FK_PEOPLE_ID = :USER_ID";

            // Preparar e executar a consulta para TBL_PEOPLE
            $stmtPeople = $conn->prepare($sqlPeople);
            $stmtPeople->bindParam(':USER_ID', $USER_ID);
            $stmtPeople->bindParam(':newName', $newName);
            $stmtPeople->execute();

            // Preparar e executar a consulta para TBL_USERS
            $stmtUsers = $conn->prepare($sqlUsers);
            $stmtUsers->bindParam(':USER_ID', $USER_ID);
            $stmtUsers->bindParam(':newEmail', $newEmail);
            $stmtUsers->execute();

            echo json_encode(["message" => "Dados Foram atualizados!"]);
        } catch (\PDOException $e) {
            echo json_encode(["message" => "Erro ao atualizar informações do usuário: " . $e->getMessage()]);
        }
    }

    public static function pode_Alterar_Senha_Do_Usuario($USER_ID, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        try {

            $conn = Database::conectaDB();

            $sql = "UPDATE TBL_USERS SET COL_USERS_PASSWORD = :hashedPassword WHERE COL_USERS_FK_PEOPLE_ID = :USER_ID";

            $stmtUsers = $conn->prepare($sql);
            $stmtUsers->bindParam(':USER_ID', $USER_ID);
            $stmtUsers->bindParam(':hashedPassword', $hashedPassword);

            $stmtUsers->execute();

            echo json_encode(["message" => "Dados Foram atualizados!"]);
        } catch (\PDOException $e) {
            echo json_encode(["message" => "Erro ao atualizar informações do usuário: " . $e->getMessage()]);
        }
    }

    public static function enviar_Senha($USER_ID, $email_To_Send_Recover)
    {
        SenderRecoverEmail::post($email_To_Send_Recover);
    }

    public static function pode_Desativar_Usuario($USER_ID)
    {

        try {

            $conn = Database::conectaDB();

            $sql = "UPDATE TBL_USERS SET COL_USERS_IS_ACTIVE = 0 WHERE COL_USERS_FK_PEOPLE_ID = :USER_ID";

            $stmtUsers = $conn->prepare($sql);
            $stmtUsers->bindParam(':USER_ID', $USER_ID);

            $stmtUsers->execute();

            echo json_encode(["message" => "Usuario Desativado!"]);
        } catch (\PDOException $e) {
            echo json_encode(["message" => "Erro ao atualizar informações do usuário: " . $e->getMessage()]);
        }
    }


    public static function pode_Ativar_Usuario($USER_ID)
    {

        try {

            $conn = Database::conectaDB();

            $sql = "UPDATE TBL_USERS SET COL_USERS_IS_ACTIVE = 1 WHERE COL_USERS_FK_PEOPLE_ID = :USER_ID";

            $stmtUsers = $conn->prepare($sql);
            $stmtUsers->bindParam(':USER_ID', $USER_ID);

            $stmtUsers->execute();

            echo json_encode(["message" => "Usuario Ativado!"]);
        } catch (\PDOException $e) {
            echo json_encode(["message" => "Erro ao atualizar informações do usuário: " . $e->getMessage()]);
        }
    }

    public static function obter_Todas_Permissoes()
    {
        try {
            $conn = Database::conectaDB();
            
            // Consulta para obter todas as permissões
            $sql = "SELECT 
                m.COL_MODULES_NOME,
                p.COL_PERMISSIONS_NOME,
                p.COL_PERMISSIONS_ACTION,
                p.COL_PERMISSIONS_ID
            FROM 
                TBL_MODULES m
            JOIN 
                TBL_PERMISSIONS p ON m.COL_MODULES_ID = p.COL_PERMISSIONS_FK_MODULES_ID";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $dados; // Retorna os dados obtidos da consulta
            } else {
                return []; // Retorna um array vazio se nenhum resultado for encontrado
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao obter todas as permissões: " . $e->getMessage());
        }
    }
    
    public static function obter_Permissoes_Do_Usuario($USER_ID)
    {
        try {
            $conn = Database::conectaDB();
            
            $sql = "SELECT 
            p.COL_PERMISSIONS_ID,
            m.COL_MODULES_NOME,
            p.COL_PERMISSIONS_NOME,
            p.COL_PERMISSIONS_ACTION
        FROM 
            TBL_MODULES m
        JOIN 
            TBL_PERMISSIONS p ON m.COL_MODULES_ID = p.COL_PERMISSIONS_FK_MODULES_ID
        JOIN
            TBL_USERS_HAS_PERMISSIONS up ON p.COL_PERMISSIONS_ID = up.COL_USERS_HAS_PERMISSIONS_FK_PERMISSIONS_ID
        WHERE
            up.COL_USERS_HAS_PERMISSIONS_FK_USERS_ID = :USER_ID";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':USER_ID', $USER_ID, \PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $dados; // Retorna os dados obtidos da consulta
            } else {
                return []; // Retorna um array vazio se nenhum resultado for encontrado
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao obter permissões do usuário: " . $e->getMessage());
        }
    }

    public static function pode_Atualizar_Permissao_Usuario($permissions)
    {
        $pdo = Database::conectaDB();
        try {
            // Iniciar transação
            $pdo->beginTransaction();

            foreach ($permissions as $permission) {
                if ($permission['status'] === 1) {
                    // Verificar se a permissão já existe para o usuário
                    $checkQuery = "SELECT * FROM TBL_USERS_HAS_PERMISSIONS WHERE COL_USERS_HAS_PERMISSIONS_FK_USERS_ID = :userId AND COL_USERS_HAS_PERMISSIONS_FK_PERMISSIONS_ID = :permissionId";
                    $checkStmt = $pdo->prepare($checkQuery);
                    $checkStmt->execute([
                        ':userId' => $permission['userId'],
                        ':permissionId' => $permission['permissionId']
                    ]);
                    if ($checkStmt->rowCount() === 0) {
                        // Inserir permissão se não existir
                        $insertQuery = "INSERT INTO TBL_USERS_HAS_PERMISSIONS (COL_USERS_HAS_PERMISSIONS_FK_USERS_ID, COL_USERS_HAS_PERMISSIONS_FK_PERMISSIONS_ID) VALUES (:userId, :permissionId)";
                        $insertStmt = $pdo->prepare($insertQuery);
                        $insertStmt->execute([
                            ':userId' => $permission['userId'],
                            ':permissionId' => $permission['permissionId']
                        ]);
                    }
                } elseif ($permission['status'] === 0) {
                    // Excluir a permissão
                    $deleteQuery = "DELETE FROM TBL_USERS_HAS_PERMISSIONS WHERE COL_USERS_HAS_PERMISSIONS_FK_USERS_ID = :userId AND COL_USERS_HAS_PERMISSIONS_FK_PERMISSIONS_ID = :permissionId";
                    $deleteStmt = $pdo->prepare($deleteQuery);
                    $deleteStmt->execute([
                        ':userId' => $permission['userId'],
                        ':permissionId' => $permission['permissionId']
                    ]);
                }
            }

            // Commit da transação
            $pdo->commit();
            echo json_encode(["message" => "Permissões processadas com sucesso"]);
        } catch (\Exception $e) {
            // Rollback em caso de erro
            $pdo->rollback();
            echo json_encode(["message" => "Erro ao processar permissões: " . $e->getMessage()]);
        }
    }
}