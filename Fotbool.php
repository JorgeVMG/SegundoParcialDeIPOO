<?php
class Futbool extends Partido{
    private $coef_Menores;
    private $coef_juveniles;
    private $coef_Mayores;
    
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coef_Menores = 0.13;
        $this->coef_juveniles = 0.19;
        $this->coef_Mayores = 0.27;
    }

    public function getCoefMenores(){
       return $this->coef_Menores;
    }
    public function setCoeMenores($coefMenores){
        $this->coef_Menores = $coefMenores;
    }
    public function getCoefJuveniles(){
        return $this->coef_juveniles;
    }
    public function setCoeJuveniles($coefJuveniles){
        $this->coef_juveniles = $coefJuveniles;
    }
    public function getCoefMayores(){
        return $this->coef_Mayores;
    }
    public function setCoeMayoes($coefMayores){
        $this->coef_Mayores = $coefMayores;
    }
    public function coeficientePartido(){
        $cantGoles = $this->getCantGolesE1() + $this->getCantGolesE2();
        $cantJugadores = $this->getObjEquipo2()->getCantJugadores() + $this->getObjEquipo1()->getCantJugadores();
        $categoria =$this->getObjEquipo1()->getObjCategoria()->getDescripcion();
        $coef = 0;
        if($categoria == "Menores"){
            $coefMn = $this->getCoefMenores();
            $coef = $coefMn * $cantGoles * $cantJugadores;
        }
        elseif($categoria == "juveniles"){
            $coefJ = $this->getCoefJuveniles();
            $coef = $coefJ * $cantGoles * $cantJugadores;
        }
        else{
            $coefMy = $this->getCoefMayores();
            $coef = $coefMy * $cantGoles * $cantJugadores;
        }   
        return $coef;
    }
}