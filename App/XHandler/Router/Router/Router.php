<?php

namespace App\XHandler\Router\Router;


use App\XHandler\Http\Http;
use App\XHandler\Router\Routes\Routes;
use App\XHandler\Render\Render\Render;
use App\XHandler\Access\Access;


class Router
{
    public static function ROUTER()
    {
        $METHOD =   Http::RETURN_METHOD();
        $URI    =   Http::RETURN_URI();
        $QUERY  =   Http::RETURN_QUERY();

        $RESULT_COMPLETE_ROUTE = self::VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY);

        // Se (Uri/Url) requisitada pelo usuario não for enctrada redireciona para pagina de erro
        if ($RESULT_COMPLETE_ROUTE === NULL) {
            self::ERROR_PAGE();
            return;
        }

        $RESULT_ROUTE_CONTROLLER_ACTION =  self::RETURN_CONTROLLER_AND_ACTION($RESULT_COMPLETE_ROUTE);

        $CONTROLLER_NAME = $RESULT_ROUTE_CONTROLLER_ACTION['Controller']['Component'];

        $CONTROLLER_ACTION = $RESULT_ROUTE_CONTROLLER_ACTION['Controller']['Action'];

        return self::VERIFY_IF_ROUTE_NEEDS_LOGGIN($URI, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD);
    }

    public static function VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY)
    {
        $ROUTES = Routes::ROUTES();
        $URI_EXIST_IN_ROUTE = self::VERIFY_IF_URI_EXIST_IN_ROUTE($URI, $ROUTES);
        $METHOD_EXIST_IN_ROUTE = self::VERIFY_IF_METHOD_EXIST_IN_ROUTE($METHOD, $ROUTES, $URI);

        if ($URI_EXIST_IN_ROUTE === TRUE || $METHOD_EXIST_IN_ROUTE === TRUE) {
            return $ROUTES[$URI][$METHOD];
        } else {
            return NULL;
        }
    }


    public static function VERIFY_IF_URI_EXIST_IN_ROUTE($URI, $ROUTES)
    {
        return array_key_exists($URI, $ROUTES);
    }

    public static function VERIFY_IF_METHOD_EXIST_IN_ROUTE($METHOD, $ROUTES, $URI)
    {
        return isset($ROUTES[$URI]) && array_key_exists($METHOD, $ROUTES[$URI]);
    }

    public static function RETURN_CONTROLLER_AND_ACTION($RESULT_COMPLETE_ROUTE)
    {
        $ROUTE_IN_PARTS = [];

        foreach ($RESULT_COMPLETE_ROUTE as $KEY => $VALUE) {
            // Primeiro, dividimos pelo último '@' para garantir que a ação
            // seja extraída corretamente, mesmo que ela contenha '@'
            $lastAtIndex = strrpos($VALUE, '@');
            $COMPONENT = substr($VALUE, 0, $lastAtIndex);
            $ACTION = substr($VALUE, $lastAtIndex + 1);

            // Se houver uma barra '/', consideramos o componente como uma única unidade
            if (strpos($COMPONENT, '/') !== false) {
                $COMPONENT = explode('/', $COMPONENT);
            }

            $ROUTE_IN_PARTS[$KEY] = [
                'Component' => $COMPONENT,
                'Action'    => $ACTION
            ];
        }

        return $ROUTE_IN_PARTS;
    }

    public static function VERIFY_IF_ROUTE_NEEDS_LOGGIN($URI, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD)
    {

        $ROUTES_NOT_LOGGIN = Routes::ROUTES_THAT_DONT_NEED_LOGGIN();
        $ROUTES_NOT_PERMISSION = Routes::ROUTES_THAT_DONT_NEED_PERMISSION();
        if (array_key_exists($URI, $ROUTES_NOT_LOGGIN)) {
            Render::RENDER($CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD);
        } else {
            //$_SESSION['SESSION_ID'] = 1; //Para testes
            if (Access::ACCESS()) {
                if (array_key_exists($URI, $ROUTES_NOT_PERMISSION)) {
                    Render::RENDER($CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD);
                } else {
                    if (in_array($CONTROLLER_ACTION, $_SESSION['user_permissions'])) {
                        Render::RENDER($CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD);
                    } else {
                        //var_dump( $_SESSION['user_permissions']);
                        echo "Sem Permissão";
                    }
                }
            } else {
                header("Location: /login");
                exit();
            }
        }
    }


    public static function ERROR_PAGE()
    {
        header("Location: /page-not-found");
        exit();
    }
}
