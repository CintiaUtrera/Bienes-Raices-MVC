<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;

class PaginasController{
    public static function index(Router $router){
    
    $propiedades = Propiedad::get(3);
    $inicio = true;

    $router->render('paginas/index', [
    'propiedades' => $propiedades,
    'inicio' => $inicio
    ]);
}
public static function nosotros(Router $router){

}
public static function propiedades(Router $router){

}
public static function propiedad(Router $router){

}
public static function blog(Router $router){

}
public static function entrada(Router $router){

}
public static function contacto(Router $router){

}


}