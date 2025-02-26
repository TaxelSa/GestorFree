<?php

class View{
  public function __construct( ) {
    //echo "Vista base";
  }

  public function render($view, $data = []) {
    $viewPath = 'views/' . $view . '.php';
    
    if (file_exists($viewPath)) {
        if (!empty($data)) {
            extract($data);
        }
        require $viewPath;
    } else {
        throw new Exception("Vista '$view' no encontrada.");
    }
  }
}