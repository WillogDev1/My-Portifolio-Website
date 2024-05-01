<?php

namespace App\Model\Administrativo\Usuarios\InserirUsuario;
use App\Model\Database\Database;
class InserirUsuario
{
    public static function pode_Visualizar_Insercao_De_Usuario()
    {
        // Implementação da função GET
        $DATA = str_replace('InserirUsuario', __CLASS__, 'InserirUsuario - Works');
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }

    public static function pode_Inserir_Usuario($nomeCompleto, $email, $cpf, $password)
    {
        try {
            $conn = Database::conectaDB();
            
            // Verificar se o email já existe na tabela TBL_USERS
            $stmtCheckEmail = $conn->prepare("SELECT COUNT(*) FROM TBL_USERS WHERE COL_USERS_EMAIL = :email");
            $stmtCheckEmail->bindParam(':email', $email);
            $stmtCheckEmail->execute();
            $emailExists = $stmtCheckEmail->fetchColumn();
    
            if ($emailExists) {
                // Se o email já existe, retornar uma mensagem de erro
                echo json_encode(["message" => "Email já existe"]);
                return;
            }
    
            // Inserir dados na tabela TBL_PEOPLE
            $stmtPeople = $conn->prepare("INSERT INTO TBL_PEOPLE (COL_PEOPLE_NAME, COL_PEOPLE_CPF) VALUES (:nomeCompleto, :cpf)");
            $stmtPeople->bindParam(':nomeCompleto', $nomeCompleto);
            $stmtPeople->bindParam(':cpf', $cpf);
            $stmtPeople->execute();
            
            // Obter o ID do usuário inserido
            $userId = $conn->lastInsertId();
    
            // Encriptar a senha
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Inserir dados na tabela TBL_USERS
            $stmtUsers = $conn->prepare("INSERT INTO TBL_USERS (COL_USERS_EMAIL, COL_USERS_PASSWORD, COL_USERS_IS_ACTIVE, COL_USERS_IS_FIRST_LOGGIN, COL_USERS_FK_PEOPLE_ID) VALUES (:email, :password, 1, 1, :userId)");
            $stmtUsers->bindParam(':email', $email);
            $stmtUsers->bindParam(':password', $hashedPassword);
            $stmtUsers->bindParam(':userId', $userId);
            $stmtUsers->execute();
            
            echo json_encode(["message" => "Usuário inserido com sucesso!"]);
    
        } catch (\PDOException $e) {
            // Retornar uma resposta de erro genérica para outros erros
            echo json_encode(["message" => "Erro ao criar usuário: " . $e->getMessage()]);
        }
    }
    
    
    
}