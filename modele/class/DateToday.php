<?php

/**
 * Class Date
 * Permet de générer un formulaire rapidement et simplement
 */


class DateToday{
 

    public function __construct(){
		
    }

    public static function Today(){ //Retourne la date d'aujourd'hui
		
			$today = date("Y-m-d");

			return $today;
	}
}