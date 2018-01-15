<?php

class sfAdvancedPropelPager extends sfPropelPager 
{
	protected $statement = null;
	protected $result = null;

	public function __construct($class, $defaultMaxPerPage = 10) 
	{
		$this->setClass($class);
		$this->setMaxPerPage($defaultMaxPerPage);
		$this->setPage(1);
		$this->parameter_holder = new sfParameterHolder();
		$this->setPeerMethod('retrieveByPk');
	}

	public function init() 
	{
		//require_once(sfConfig::get('sf_model_lib_dir') . '/inscriptions/' . $this->getClassPeer() . '.php');

		$rs = clone $this->getStatement()->executeQuery(ResultSet::FETCHMODE_NUM);

		$this->setNbResults($rs->getRecordCount());

		if (($this->getPage() == 0 || $this->getMaxPerPage() == 0)) {
			$this->setLastPage(0);
		} 
		else {
			$this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));
			$this->statement->setOffset(($this->getPage() - 1) * $this->getMaxPerPage());
			$this->statement->setLimit($this->getMaxPerPage());
		}
	}

	public function getResults() 
	{
		$rs = $this->getStatement()->executeQuery(ResultSet::FETCHMODE_NUM);

		$objects = array();

		while ($rs->next()) {
			$objects[] = call_user_func(array($this->getClassPeer(), $this->getPeerMethod()), $rs->getInt(1));
		}

		return $objects;
	}

	protected function retrieveObject($offset) 
	{
		$statement = clone $this->getStatement();
		$statement->setOffset($offset - 1);
		$statement->setLimit(1);

		$rs = $statement->executeQuery(ResultSet::FETCHMODE_NUM);

		$object = null;
		while ($rs->next()) {
			$object = call_user_func(array($this->getClassPeer(), $this->getPeerMethod()), $rs->getInt(1));
		}

		return $object;
	}
	
	public function getResultsAsRowset() 
	{ 
		if (!$this->result) {
			$this->result = $this->getStatement()->executeQuery(ResultSet::FETCHMODE_ASSOC);
		}

		return $this->result;
	}

	public function getStatement() {
		return $this->statement;
	}

	public function setStatement($stmt) {
		$this->statement = $stmt;
	}
}

?>