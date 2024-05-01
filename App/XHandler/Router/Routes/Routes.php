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
            "/home" => "home",
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
            /* Inicio das rotas de Usuario */
            "/administrativo/usuarios" => [
                "GET" => [
                    "Controller" => "Administrativo/Usuarios@pode_Visualizar_Usuarios",
                ],
                "POST" => [
                    "Controller" => "Administrativo/Usuarios@post",
                ],
            ],

            "/administrativo/usuarios/inserirusuario" => [
                "GET" => [
                    "Controller" => "Administrativo/Usuarios/InserirUsuario@pode_Visualizar_Insercao_De_Usuario",
                ],
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/InserirUsuario@pode_Inserir_Usuario",
                ],
            ],

            "/administrativo/usuarios/editarusuario" => [
                "GET" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Visualizar_Edicao_De_Usuario",
                ],
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Editar_Usuario",
                ],
            ],

            "/administrativo/usuarios/editarusuario/enviarsenha" => [
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Enviar_Senha_Do_Usuario",
                ],
            ],

            "/administrativo/usuarios/editarusuario/alterarsenha" => [
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Alterar_Senha_Do_Usuario",
                ],
            ],

            "/administrativo/usuarios/editarusuario/desativar" => [
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Desativar_Usuario",
                ],
            ],


            "/administrativo/usuarios/editarusuario/ativar" => [
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Ativar_Usuario",
                ],
            ],

            "/administrativo/usuarios/editarusuario/updatepermissao" => [
                "POST" => [
                    "Controller" => "Administrativo/Usuarios/EditarUsuario@pode_Atualizar_Permissao_Usuario",
                ],
            ],
            /* Fim das rotas de Usuario */
        ];
    }
}
