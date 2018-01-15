<?php

/**
 * Subclass for representing a row from the 'grupo' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Grupo extends BaseGrupo
{
	public function __toString()
	{
		return $this->nombre;
	}
}
