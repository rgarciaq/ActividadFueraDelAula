<?php


class Dto {
	private $id;
	private $nombre;
    function __construct($id, $nombre) {

        $this->id = $id;

        $this->nombre = $nombre;
    
    }
    public function getId() {

        return $this->dto;

    }

    public function getNombre() {

        return $this->nombre;

    }
}
?>