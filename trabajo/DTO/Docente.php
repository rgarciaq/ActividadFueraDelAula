<?php


class Docente {
	private $id;
	private $nombre;
	private $dni;
	private $nrp;
	private $domicilio;
	private $telefono;
    private $dto;


	 function __construct($id, $nombre, $dni, $nrp, $domicilio, $telefono, $dto) {

        $this->id = $id;

        $this->nombre = $nombre;

        $this->dni = $dni; 
        
        $this->nrp = $nrp;    

        $this->domicilio = $domicilio;    

        $this->telefono = $telefono ; 
        
        $this->dto = $dto;

    }

    public function getDto() {

        return $this->dto;

    }

    public function getNombre() {

        return $this->nombre;

    }

    public function getId() {

        return $this->id;

    }

    public function getDni() {

        return $this->dni;

    }

    public function getNrp() {

        return $this->nrp;

    }

    public function getDomicilio() {

        return $this->domicilio;

    }

    public function getTelefono() {

        return $this->telefono;

    }


    
}
?>