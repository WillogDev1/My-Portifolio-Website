<?php

namespace App\Controller\Administrativo\Usuarios;

use App\Model\Administrativo\Usuarios\Usuarios as UsuariosModel;

class Usuarios
{
    public static function pode_Visualizar_Usuarios()
    {
        // Implementação da função GET
    }

    public static function post()
    {
        // Implementação da função POST
        UsuariosModel::post();
    }
}

?>