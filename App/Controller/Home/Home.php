<?php

namespace App\Controller\Home;
use App\Model\Home\Home as HomeModel;

require_once __DIR__ . '/../../../config-env.php';


class Home
{
    public static function get()
    {
        // Implementação da função GET
    }

    public static function post()
    {

        HomeModel::post();
    }
}

?>