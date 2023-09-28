<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)){
                //verificar si el usuario exite o no (mensaje de error)
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                //verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado){
                        // autenticar el usuario
                        $auth->autenticar();
                    }else{
                        // password incorrecto (mensaje de error)
                        $errores = Admin::getErrores();
                    }
                
                }
                
            }
        }

        $router->render('auth/login', [
            'errores' => $errores,
        ]);
    }

    public static function logout(Router $router){
        
    }
}