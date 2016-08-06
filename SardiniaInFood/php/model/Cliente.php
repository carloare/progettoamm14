<?php
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Utente.php';
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
	* Imposta se l'utente è bannato
	*/
	public function setBannato($bannato)
		{
		$this->bannato = $bannato;
		return true;
		}        
        /*
	* Restituisce se l'utente è bananto
	*/
	public function getBannato()
		{
		return $this->bannato;
		}
                
	}
?>

