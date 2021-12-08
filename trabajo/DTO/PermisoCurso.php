<?php


class PermisoCurso {
	private $idPermiso;
	private $idCurso;
    private $hora;
    function __construct($idPermiso, $idCurso, $hora) {

        $this->idPermiso = $idPermiso;

        $this->idCurso = $idCurso;

        $this->hora = $hora;
    
    }
    public function getIdPermiso() {

        return $this->idPermiso;

    }

    public function getIdCurso() {

        return $this->idCurso;

    }

    public function getHora() {

        return $this->hora;

    }
}
?>