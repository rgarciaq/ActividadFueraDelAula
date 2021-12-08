<?php


class Fichero {
	private $id;
	private $nombre;
    private $idPermiso;

    function __construct($id, $idPermiso, $nombre ) {

        $this->id = $id;

        $this->idPermiso = $idPermiso;

        $this->nombre = $nombre;


    
    }
    public function getId() {

        return $this->id;

    }
    public function getIdPermiso() {

        return $this->idPermiso;

    }

    public function getNombre() {

        return $this->nombre;

    }




}
?>