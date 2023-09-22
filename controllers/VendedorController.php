<?php 
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear(Router $router) {
        $errores = Vendedor::getErrores();
        $vendedor = New Vendedor;

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar() {
        
    }
    public static function eliminar() {
        
    }
}