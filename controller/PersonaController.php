<?php
require_once __DIR__ . '/../model/Persona.php';

class PersonaController {
    private $model;

    public function __construct() {
        $this->model = new Persona();
    }

    public function registrarPersona($nombre, $dni) {
        return $this->model->registrar($nombre, $dni);
    }

    public function buscarPorDNI($dni) {
        return $this->model->buscarPorDNI($dni);
    }
}
