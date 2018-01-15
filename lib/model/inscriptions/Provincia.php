<?php

/**
 * Subclass for representing a row from the 'provincia' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Provincia extends BaseProvincia
{
	public function __toString()
	{
		return $this->nombre;
	}
}
