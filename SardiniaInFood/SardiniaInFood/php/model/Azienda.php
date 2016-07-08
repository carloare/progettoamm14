<?php
include_once 'Utente.php';

/*
* Classe che rappresenta un generica azienda
*/
class Azienda extends Utente

	{
	/*
	* Tipo di incarico ricoperto da chi effettua la registrazione
	*/
	private $tipo_incarichi_id;
	/*
	* Nome dell'azienda
	*/
	private $nome_azienda;
	/*
	* Citta dell'azienda
	*/
	private $citta;
	/*
	* Indirizzo dell'azienda
	*/
	private $indirizzo;
	/*
	* Tipo di attività  che svolge l'azienda
	*/
	private $tipo_attivita_id;
	/*
	* Descrizione dell'azienda
	*/
	private $descrizione;
	/*
	* Telefono dell'azienda
	*/
	private $telefono;
	/*
	* Email dell'azienda
	*/
	private $email;
	/*
	* Sito Web dell'azienda
	*/
	private $sito_web;
	/*
	* Costruttore
	*/
	public

	function __construct()
		{

		// richiamiamo il costruttore della superclasse

		parent::__construct();
		$this->setRuolo(Utente::Azienda);
		}

	/*
	* Imposta il tipo di incarico ricoperto da chi effettua l'iscrizione dell'azienda
	*/
	public function setTipo_incarichi_id($tipo_incarichi_id)
		{
		$this->tipo_incarichi_id = $tipo_incarichi_id;
		}

	/*
	* Restituisce il tipo di incarico ricoperto da chi effettua l'iscrizione dell'azienda
	*/
	public function getTipo_incarichi_id()
		{
		return $this->tipo_incarichi_id;
		}

	/*
	* Restituisce il nome dell'azienda
	*/
	public function getNomeAzienda()
		{
		return $this->nome_azienda;
		}

	/*
	* Imposta il nome dell'azienda
	*/
	public function setNomeAzienda($nome_azienda)
		{
		$this->nome_azienda = $nome_azienda;
		return true;
		}

	/*
	* Imposta la città 
	*/
	public function setCitta($citta)
		{
		$this->citta = $citta;
		}

	/*
	* Restituisce la città 
	*/
	public function getCitta()
		{
		return $this->citta;
		}

	/*
	* Imposta l'indirizzo
	*/
	public function setIndirizzo($indirizzo)
		{
		$this->indirizzo = $indirizzo;
		}

	/*
	* Restituisce l'indirizzo
	*/
	public function getIndirizzo()
		{
		return $this->indirizzo;
		}

	/*
	* Imposta il tipo di attività  svolto dall'azienda
	*/
	public function setTipo_attivita_id($tipo_attivita_id)
		{
		$this->tipo_attivita_id = $tipo_attivita_id;
		}

	/*
	* Restituisce il tipo dei attività 
	*/
	public function getTipo_attivita_id()
		{
		return $this->tipo_attivita_id;
		}

	/*
	* Imposta la descrizione
	*/
	public function setDescrizione($descrizione)
		{
		$this->descrizione = $descrizione;
		}

	/*
	* Restituisce la descrizione
	*/
	public function getDescrizione()
		{
		return $this->descrizione;
		}

	/*
	* Imposta il numero di telefono
	*/
	public function setTelefono($telefono)
		{
		$this->telefono = $telefono;
		}

	/*
	* Restituisce il numero di telefono
	*/
	public function getTelefono()
		{
		return $this->telefono;
		}

	/*
	* Restituisce l'email dell'azienda
	*/
	public function getEmail()
		{
		return $this->email;
		}

	/*
	* Imposta una nuova email per l'azienda
	*/
	public function setEmail($email)
		{
		$this->email = $email;
		return true;
		}

	/*
	* Restituisce l'indirizzo del sito web
	*/
	public function getSitoWeb()
		{
		return $this->sito_web;
		}

	/*
	* Imposta la descrizione
	*/
	public function setSitoWeb($sito_web)
		{
		$this->sito_web = $sito_web;
		}
	}

?>
