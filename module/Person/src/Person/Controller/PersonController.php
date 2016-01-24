<?php
namespace Person\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PersonController extends AbstractActionController{
	
	protected $personTable;
	
	public function indexAction(){
		return new ViewModel(array(
				'persons' => $this->getPersonTable()->fetchAll()
		));
	}
	
	public function addAction(){
		
	}
	
	public function editAction(){
		
	}
	
	public function deleteAction(){
		
	}
	
	public function getPersonTable(){
		if (!$this->personTable) {
			$sm = $this->getServiceLocator();
			$this->personTable = $sm->get('Person\Model\PersonTable');
		}
		return $this->personTable;
	}
}