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
	 * @var string|array|TableIdentifier
	 */
	protected $table = null;
	
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
	
// 		if (!$this->featureSet instanceof Feature\FeatureSet) {
// 			$this->featureSet = new Feature\FeatureSet;
// 		}
	
// 		$this->featureSet->setTableGateway($this);
// 		$this->featureSet->apply(EventFeature::EVENT_PRE_INITIALIZE, array());
	
// 		if (!$this->adapter instanceof AdapterInterface) {
// 			throw new Exception\RuntimeException('This table does not have an Adapter setup');
// 		}
	
// 		if (!is_string($this->table) && !$this->table instanceof TableIdentifier && !is_array($this->table)) {
// 			throw new Exception\RuntimeException('This table object does not have a valid table set.');
// 		}
	
// 		if (!$this->resultSetPrototype instanceof ResultSetInterface) {
// 			$this->resultSetPrototype = new ResultSet;
// 		}
	
// 		if (!$this->sql instanceof Sql) {
// 			$this->sql = new Sql($this->adapter, $this->table);
// 		}
	
// 		$this->featureSet->apply(EventFeature::EVENT_POST_INITIALIZE, array());
	
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
		$row = 1;
		$dataArray = array();
		if (($handle = fopen("/var/www/tech-test/module/Person/src/Person/Model/person.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$person = new Person();
				$person->id = $data[0];
				$person->name = $data[1];
				$person->surname = $data[2];
				
				$dataArray[] = $person;
			}
			fclose($handle);
		}
		
		return $dataArray;
// 		if (!$this->isInitialized) {
// 			$this->initialize();
// 		}
	
// 		$select = $this->sql->select();
	
// 		if ($where instanceof \Closure) {
// 			$where($select);
// 		} elseif ($where !== null) {
// 			$select->where($where);
// 		}
	
// 		return $this->selectWith($select);
	}
	
	/**
	 * Insert
	 *
	 * @param  array $set
	 * @return int
	 */
	public function insert($set){
		//TODO Write code to append in text file;
	}
	
	/**
	 * Update
	 *
	 * @param  array $set
	 * @param  string|array|\Closure $where
	 * @return int
	 */
	public function update($set, $where = null){
		
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