<?php
namespace Person\Form;

use Zend\Form\Form;

class PersonForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('person');

		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		$this->add(array(
				'name' => 'name',
				'type' => 'Text',
				'options' => array(
						'label' => 'Name',
				),
		));
		$this->add(array(
				'name' => 'surname',
				'type' => 'Text',
				'options' => array(
						'label' => 'Surname',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
				),
		));
	}
}