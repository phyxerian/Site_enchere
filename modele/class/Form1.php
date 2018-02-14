<?php

/**
 * Class Form
 * Permet de générer un formulaire rapidement et simplement
 */


class Form1{
 
    private $data;

    public $surround = 'p';


    public function __construct(){
		
    }

    public function confirmation(){
		    echo "Voulez-vous vraiment supprimer votre compte ? </br>";
			echo "<button type='submit' name='suppcompte'> Supprimer votre compte </button>";

	}
}