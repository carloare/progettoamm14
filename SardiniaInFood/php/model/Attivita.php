<?php
/*
 * Classe che rappresenta una generica attività
 */

class Attivita
{
    /*
     * Tipo di attività  svolta
     */
    private $tipo;
    /*
     * Identificatore dell'utente
     */
    private $id;
    
    /**
     * Costruttore
     */
    public function __constructor($tipo, $id)
    {
        $this->tipo = $tipo;
        $this->id   = $id;
    }
    
    /*
     * Restituisce il tipo dell'attività 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    /*
     * Imposta il tipo dell'attività 
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return true;
    }
    
    /**
     * Restituisce un identificatore unico per l'utente
     */
    public function getId()
    {
        return $this->id;
    }
    
    /*
     * Imposta un identificatore unico per l'utente
     */
    public function setId($id)
    {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
    }
}
?>
