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

    public static function ROUTES_THAT_DONT_NEED_PERMISSION()
    {
        return [
            "/" => "",
            "/login" => "login",
            "/perfil" => "perfil",
            "/perfil/atualiza-senha" => "perfil",
            "/login/recoveraccess" => "login",
            "/login/firstaccess" => "login"
        ];
    }


    public static function ROUTES()
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
                    "Controller" => "Home@pode_Visualizar_Home",
                ],
                "POST" => [
                    "Controller" => "Home@post",
                ],
            ],
    
            "/perfil" => [
                "GET" => [
                    "Controller" => "Perfil@pode_Visualizar_Perfil",
                ],
                "POST" => [
                    "Controller" => "Perfil@post",
                ],
            ],

            "/perfil/atualiza-senha" => [
                "POST" => [
                    "Controller" => "Perfil@pode_Atualizar_Senha",
                ],
            ],
    
            "/administrativo" => [
                "GET" => [
                    "Controller" => "Administrativo@pode_Visualizar_Administrativo",
                ],
                "POST" => [
                    "Controller" => "Administrativo@post",
                ],
            ],
    ];
    }
}
