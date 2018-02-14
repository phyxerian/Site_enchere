<?php

/**
 * Class Form
 * Permet de générer un formulaire rapidement et simplement
 */


class Form{
    /**
     * @var array données utilisées par le formulaire
     */
    private $data;

    /**
     * @var string Tag utilisé pour entourer les champs
     */
    public $surround = 'p';

    /**
     * Form constructor. données utilisées par le formulaire
     * @param array $data
     */

    public function __construct($data = array()){
        $this->data =$data;
    }

    /**
     * @param $html Code htlm à entourer
     * @return string
     */
    private function surround($html){ //permet de mettre des balise p autour du code html
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * @param $index de la valeur à récupérer
     * @return mixed|null
     */
    public function getValue($index){ //verifie que index existe bien, si ça existe, this->data, sinon null
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * @param $name
     * @return string
     */
    public function input($name){
        return $this->surround(
         '<input type="text" name="' . $name . '"value="'. $this->getValue($name).'">'
    );
    }

    /**
     * boutton envoyer
     */
    public function submit(){
        echo '<button type="submit">Envoyer</button>';
    }
}