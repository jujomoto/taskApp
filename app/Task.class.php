<?php

require_once '../core/Utilidad.php';

class Task extends Utilidad {
	public $id;
	public $name;
	public $description;

	public function list () {
		$this->query = "SELECT * FROM task";
		return $this->execute();
	}

	public function filter () {
		$filter1 = (!empty($this->id))? "id={$this->id}" : '' ;
		$filter2 = (!empty($this->name))? "name LIKE '%$this->name%'" : '';
		$filter3 = (!empty($this->description))? "description=$this->description" : '' ;
		$this->query = "SELECT * FROM task WHERE $filter1 $filter2 $filter3";
		return $this->execute();


	}
	
	
	public function add () {
		$this->query = "INSERT INTO task (name,description) VALUES('$this->name','$this->description')";
		return $this->execute();
	}

	public function edit () {
		$this->query = "UPDATE task SET name='$this->name',description='$this->description' WHERE id=$this->id";
		return $this->execute();
	}

	public function delete () {
		$this->query = "DELETE FROM task WHERE id=$this->id";
		return $this->execute();
	}

}





?>