<?php
include_once 'Utente.php';
/*
* Classe che rappresenta un generico cliente
*/

class Cliente extends Utente

	{
	/*
	* Numero richiami
	*/
	private $numero_richiami;
        
        /*
	* bannato
	*/
	private $bannato;
        
	/*
	* Costruttore
	*/
	public function __construct()
		{

		// richiamiamo il costruttore della superclasse

		parent::__construct();
		$this->setRuolo(Utente::Cliente);
		}

	/*
	* Restituisce il numeri di richiami a carico del cliente
	*/
	public function getNumeroRichiami()
		{
		return $this->numero_richiami;
		}

	/*
	* Imposta il numero dei richiami a carica del cliente
	*/
	public function setNumeroRichiami($numero_richiami)
		{
		$this->numero_richiami = $numero_richiami;
		return true;
		}
                
        /*
	* Restituisce il numeri di richiami a carico del cliente
	*/
	public function getBannato()
		{
		return $this->bannato;
		}
                
	}
?>

