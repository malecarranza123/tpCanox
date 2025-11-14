<?php

class Encuesta {

    private string $nombre;
    private string $comida;
    public static int $totalVotos = 0; // propiedad estática

    public function __construct(string $nombre, string $comida){
        $this->nombre = $nombre;
        $this->comida = $comida;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getComida(){
        return $this->comida;
    }

    public function registrarVoto(array $votos){
        // función nativa: array_key_exists
        if (array_key_exists($this->comida, $votos)) {
            $votos[$this->comida]++;
            self::$totalVotos++;
        }
        return $votos;
    }
}
