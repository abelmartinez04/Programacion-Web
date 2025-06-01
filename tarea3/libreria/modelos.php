<?php 
/*
Identificación
Nombre
Apellido
Fecha de nacimiento
Foto del personaje
Profesión o Rol en el Mundo Barbie (Se debe elegir de una lista de profesiones)
Nivel de experiencia (Principiante, Intermedio, Avanzado)
*/

class personaje{
    public $identificacion;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $foto;
    public $profesion;
    public $nivel_experiencia;

    public function __construct($data = []){
        if(is_object($data)){
            $data = (array) $data;
        }
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
}

/* profesiones
Nombre de la profesión (Ejemplo: Veterinaria, Piloto, Diseñadora de Moda, Científica, Chef, etc.)
Categoría (Ciencia, Arte, Deporte, Entretenimiento, etc.)
Salario mensual estimado en dólares ($USD)
*/

class profesion{
    public $codigo;
    public $nombre;
    public $categoria;
    public $salario_mensual;

    public function __construct($data = []){
        if(is_object($data)){
            $data = (array) $data;
        }
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
}

class estadistica{
    public $nombre;
    public $cantidad;

    public function __construct($data = []){
        if(is_object($data)){
            $data = (array) $data;
        }
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
}
?>