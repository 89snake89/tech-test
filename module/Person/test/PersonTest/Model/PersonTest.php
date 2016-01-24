<?php
namespace PersonTest\Model;

use PHPUnit_Framework_TestCase;
use Person\Model\Person;

class PersonTest extends PHPUnit_Framework_TestCase
{
	public function testPersonInitialState(){
		$person = new Person();

		$this->assertNull(
				$person->surname,
				'"surname" should initially be null'
				);
		$this->assertNull(
				$person->id,
				'"id" should initially be null'
				);
		$this->assertNull(
				$person->name,
				'"name" should initially be null'
				);
	}

	public function testExchangeArraySetsPropertiesCorrectly(){
		$person = new Person();
		$data  = array('surname' => 'some surname',
				'id'     => 123,
				'name'  => 'some name');

		$person->exchangeArray($data);

		$this->assertSame(
				$data['surname'],
				$person->surname,
				'"surname" was not set correctly'
				);
		$this->assertSame(
				$data['id'],
				$person->id,
				'"id" was not set correctly'
				);
		$this->assertSame(
				$data['name'],
				$person->name,
				'"name" was not set correctly'
				);
	}

	public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent(){
		$person = new Person();

		$person->exchangeArray(array('surname' => 'some surname',
				'id'     => 123,
				'name'  => 'some name'));
		$person->exchangeArray(array());

		$this->assertNull(
				$person->surname, '"surname" should have defaulted to null'
				);
		$this->assertNull(
				$person->id, '"id" should have defaulted to null'
				);
		$this->assertNull(
				$person->name, '"name" should have defaulted to null'
				);
	}

	public function testGetArrayCopyReturnsAnArrayWithPropertyValues(){
		$person = new Person();
		$data  = array('surname' => 'some surname',
				'id'     => 123,
				'name'  => 'some name');

		$person->exchangeArray($data);
		$copyArray = $person->getArrayCopy();

		$this->assertSame(
				$data['surname'],
				$copyArray['surname'],
				'"surname" was not set correctly'
				);
		$this->assertSame(
				$data['id'],
				$copyArray['id'],
				'"id" was not set correctly'
				);
		$this->assertSame(
				$data['name'],
				$copyArray['name'],
				'"name" was not set correctly'
				);
	}

	public function testInputFiltersAreSetCorrectly(){
		$person = new Person();

		$inputFilter = $person->getInputFilter();

		$this->assertSame(3, $inputFilter->count());
		$this->assertTrue($inputFilter->has('surname'));
		$this->assertTrue($inputFilter->has('id'));
		$this->assertTrue($inputFilter->has('name'));
	}
}