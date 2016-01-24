<?php
namespace Person\Model;

class Person{
	
	public $id;
	public $name;
	public $surname;
	
	public function exchangeArray($data){
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->name = (!empty($data['name'])) ? $data['name'] : null;
		$this->surname  = (!empty($data['surname'])) ? $data['surname'] : null;
	}
}