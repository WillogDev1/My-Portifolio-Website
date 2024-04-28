<?php

namespace App\Controller\Home;
use App\Model\Home\Home as HomeModel;

require_once __DIR__ . '/../../../config-env.php';


class Home
{
    public static function pode_Visualizar_Home()
    {
        // Implementação da função GET
    }

    public static function post()
    {

        HomeModel::post();
    }
}

?>