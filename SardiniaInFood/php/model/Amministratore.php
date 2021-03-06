<?php
/*
 * Classe che rappresenta un generico utente del sistema
 */

class Amministratore
{
    /*
    * Costante che definisce il ruolo azienda
    */
    const Amministratore = 2;
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
    /*
    * Il ruolo dell'amministratore
    */ 
    private $ruolo;
    
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
        if (!isset($intVal)) {
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
    /*
	* Imposta un ruolo dell'amministratore
	*/
	public function setRuolo($ruolo)
		{
		switch ($ruolo)
			{
		case self::Amministratore:
			$this->ruolo = $ruolo;
			return true;
		default:
			return false;
			}
		}
    /*
    * Restituisce un intero corrispondente al ruolo
    */
    public function getRuolo()
    {
    return $this->ruolo;
    }
}
?>

