<?php 
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) {
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
            //validar que no haya campos vacios
            $errores = $vendedor->validar();
            // No hay errores
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router) {
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        // obtener datos del vendedor
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Asignar los valores
            $args = $_POST['vendedor'];
            //sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);
            // validacion 
            $errores = $vendedor->validar();
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function eliminar() {
        
    }
}