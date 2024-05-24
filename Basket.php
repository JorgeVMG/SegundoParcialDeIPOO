<?php
class Basket extends Partido{
    private $coef_penalizacion;
    private $cant_infracciones;
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$cantInfrac){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coef_penalizacion = 0.75;
        $this->cant_infracciones = $cantInfrac;
    }
    public function getCoefPenalizacion(){
        return $this->coef_penalizacion;
    }
    public function setCoePenalizacion($coefPenal){
        $this->coef_penalizacion = $coefPenal;
    }
    public function getCanInfracciones(){
        return $this->cant_infracciones;
    }
    public function setCanInfracciones($cantInfrac){
        $this->cant_infracciones = $cantInfrac;
    }
    public function coeficientePartido(){
        $coeficiente_base_partido = parent:: coeficientePartido();
        $coef_penalizacion = $this->getCoefPenalizacion();
        $cant_infracciones = $this->getCanInfracciones();
        $coef =0;
        $coef = $coeficiente_base_partido-($coef_penalizacion*$cant_infracciones);
        return $coef;
    }

}