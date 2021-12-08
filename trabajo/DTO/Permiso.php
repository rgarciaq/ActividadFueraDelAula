<?php


class Permiso {
	private $id;
	private $idProfesor;
    private $nombreActividad;
    private $diaActividad;
    private $horario;
    function __construct($id, $idProfesor, $nombreActividad, $diaActividad,$horario) {

        $this->id = $id;

        $this->idProfesor = $idProfesor;

        $this->nombreActividad = $nombreActividad;

        $this->diaActividad = $diaActividad;

        $this->horario = $horario;

    
    }
    public function getId() {

        return $this->id;


        
    }
    public function getHorario() {

        return $this->horario;

    }

    public function getIdProfesor() {

        return $this->idProfesor;

    }

    public function getNombreActividad() {

        return $this->nombreActividad;

    }

    public function getDiaActividad() {

        return $this->diaActividad;

    }

}
?>