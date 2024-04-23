<?php

namespace App\Model\Login\RecoverAccess\SenderRecoverEmail;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use App\Model\Database\Database;


class AuxSenderRecoverEmail
{
    public static function create_Temporary_Token_For_Change_Password()
    {
    $tamanho = 6;
    // Define os caracteres possíveis para a senha
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    
    // Obtém o tamanho total dos caracteres possíveis
    $quantidade_caracteres = strlen($caracteres);
    
    // Inicializa a senha como uma string vazia
    $senha = '';
    
    // Gera cada caractere da senha
    for ($i = 0; $i < $tamanho; $i++) {
        // Escolhe um caractere aleatório do conjunto de caracteres possíveis
        $indice_aleatorio = rand(0, $quantidade_caracteres - 1);
        
        // Adiciona o caractere escolhido à senha
        $senha .= $caracteres[$indice_aleatorio];
    }
    
    // Retorna a senha gerada
    return $senha;
    }
    public static function email_Exist_In_Data_Base($email_To_Send_Recover)
    {
        $conn = Database::conectaDB();
        $sql = "SELECT COL_USERS_EMAIL
                FROM TBL_USERS 
                WHERE COL_USERS_EMAIL = :email_To_Send_Recover LIMIT 1";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email_To_Send_Recover', $email_To_Send_Recover, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                self::send_Email_Recover_Password($email_To_Send_Recover);
            } else {
                $response = ['success' => false, 'message' => "Email Não Encontrado: $email_To_Send_Recover"];
                echo json_encode($response);
            }
        } catch (\PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }

    public static function send_Email_Recover_Password($email_To_Send_Recover)
    {
        $temporary_Password_Randon_Generate = self::create_Temporary_Token_For_Change_Password();
        try {
            // Configurar o transporte de e-mail
            $transport = Transport::fromDsn('smtp://' . $_ENV['EMAIL_RESET_PASSWORD'] . ':' . $_ENV['PASSWORD_EMAIL_RESET'] . '@smtp.gmail.com');
            $mailer = new Mailer($transport);

            // Criar e configurar o e-mail
            $email = (new Email())
                ->from('bill.uba@gmail.com')
                ->to($email_To_Send_Recover)
                ->subject('Solicitação para alterar senha')
                ->text('Sending emails is fun again!')
                ->html("<p>Sua senha temporaria: $temporary_Password_Randon_Generate</p>");

            // Enviar o e-mail
            $mailer->send($email);

            //echo json_encode(['success' => true, 'message' => "E-mail de recuperação enviado para: $email_To_Send_Recover"]);
            self::update_User_For_Recover_Access($email_To_Send_Recover, $temporary_Password_Randon_Generate);

        } catch (TransportExceptionInterface $e) {
            echo json_encode(['success' => false, 'message' => "Erro ao enviar e-mail de recuperação: " . $e->getMessage()]);
        }
    }

    public static function update_User_For_Recover_Access($email_To_Send_Recover, $temporary_Password_Randon_Generate)
    {
        $conn = Database::conectaDB();
        $sql = "SELECT COL_USERS_EMAIL, COL_USERS_IS_CHANGING_PASSWORD, COL_USERS_TEMPORARY_PASSWORD
                FROM TBL_USERS 
                WHERE COL_USERS_EMAIL = :email_To_Send_Recover LIMIT 1";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email_To_Send_Recover', $email_To_Send_Recover, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                // Atualizar os valores no banco de dados
                $updateSql = "UPDATE TBL_USERS 
                              SET COL_USERS_IS_CHANGING_PASSWORD = true, 
                                  COL_USERS_TEMPORARY_PASSWORD = :temporary_Password_Randon_Generate,
                                  COL_USERS_PASSWORD = :passwordConfirmHash
                              WHERE COL_USERS_EMAIL = :email_To_Send_Recover";
                //$temporaryPassword = "password"; // Definindo a senha temporária como "password", você pode alterar conforme necessário
                $passwordConfirmHash = password_hash($temporary_Password_Randon_Generate, PASSWORD_BCRYPT);

                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bindParam(':temporary_Password_Randon_Generate', $temporary_Password_Randon_Generate, \PDO::PARAM_STR);
                $updateStmt->bindParam(':email_To_Send_Recover', $email_To_Send_Recover, \PDO::PARAM_STR);
                $updateStmt->bindParam(':passwordConfirmHash', $passwordConfirmHash, \PDO::PARAM_STR);
                $updateStmt->execute();

                echo json_encode(['success' => true, 'message' => "E-mail de recuperação enviado para: $email_To_Send_Recover"]);
            } else {
                $response = ['success' => false, 'message' => "Email Não Encontrado: $email_To_Send_Recover"];
                echo json_encode($response);
            }
        } catch (\PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
}