<?php
namespace Person\Model;

class PersonTable
{
	protected $tableGateway;

	public function __construct(CsvGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getPerson($id){
		$id  = (int) $id;
		$rowset = $this->tableGateway->select();
		$row = $rowset[$id - 1];
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		$row->id = $id;
		return $row;
	}

	public function savePerson(Person $person){
		$data = array(
				'name' => $person->name,
				'surname'  => $person->surname,
		);

		$id = (int) $person->id;
		if ($id == 0) {
			$set = array($data['name'], $data['surname']);
			$this->tableGateway->insert($set);
		} else {
			if ($this->getPerson($id)) {
				$this->tableGateway->update($data, $id);
			} else {
				throw new \Exception('Person id does not exist');
			}
		}
	}

	public function deletePerson($id){
		$this->tableGateway->delete(array('id' => (int) $id));
	}
}