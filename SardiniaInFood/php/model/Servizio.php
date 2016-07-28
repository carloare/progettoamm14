<?php
/*
* Classe che rappresenta i servizi offerti dall'azienda
*/

class Servizio
	{
	/*
	* Tipo di servizio svolto
	*/
	private $tipo;
	/*
	* Identificatore del servizio
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
	* Restituisce il tipo di servizio
	*/
	public function getTipo()
		{
		return $this->tipo;
		}

	/*
	* Imposta il tipo di servizio
	*/
	public function setTipo($tipo)
		{
		$this->tipo = $tipo;
		return true;
		}

	/**
	 * Restituisce un identificatore unico per il servizio
	 */
	public function getId()
		{
		return $this->id;
		}

	/*
	* Imposta un identificatore unico per il servizio
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

