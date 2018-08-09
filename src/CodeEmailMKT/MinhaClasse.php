<?php

namespace CodeEmailMKT;

class MinhaClasse {
	
	const MINHA_CONSTANTE = "minha constante";
	
	public $name;
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function getName(){
		return $this->name;
	}
	
}