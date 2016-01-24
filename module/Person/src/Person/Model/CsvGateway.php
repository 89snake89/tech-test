<?php
namespace Person\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;
use Person\Model\AbstractCsvGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\TableGateway\Feature\FeatureSet;

class CsvGateway extends AbstractCsvGateway
{
	/**
	 * Constructor
	 *
	 * @param string|TableIdentifier|array                                              $table
	 * @param AdapterInterface                                                          $adapter
	 * @param Feature\AbstractFeature|Feature\FeatureSet|Feature\AbstractFeature[]|null $features
	 * @param ResultSetInterface|null                                                   $resultSetPrototype
	 * @param Sql|null                                                                  $sql
	 *
	 * @throws Exception\InvalidArgumentException
	 */
	
	public function __construct($file_path){
		
	}
	public function __construct($table, AdapterInterface $adapter, $features = null, ResultSetInterface $resultSetPrototype = null, Sql $sql = null)
	{
		// table
		if (!(is_string($table) || $table instanceof TableIdentifier || is_array($table))) {
			throw new Exception\InvalidArgumentException('Table name must be a string or an instance of Zend\Db\Sql\TableIdentifier');
		}
		$this->table = $table;

		// adapter
		$this->adapter = $adapter;

		// process features
		if ($features !== null) {
			if ($features instanceof Feature\AbstractFeature) {
				$features = array($features);
			}
			if (is_array($features)) {
				$this->featureSet = new Feature\FeatureSet($features);
			} elseif ($features instanceof Feature\FeatureSet) {
				$this->featureSet = $features;
			} else {
				throw new Exception\InvalidArgumentException(
						'TableGateway expects $feature to be an instance of an AbstractFeature or a FeatureSet, or an array of AbstractFeatures'
						);
			}
		} else {
			new Feature\FeatureSet();
			$this->featureSet = new Feature\FeatureSet();
		}

		// result prototype
		$this->resultSetPrototype = ($resultSetPrototype) ?: new ResultSet;

		// Sql object (factory for select, insert, update, delete)
		$this->sql = ($sql) ?: new Sql($this->adapter, $this->table);

		// check sql object bound to same table
		if ($this->sql->getTable() != $this->table) {
			throw new Exception\InvalidArgumentException('The table inside the provided Sql object must match the table of this TableGateway');
		}

		$this->initialize();
	}
}