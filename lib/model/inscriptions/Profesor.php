<?php

/**
 * Subclass for representing a row from the 'profesor' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Profesor extends BaseProfesor
{
	public function __toString()
	{
		return $this->nombre;
	}
}
