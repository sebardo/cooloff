<?php

/**
 * Subclass for performing query and update operations on the 'provincia' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 

class ProvinciaPeer extends BaseProvinciaPeer
{
	public static function doSelectAll()
	{
		$c = new Criteria();
		$c->addAscendingOrderByColumn(ProvinciaPeer::NOMBRE);
		$provincias = parent::doSelect($c);
		
		return $provincias;
	}
	
	public static function doSelectById($id)
	{
		$c = new Criteria();
		$c->add(self::ID, $id);
		$c->setLimit(1);
		$provincia = parent::doSelect($c);
		
		return ($provincia ? $provincia[0] : null);
	}
}
