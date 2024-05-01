<?php

namespace App\Controller\Administrativo\Usuarios\InserirUsuario;

use App\Model\Administrativo\Usuarios\InserirUsuario\InserirUsuario as InserirUsuarioModel;
use App\Controller\Administrativo\Usuarios\InserirUsuario\AuxInserirUsuario;
class InserirUsuario
{
    public static function pode_Visualizar_Insercao_De_Usuario()
    {
        // Implementação da função GET
    }

    public static function pode_Inserir_Usuario()
    {
        // Implementação da função POST
        //InserirUsuarioModel::post();
        
        $user_Input_Is_Valid = AuxInserirUsuario::validate_Admin_Create_User_Input($_POST['nomeCompleto'], $_POST['email'], $_POST['cpf'],$_POST['password']);
        if($user_Input_Is_Valid)
        {
            //LoginModel::loggin($user_Input_Is_Valid['username'], $user_Input_Is_Valid['password']);
            InserirUsuarioModel::pode_Inserir_Usuario($user_Input_Is_Valid['nomeCompleto'], $user_Input_Is_Valid['email'],$user_Input_Is_Valid['cpf'],$user_Input_Is_Valid['password']);
        }
    }

    public static function pode_Atualizar_Permissao_Usuario()
    {
        
    }
}