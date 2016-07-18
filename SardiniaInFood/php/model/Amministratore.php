<?php
/*
* Classe che rappresenta un generico utente del sistema
*/
class Amministratore

	{
	/*
	* Identificatore dell'utente
	*/
	private $id;
	/*
	* Nome di un generico utente
	*/
	private $nome_completo;
	/*
	* Username per l'autenticazione
	*/
	private $username;
	/*
	* Password per l'autenticazione
	*/
	private $password;
	
        
	public function __construct()
		{
		}

	/*
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
		if (!isset($intVal))
			{
			return false;
			}

		$this->id = $intVal;
		}

	/*
	* Restituisce il nome dell'utente
	*/
	public function getNomeCompleto()
		{
		return $this->nome_completo;
		}

	/*
	* Imposta il nome dell'utente.
	*/
	public function setNomeCompleto($nome_completo)
		{
		$this->nome_completo = $nome_completo;
		return true;
		}


	/*
	* Restituisce lo username dell'utente
	*/
	public function getUsername()
		{
		return $this->username;
		}

	/*
	* Imposta lo username dell'utente
	*/
	public function setUsername($username)
		{
		$this->username = $username;
		return true;
		}

	/*
	* Restituisce la password per l'utente
	*/
	public function getPassword()
		{
		return $this->password;
		}

	/*
	* Imposta la password per l'utente
	*/
	public function setPassword($password)
		{
		$this->password = $password;
		return true;
		}

	
                
	}

?>

