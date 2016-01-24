<?php
namespace Person\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\Feature\EventFeature;
use Zend\Db\TableGateway\Feature;
use Zend\Db\TableGateway\Feature\FeatureSet;
use Person\Model\Person;

abstract class AbstractCsvGateway implements TableGatewayInterface
{
	/**
	 * @var bool
	 */
	protected $isInitialized = false;
	
	/**
	 * @var AdapterInterface
	 */
	protected $adapter = null;
	
	/**
	 * @var string|array|CSV file path
	 */
	protected $file_path = null;
	
	/**
	 * @var array
	 */
	protected $columns = array();
	
	/**
	 * @var Feature\FeatureSet
	 */
	protected $featureSet = null;
	
	/**
	 * @var ResultSetInterface
	 */
	protected $resultSetPrototype = null;
	
	/**
	 * @var Sql
	 */
	protected $sql = null;
	
	/**
	 *
	 * @var int
	 */
	protected $lastInsertValue = null;
	
	/**
	 * @return bool
	 */
	public function isInitialized(){
		return $this->isInitialized;
	}
	
	/**
	 * Initialize
	 *
	 * @throws Exception\RuntimeException
	 * @return null
	 */
	public function initialize(){
		if ($this->isInitialized) {
			return;
		}
		$this->isInitialized = true;
	}
	
	/**
	 * Get table name
	 *
	 * @return string
	 */
	public function getTable(){
		return $this->table;
	}
	
	/**
	 * Select
	 *
	 * @param Where|\Closure|string|array $where
	 * @return ResultSet
	 */
	public function select($where = null){
		//TODO Leggere file CSV e ritornare dati
		$dataArray = array();
		if (($handle = fopen("/var/www/tech-test/module/Person/src/Person/Model/person.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$person = new Person();
				$person->name = $data[0];
				$person->surname = $data[1];
				
				$dataArray[] = $person;
			}
			fclose($handle);
		}
		
		return $dataArray;
	}
	
	/**
	 * Insert
	 *
	 * @param  array $set
	 * @return int
	 */
	public function insert($set){
		//TODO Write code to append in text file;
		$handle = fopen("/var/www/tech-test/module/Person/src/Person/Model/person.csv","a");
		fputcsv($handle, $set);
		fclose($handle);
	}
	
	/**
	 * Update
	 *
	 * @param  array $set
	 * @param  id to update
	 * @return int
	 */
	public function update($set, $where = null){
		$dataArray = $this->select();
		$dataArray[$where - 1]->name = $set['name'];
		$dataArray[$where - 1]->surname = $set['surname'];
		
		$handle = fopen("/var/www/tech-test/module/Person/src/Person/Model/person.csv","w");
		
		for ($i = 0; $i < count($dataArray); $i++){
			$set = array($dataArray[$i]->name, $dataArray[$i]->surname);
			fputcsv($handle, $set);
		}
		fclose($handle);
	}
	
	/**
	 * Delete
	 *
	 * @param  Where|\Closure|string|array $where
	 * @return int
	 */
	public function delete($where){
		//TODO Write code to delete from CSV file
	}
	
}