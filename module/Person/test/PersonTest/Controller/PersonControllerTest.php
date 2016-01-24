<?php
namespace PersonTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PersonControllerTest extends AbstractHttpControllerTestCase
{
	public function setUp(){
		$this->setApplicationConfig(
				include '/var/www/tech-test/config/application.config.php'
				);
		parent::setUp();
	}
	
	public function testIndexActionCanBeAccessed(){
		$this->dispatch('/person');
		$this->assertResponseStatusCode(200);
	
		$this->assertModuleName('Person');
		$this->assertControllerName('Person\Controller\Person');
		$this->assertControllerClass('PersonController');
		$this->assertMatchedRouteName('person');
	}
	
	public function testAddActionCanBeAccessed(){
		$this->dispatch('/person/add');
		$this->assertResponseStatusCode(200);
	
		$this->assertModuleName('Person');
		$this->assertControllerName('Person\Controller\Person');
		$this->assertControllerClass('PersonController');
		$this->assertMatchedRouteName('person');
	}
}