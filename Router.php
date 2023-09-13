<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
        
    }

    public function  comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        if($fn){
            // la url existe y hay una funcion asociada
            call_user_func($fn, $this); // llama a una funcion cuando no se sabe el nombre
        } else {

        }
    }

    // Muestra una vista
    public function render($view){
        ob_start(); // iniciar almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // limpia memoria

        include __DIR__ . "/views/layout.php";
    }


}