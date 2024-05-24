<?php
class Torneo{
    private $coleccionPartidos;
    private $importePremio;
    
    public function __construct($colPartidos, $impor){
        $this->coleccionPartidos = $colPartidos;
        $this->importePremio = $impor;
    }
    public function getColePartidos(){
        return $this->coleccionPartidos;
    }
    public function setColePartidos($colPartidos){
        $this->coleccionPartidos = $colPartidos;
    }
    public function getImportePremio(){
        return $this->importePremio;
    }
    public function setImportePremio($impor){
        $this->importePremio = $impor;
    }
    public function retornarColeccionPartidos(){
        $cad= "";
        foreach($this->getColePartidos() as $unPartido){
            $cad .= $unPartido."\n";
        }
        return $cad;
    }
    public function __toString(){
        return "Partidos: \n".$this->retornarColeccionPartidos()."Importe de Premio: ".$this->getImportePremio()."\n";
    }
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){
        //$idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2
        //$idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$coefPenal,$cantInfrac
        $colPartidos = $this->getColePartidos();
        $i = (count($colPartidos))-1;
        $idpartido =($colPartidos[$i]->getIdpartido()+1);
        $cantGolesE1 = 0;
        $cantGolesE2 = 0;
        $objPartido = null;
        if($OBJEquipo1 != $OBJEquipo2){
            if($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()&& $OBJEquipo1->getObjCategoria() == $OBJEquipo2->getObjCategoria()){
                if($tipoPartido == "Futbol"){
                    $objPartido = new Futbool($idpartido,$fecha,$OBJEquipo1,$cantGolesE1,$OBJEquipo2,$cantGolesE2);
                    $colPartidos[] = $objPartido;
                    $this->setColePartidos($colPartidos);
                }else{
                    $coefPenal = 0;
                    $cantInfrac = 0;
                    $objPartido = new Basket($idpartido,$fecha,$OBJEquipo1,$cantGolesE1,$OBJEquipo2,$cantGolesE2,$coefPenal,$cantInfrac);
                    $colPartidos[] = $objPartido;
                    $this->setColePartidos($colPartidos);
                }   
            }
        }
        return $objPartido;
    }
    public function darGanadores($deporte){
        $colPartidos = $this->getColePartidos();
        $colGanadores = [];
        if($deporte == "Futbol"){
            foreach ($colPartidos as $unPartido){
                if($unPartido instanceof Futbool){
                    $colGanadores[] = $unPartido->darEquipoGanador();
                }
            }
        }
        else{
            foreach ($colPartidos as $unPartido){
                if($unPartido instanceof Basket){
                    $colGanadores[] = $unPartido->darEquipoGanador();
                }
            }
        }
        return $colGanadores;
    }
    public function calcularPremioPartido($OBJPartido){
        $colAsociativo = [];
        if($OBJPartido != null){ 
            $equipoGanador = $OBJPartido->darEquipoGanador();
            $premioPartido = $OBJPartido->coeficientePartido()*$this->getImportePremio();
            $colAsociativo = ["Equipo Ganador"=>$equipoGanador,"Premio Partido"=>$premioPartido];
        }
        return $colAsociativo; 
    }
}







