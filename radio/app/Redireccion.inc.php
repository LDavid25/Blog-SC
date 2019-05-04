<?php

class Redireccion {
    
    public function redirigir($url){
        header('location:' . $url, true, 301);
        die();
    }
}
