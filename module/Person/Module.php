<?php
namespace Person;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Person\Model\Person;
use Zend\Db\TableGateway\TableGateway;
use Person\Model\PersonTable;
use Person\Model\CsvGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig(){
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
						),
				),
		);
	}

	public function getConfig(){
		return include __DIR__ . '/config/module.config.php';
	}
		
		// Add this method:
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'Person\Model\PersonTable' => function ($sm) {
							$tableGateway = $sm->get ( 'PersonTableGateway' );
							$table = new PersonTable($tableGateway);
							return $table;
						},
						'PersonTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype (new Person());
							return new CsvGateway ( 'person', $dbAdapter, null, $resultSetPrototype );
						} 
				) 
		);
	}
}