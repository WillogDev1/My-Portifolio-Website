<?php

namespace App\Controller\Administrativo\Usuarios\InserirUsuario;

class AuxInserirUsuario
{
    public static function is_Email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_Vazio($nomeCompleto, $email, $password, $cpf)
    {
        return !(empty($nomeCompleto) || empty($email) || empty($password) || empty($cpf));
    }

    public static function is_Cpf_Number($cpf)
    {
     // Extrai somente os números
     $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
     // Verifica se foi informado todos os digitos corretamente
     if (strlen($cpf) != 11) {
         return false;
     }
 
     // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
     if (preg_match('/(\d)\1{10}/', $cpf)) {
         return false;
     }
 
     // Faz o calculo para validar o CPF
     for ($t = 9; $t < 11; $t++) {
         for ($d = 0, $c = 0; $c < $t; $c++) {
             $d += $cpf[$c] * (($t + 1) - $c);
         }
         $d = ((10 * $d) % 11) % 10;
         if ($cpf[$c] != $d) {
             return false;
         }
     }
     return true;
    }

    public static function validate_Admin_Create_User_Input($nomeCompleto, $email, $cpf, $password)
    {
        if (!self::is_Vazio($nomeCompleto, $email, $cpf, $password))
        {
            echo json_encode(["message" => "Por favor, preencha todos os campos."]);
            return false;
        } elseif (!self::is_Email($email))
        {
            echo json_encode(["message" => "Por favor, preencha um email valido."]);
            return false;
        } elseif (!self::is_Cpf_Number($cpf)){
            echo json_encode(["message" => "Digite um Cpf valido"]);
        }
        else{
            return ['nomeCompleto' => $nomeCompleto, 'email' => $email, 'cpf' => $cpf, 'password' => $password];
        }
    }
}