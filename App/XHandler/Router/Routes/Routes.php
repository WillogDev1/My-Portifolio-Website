<?php

namespace  App\XHandler\Router\Routes;

class Routes
{

    public static function ROUTES_THAT_DONT_NEED_LOGGIN()
    {
        return [
            "/" => "",
            "/login" => "login",
            "/login/recoveraccess/senderrecoveremail" => "login"
        ];
    }


    public static function ROUTES() // Adicionar um @ a mais se possivel, ou um "Permissao_ID" => "1"
    {
        return [
            "/page-not-found" => [
                "GET" => [
                    "Controller" => "PageNotFound@get",
                ],
            ],

            "/user-not-logging" => [
                "GET" => [
                    "Controller" => "UserNotLogging@get",
                ],
            ],

            "/" => [
                "GET" => [
                    "Controller" => "Login@get",
                ],
            ],

            /* Inicio Rotas e Subrotas para Login */      
            "/login" => [
                "GET" => [
                    "Controller" => "Login@get",
                ],
                "POST" => [
                    "Controller" => "Login@loggin",
                ],
            ],

            "/login/firstaccess" => [
                "GET" => [
                    "Controller" => "Login/FirstAccess@get",
                ],
                "POST" => [
                    "Controller" => "Login/FirstAccess@post",
                ],
            ],

            "/login/recoveraccess" => [
                "GET" => [
                    "Controller" => "Login/RecoverAccess@get",
                ],
                "POST" => [
                    "Controller" => "Login/RecoverAccess@post",
                ],
            ],

            "/login/recoveraccess/senderrecoveremail" => [
                "GET" => [
                    "Controller" => "Login/RecoverAccess/SenderRecoverEmail@get",
                ],
                "POST" => [
                    "Controller" => "Login/RecoverAccess/SenderRecoverEmail@post",
                ],
            ],
            /* Fim Rotas e Subrotas para Login */  
            "/home" => [
                "GET" => [
                    "Controller" => "Home@get",
                ],
                "POST" => [
                    "Controller" => "Home@post",
                ],
            ],
    ];
    }
}
