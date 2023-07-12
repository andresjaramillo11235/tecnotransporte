<?php

class TemplateController {
    
    public function index() {
        include 'views/template.php';
    }
    
    // Ruta
    static public function path() {
        return 'http://grc-gps.com/';
        //return 'http://localhost';
    }
    
}
