<?php
/*
 * Struttura dati che crea in modo dinamico le viste
 */
class ViewDescriptor {
    /*
     * File che include la definizione del titolo della finestra del browser
     */
    private $titolo;
    /*
     * File che include la definizione del logo dell'applicazione
     */
    private $logo_file;
    /*
     * File che include la definizione del menu
     */
    private $menu_file;
    /*
     * File che include la definizione dell'errore
     */
    private $error_file;
    /*
     * File che include la definizione del contenuto principale
     */
    private $content_file;
    /*
     * File che include la definizione del footer
     */
    private $footer_file;
    
    /*
     * Restituisce il titolo della scheda del browser
     */
    public function getTitolo() {
        return $this->titolo;
    }
    
    /*
     * Imposta il titolo della scheda del browser
     */
    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }
    
    /*
     * Restituisce il path al file include la definizione HTML del logo
     */
    public function getLogoFile() {
        return $this->logo_file;
    }
    
    /*
     * Imposta il file che include la definizione HTML del logo
     */
    public function setLogoFile($logo_file) {
        $this->logo_file = $logo_file;
    }
    
    /*
     * Restituisce il menu
     */
    public function getMenuFile() {
        return $this->menu_file;
    }
    
    /**
     * Imposta il menu
     */
    public function setMenuFile($menuFile) {
        $this->menu_file = $menuFile;
    }
    
    /*
     * Restituisce l'errore
     */
    public function getErrorFile() {
        return $this->error_file;
    }
    
    /*
     * Imposta il contenuto
     */
    public function setErrorFile($error_file) {
        $this->error_file = $error_file;
    }
    
    /*
     * Restituisce il contenuto
     */
    public function getContentFile() {
        return $this->content_file;
    }
    
    /*
     * Imposta il contenuto
     */
    public function setContentFile($content_file) {
        $this->content_file = $content_file;
    }
    
    /*
     * Restituisce il footer
     */
    public function getFooterFile() {
        return $this->footer_file;
    }
    
    /*
     * Imposta il footer
     */
    public function setFooterFile($footer_file) {
        $this->footer_file = $footer_file;
    }
}

?>
