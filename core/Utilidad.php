<?php

class Utilidad {
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '';
	private $db = 'task-app';
	protected $con;
	public $action;
	public $query;

	public function __construct () {
		$this->conecction();
	}

	public function conecction () {
		$this->con = new mysqli($this->host,$this->user,$this->pass,$this->db);
	}

	public function execute() {
		return $this->con->query($this->query);
	}

	public function extractData ($puntero) {
		return $puntero->fetch_assoc();
	}

	public function setValue ($key,$value) {
		$this->$key = $value;
	}
}

?>