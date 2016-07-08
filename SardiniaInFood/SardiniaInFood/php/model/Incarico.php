<?php
/*
* Classe che rappresenta l'incarico ricoperto dentro l'azienda da chi effettua 
* l'iscrizione nell'applicazione
*/
class Incarico

	{
	/*
	* Tipo di incarico svolto
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
		$this->id = $id;
		}

	/*
	* Restituisce il tipo di incarico
	*/
	public function getTipo()
		{
		return $this->tipo;
		}

	/*
	* Imposta il tipo di incarico
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
		if (!isset($intVal))
			{
			return false;
			}

		$this->id = $intVal;
		}
	}

?>
