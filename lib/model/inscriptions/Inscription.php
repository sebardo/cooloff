<?php

/**
 * Subclass for representing a row from the 'inscription' table.
 *
 * 
 *
 * @package lib.model.inscriptions
 */ 
class Inscription extends BaseInscription
{
	public function getFullStudentName()
	{
		$fullName = $this->student_name;
		
		if (trim($this->student_primer_apellido)) {
			$fullName = $fullName . " " . trim($this->student_primer_apellido);
		}
		
		if (trim($this->student_segundo_apellido)) {
			$fullName = $fullName . " " . trim($this->student_segundo_apellido);
		}
		
		return $fullName;
	}
	
	public function getFullFatherName()
	{
		$fullName = $this->father_name;
		
		if (trim($this->father_primer_apellido)) {
			$fullName = $fullName . " " . trim($this->father_primer_apellido);
		}
		
		if (trim($this->father_segundo_apellido)) {
			$fullName = $fullName . " " . trim($this->father_segundo_apellido);
		}
		
		return $fullName;
	}
	
	public function getFullMotherName()
	{
		$fullName = $this->mother_name;
		
		if (trim($this->mother_primer_apellido)) {
			$fullName = $fullName . " " . trim($this->mother_primer_apellido);
		}
		
		if (trim($this->mother_segundo_apellido)) {
			$fullName = $fullName . " " . trim($this->mother_segundo_apellido);
		}
		
		return $fullName;
	}

    public function getPendingAmount()
    {
        return $this->getPrice() - $this->getAmountBeca() - $this->getAmountFirstPayment() - $this->getAmountSecondPayment();
    }
    
    public function getPendingAmountFromAllInscriptions()
    {
        $inscriptions = InscriptionPeer::retrieveByInscriptionNum($this->getInscriptionNum());
        $amount = 0;
        foreach ($inscriptions as $inscription)
        {
            $amount += $inscription->getPendingAmount();
        }

        return $amount;
    }

    public function getTextServices()
    {
        $label = '';

        foreach ($this->getInscriptionServiceSchedules() as $inscriptionServiceSchedule)
        {
            $schedule = $inscriptionServiceSchedule->getServiceSchedule();
            if ($schedule) {
                $schedule->setCulture(sfContext::getInstance()->getUser()->getCulture());

                $service = $schedule->getService();
                $service->setCulture(sfContext::getInstance()->getUser()->getCulture());

                $label .= $service->getName() . ' (' . $schedule->getName() . ') / ';
            }
            else {
                $label .= $service->getName();
            }
        }

        if ($label != '') {
            $label = substr($label, 0, -3);
        }

        return $label;
    }
}
