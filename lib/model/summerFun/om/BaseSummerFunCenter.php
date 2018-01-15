<?php


abstract class BaseSummerFunCenter extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $summer_fun_zone_id;


	
	protected $morning_shelter = false;


	
	protected $afternoon_shelter = false;


	
	protected $transfer_payment = false;


	
	protected $cash_payment = false;


	
	protected $tpv_payment = false;


	
	protected $is_registration_open = false;


	
	protected $account_number;


	
	protected $mail;


	
	protected $weeks_discount;


	
	protected $weeks_percent_discount = 0;


	
	protected $brothers_discount;


	
	protected $brothers_percent_discount = 0;


	
	protected $show_excursion_widget = false;


	
	protected $recibo_domiciliado_payment = false;


	
	protected $show_beca_widget = false;


	
	protected $merchant_code;


	
	protected $merchant_key;


	
	protected $url_tpv;


	
	protected $second_payment_mailing_date;


	
	protected $second_payment_date;

	
	protected $aSummerFunZone;

	
	protected $collWeeks;

	
	protected $lastWeekCriteria = null;

	
	protected $collCourses;

	
	protected $lastCourseCriteria = null;

	
	protected $collGrupos;

	
	protected $lastGrupoCriteria = null;

	
	protected $collProfesors;

	
	protected $lastProfesorCriteria = null;

	
	protected $collExcursions;

	
	protected $lastExcursionCriteria = null;

	
	protected $collSummerFunCenterI18ns;

	
	protected $lastSummerFunCenterI18nCriteria = null;

	
	protected $collSummerFunCenterHasProfiles;

	
	protected $lastSummerFunCenterHasProfileCriteria = null;

	
	protected $collSummerFunCenterNewsItems;

	
	protected $lastSummerFunCenterNewsItemCriteria = null;

	
	protected $collServices;

	
	protected $lastServiceCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getSummerFunZoneId()
	{

		return $this->summer_fun_zone_id;
	}

	
	public function getMorningShelter()
	{

		return $this->morning_shelter;
	}

	
	public function getAfternoonShelter()
	{

		return $this->afternoon_shelter;
	}

	
	public function getTransferPayment()
	{

		return $this->transfer_payment;
	}

	
	public function getCashPayment()
	{

		return $this->cash_payment;
	}

	
	public function getTpvPayment()
	{

		return $this->tpv_payment;
	}

	
	public function getIsRegistrationOpen()
	{

		return $this->is_registration_open;
	}

	
	public function getAccountNumber()
	{

		return $this->account_number;
	}

	
	public function getMail()
	{

		return $this->mail;
	}

	
	public function getWeeksDiscount()
	{

		return $this->weeks_discount;
	}

	
	public function getWeeksPercentDiscount()
	{

		return $this->weeks_percent_discount;
	}

	
	public function getBrothersDiscount()
	{

		return $this->brothers_discount;
	}

	
	public function getBrothersPercentDiscount()
	{

		return $this->brothers_percent_discount;
	}

	
	public function getShowExcursionWidget()
	{

		return $this->show_excursion_widget;
	}

	
	public function getReciboDomiciliadoPayment()
	{

		return $this->recibo_domiciliado_payment;
	}

	
	public function getShowBecaWidget()
	{

		return $this->show_beca_widget;
	}

	
	public function getMerchantCode()
	{

		return $this->merchant_code;
	}

	
	public function getMerchantKey()
	{

		return $this->merchant_key;
	}

	
	public function getUrlTpv()
	{

		return $this->url_tpv;
	}

	
	public function getSecondPaymentMailingDate($format = 'Y-m-d')
	{

		if ($this->second_payment_mailing_date === null || $this->second_payment_mailing_date === '') {
			return null;
		} elseif (!is_int($this->second_payment_mailing_date)) {
						$ts = strtotime($this->second_payment_mailing_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [second_payment_mailing_date] as date/time value: " . var_export($this->second_payment_mailing_date, true));
			}
		} else {
			$ts = $this->second_payment_mailing_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getSecondPaymentDate($format = 'Y-m-d')
	{

		if ($this->second_payment_date === null || $this->second_payment_date === '') {
			return null;
		} elseif (!is_int($this->second_payment_date)) {
						$ts = strtotime($this->second_payment_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [second_payment_date] as date/time value: " . var_export($this->second_payment_date, true));
			}
		} else {
			$ts = $this->second_payment_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::ID;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = SummerFunCenterPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = SummerFunCenterPeer::UPDATED_AT;
		}

	} 
	
	public function setSummerFunZoneId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->summer_fun_zone_id !== $v) {
			$this->summer_fun_zone_id = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::SUMMER_FUN_ZONE_ID;
		}

		if ($this->aSummerFunZone !== null && $this->aSummerFunZone->getId() !== $v) {
			$this->aSummerFunZone = null;
		}

	} 
	
	public function setMorningShelter($v)
	{

		if ($this->morning_shelter !== $v || $v === false) {
			$this->morning_shelter = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::MORNING_SHELTER;
		}

	} 
	
	public function setAfternoonShelter($v)
	{

		if ($this->afternoon_shelter !== $v || $v === false) {
			$this->afternoon_shelter = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::AFTERNOON_SHELTER;
		}

	} 
	
	public function setTransferPayment($v)
	{

		if ($this->transfer_payment !== $v || $v === false) {
			$this->transfer_payment = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::TRANSFER_PAYMENT;
		}

	} 
	
	public function setCashPayment($v)
	{

		if ($this->cash_payment !== $v || $v === false) {
			$this->cash_payment = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::CASH_PAYMENT;
		}

	} 
	
	public function setTpvPayment($v)
	{

		if ($this->tpv_payment !== $v || $v === false) {
			$this->tpv_payment = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::TPV_PAYMENT;
		}

	} 
	
	public function setIsRegistrationOpen($v)
	{

		if ($this->is_registration_open !== $v || $v === false) {
			$this->is_registration_open = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::IS_REGISTRATION_OPEN;
		}

	} 
	
	public function setAccountNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->account_number !== $v) {
			$this->account_number = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::ACCOUNT_NUMBER;
		}

	} 
	
	public function setMail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mail !== $v) {
			$this->mail = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::MAIL;
		}

	} 
	
	public function setWeeksDiscount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->weeks_discount !== $v) {
			$this->weeks_discount = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::WEEKS_DISCOUNT;
		}

	} 
	
	public function setWeeksPercentDiscount($v)
	{

		if ($this->weeks_percent_discount !== $v || $v === 0) {
			$this->weeks_percent_discount = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::WEEKS_PERCENT_DISCOUNT;
		}

	} 
	
	public function setBrothersDiscount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->brothers_discount !== $v) {
			$this->brothers_discount = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::BROTHERS_DISCOUNT;
		}

	} 
	
	public function setBrothersPercentDiscount($v)
	{

		if ($this->brothers_percent_discount !== $v || $v === 0) {
			$this->brothers_percent_discount = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::BROTHERS_PERCENT_DISCOUNT;
		}

	} 
	
	public function setShowExcursionWidget($v)
	{

		if ($this->show_excursion_widget !== $v || $v === false) {
			$this->show_excursion_widget = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::SHOW_EXCURSION_WIDGET;
		}

	} 
	
	public function setReciboDomiciliadoPayment($v)
	{

		if ($this->recibo_domiciliado_payment !== $v || $v === false) {
			$this->recibo_domiciliado_payment = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::RECIBO_DOMICILIADO_PAYMENT;
		}

	} 
	
	public function setShowBecaWidget($v)
	{

		if ($this->show_beca_widget !== $v || $v === false) {
			$this->show_beca_widget = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::SHOW_BECA_WIDGET;
		}

	} 
	
	public function setMerchantCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->merchant_code !== $v) {
			$this->merchant_code = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::MERCHANT_CODE;
		}

	} 
	
	public function setMerchantKey($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->merchant_key !== $v) {
			$this->merchant_key = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::MERCHANT_KEY;
		}

	} 
	
	public function setUrlTpv($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url_tpv !== $v) {
			$this->url_tpv = $v;
			$this->modifiedColumns[] = SummerFunCenterPeer::URL_TPV;
		}

	} 
	
	public function setSecondPaymentMailingDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [second_payment_mailing_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->second_payment_mailing_date !== $ts) {
			$this->second_payment_mailing_date = $ts;
			$this->modifiedColumns[] = SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE;
		}

	} 
	
	public function setSecondPaymentDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [second_payment_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->second_payment_date !== $ts) {
			$this->second_payment_date = $ts;
			$this->modifiedColumns[] = SummerFunCenterPeer::SECOND_PAYMENT_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->summer_fun_zone_id = $rs->getInt($startcol + 3);

			$this->morning_shelter = $rs->getBoolean($startcol + 4);

			$this->afternoon_shelter = $rs->getBoolean($startcol + 5);

			$this->transfer_payment = $rs->getBoolean($startcol + 6);

			$this->cash_payment = $rs->getBoolean($startcol + 7);

			$this->tpv_payment = $rs->getBoolean($startcol + 8);

			$this->is_registration_open = $rs->getBoolean($startcol + 9);

			$this->account_number = $rs->getString($startcol + 10);

			$this->mail = $rs->getString($startcol + 11);

			$this->weeks_discount = $rs->getInt($startcol + 12);

			$this->weeks_percent_discount = $rs->getFloat($startcol + 13);

			$this->brothers_discount = $rs->getInt($startcol + 14);

			$this->brothers_percent_discount = $rs->getFloat($startcol + 15);

			$this->show_excursion_widget = $rs->getBoolean($startcol + 16);

			$this->recibo_domiciliado_payment = $rs->getBoolean($startcol + 17);

			$this->show_beca_widget = $rs->getBoolean($startcol + 18);

			$this->merchant_code = $rs->getString($startcol + 19);

			$this->merchant_key = $rs->getString($startcol + 20);

			$this->url_tpv = $rs->getString($startcol + 21);

			$this->second_payment_mailing_date = $rs->getDate($startcol + 22, null);

			$this->second_payment_date = $rs->getDate($startcol + 23, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 24; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SummerFunCenter object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenter:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SummerFunCenterPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SummerFunCenterPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSummerFunCenter:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenter:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SummerFunCenterPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SummerFunCenterPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SummerFunCenterPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSummerFunCenter:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aSummerFunZone !== null) {
				if ($this->aSummerFunZone->isModified() || $this->aSummerFunZone->getCurrentSummerFunZoneI18n()->isModified()) {
					$affectedRows += $this->aSummerFunZone->save($con);
				}
				$this->setSummerFunZone($this->aSummerFunZone);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SummerFunCenterPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SummerFunCenterPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collWeeks !== null) {
				foreach($this->collWeeks as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCourses !== null) {
				foreach($this->collCourses as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGrupos !== null) {
				foreach($this->collGrupos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfesors !== null) {
				foreach($this->collProfesors as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExcursions !== null) {
				foreach($this->collExcursions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSummerFunCenterI18ns !== null) {
				foreach($this->collSummerFunCenterI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSummerFunCenterHasProfiles !== null) {
				foreach($this->collSummerFunCenterHasProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSummerFunCenterNewsItems !== null) {
				foreach($this->collSummerFunCenterNewsItems as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collServices !== null) {
				foreach($this->collServices as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aSummerFunZone !== null) {
				if (!$this->aSummerFunZone->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSummerFunZone->getValidationFailures());
				}
			}


			if (($retval = SummerFunCenterPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWeeks !== null) {
					foreach($this->collWeeks as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCourses !== null) {
					foreach($this->collCourses as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGrupos !== null) {
					foreach($this->collGrupos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfesors !== null) {
					foreach($this->collProfesors as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExcursions !== null) {
					foreach($this->collExcursions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSummerFunCenterI18ns !== null) {
					foreach($this->collSummerFunCenterI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSummerFunCenterHasProfiles !== null) {
					foreach($this->collSummerFunCenterHasProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSummerFunCenterNewsItems !== null) {
					foreach($this->collSummerFunCenterNewsItems as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collServices !== null) {
					foreach($this->collServices as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getSummerFunZoneId();
				break;
			case 4:
				return $this->getMorningShelter();
				break;
			case 5:
				return $this->getAfternoonShelter();
				break;
			case 6:
				return $this->getTransferPayment();
				break;
			case 7:
				return $this->getCashPayment();
				break;
			case 8:
				return $this->getTpvPayment();
				break;
			case 9:
				return $this->getIsRegistrationOpen();
				break;
			case 10:
				return $this->getAccountNumber();
				break;
			case 11:
				return $this->getMail();
				break;
			case 12:
				return $this->getWeeksDiscount();
				break;
			case 13:
				return $this->getWeeksPercentDiscount();
				break;
			case 14:
				return $this->getBrothersDiscount();
				break;
			case 15:
				return $this->getBrothersPercentDiscount();
				break;
			case 16:
				return $this->getShowExcursionWidget();
				break;
			case 17:
				return $this->getReciboDomiciliadoPayment();
				break;
			case 18:
				return $this->getShowBecaWidget();
				break;
			case 19:
				return $this->getMerchantCode();
				break;
			case 20:
				return $this->getMerchantKey();
				break;
			case 21:
				return $this->getUrlTpv();
				break;
			case 22:
				return $this->getSecondPaymentMailingDate();
				break;
			case 23:
				return $this->getSecondPaymentDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getSummerFunZoneId(),
			$keys[4] => $this->getMorningShelter(),
			$keys[5] => $this->getAfternoonShelter(),
			$keys[6] => $this->getTransferPayment(),
			$keys[7] => $this->getCashPayment(),
			$keys[8] => $this->getTpvPayment(),
			$keys[9] => $this->getIsRegistrationOpen(),
			$keys[10] => $this->getAccountNumber(),
			$keys[11] => $this->getMail(),
			$keys[12] => $this->getWeeksDiscount(),
			$keys[13] => $this->getWeeksPercentDiscount(),
			$keys[14] => $this->getBrothersDiscount(),
			$keys[15] => $this->getBrothersPercentDiscount(),
			$keys[16] => $this->getShowExcursionWidget(),
			$keys[17] => $this->getReciboDomiciliadoPayment(),
			$keys[18] => $this->getShowBecaWidget(),
			$keys[19] => $this->getMerchantCode(),
			$keys[20] => $this->getMerchantKey(),
			$keys[21] => $this->getUrlTpv(),
			$keys[22] => $this->getSecondPaymentMailingDate(),
			$keys[23] => $this->getSecondPaymentDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setSummerFunZoneId($value);
				break;
			case 4:
				$this->setMorningShelter($value);
				break;
			case 5:
				$this->setAfternoonShelter($value);
				break;
			case 6:
				$this->setTransferPayment($value);
				break;
			case 7:
				$this->setCashPayment($value);
				break;
			case 8:
				$this->setTpvPayment($value);
				break;
			case 9:
				$this->setIsRegistrationOpen($value);
				break;
			case 10:
				$this->setAccountNumber($value);
				break;
			case 11:
				$this->setMail($value);
				break;
			case 12:
				$this->setWeeksDiscount($value);
				break;
			case 13:
				$this->setWeeksPercentDiscount($value);
				break;
			case 14:
				$this->setBrothersDiscount($value);
				break;
			case 15:
				$this->setBrothersPercentDiscount($value);
				break;
			case 16:
				$this->setShowExcursionWidget($value);
				break;
			case 17:
				$this->setReciboDomiciliadoPayment($value);
				break;
			case 18:
				$this->setShowBecaWidget($value);
				break;
			case 19:
				$this->setMerchantCode($value);
				break;
			case 20:
				$this->setMerchantKey($value);
				break;
			case 21:
				$this->setUrlTpv($value);
				break;
			case 22:
				$this->setSecondPaymentMailingDate($value);
				break;
			case 23:
				$this->setSecondPaymentDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSummerFunZoneId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMorningShelter($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAfternoonShelter($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTransferPayment($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCashPayment($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTpvPayment($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsRegistrationOpen($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setAccountNumber($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMail($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setWeeksDiscount($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setWeeksPercentDiscount($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setBrothersDiscount($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setBrothersPercentDiscount($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setShowExcursionWidget($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setReciboDomiciliadoPayment($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setShowBecaWidget($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setMerchantCode($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setMerchantKey($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setUrlTpv($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setSecondPaymentMailingDate($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setSecondPaymentDate($arr[$keys[23]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SummerFunCenterPeer::DATABASE_NAME);

		if ($this->isColumnModified(SummerFunCenterPeer::ID)) $criteria->add(SummerFunCenterPeer::ID, $this->id);
		if ($this->isColumnModified(SummerFunCenterPeer::CREATED_AT)) $criteria->add(SummerFunCenterPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SummerFunCenterPeer::UPDATED_AT)) $criteria->add(SummerFunCenterPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID)) $criteria->add(SummerFunCenterPeer::SUMMER_FUN_ZONE_ID, $this->summer_fun_zone_id);
		if ($this->isColumnModified(SummerFunCenterPeer::MORNING_SHELTER)) $criteria->add(SummerFunCenterPeer::MORNING_SHELTER, $this->morning_shelter);
		if ($this->isColumnModified(SummerFunCenterPeer::AFTERNOON_SHELTER)) $criteria->add(SummerFunCenterPeer::AFTERNOON_SHELTER, $this->afternoon_shelter);
		if ($this->isColumnModified(SummerFunCenterPeer::TRANSFER_PAYMENT)) $criteria->add(SummerFunCenterPeer::TRANSFER_PAYMENT, $this->transfer_payment);
		if ($this->isColumnModified(SummerFunCenterPeer::CASH_PAYMENT)) $criteria->add(SummerFunCenterPeer::CASH_PAYMENT, $this->cash_payment);
		if ($this->isColumnModified(SummerFunCenterPeer::TPV_PAYMENT)) $criteria->add(SummerFunCenterPeer::TPV_PAYMENT, $this->tpv_payment);
		if ($this->isColumnModified(SummerFunCenterPeer::IS_REGISTRATION_OPEN)) $criteria->add(SummerFunCenterPeer::IS_REGISTRATION_OPEN, $this->is_registration_open);
		if ($this->isColumnModified(SummerFunCenterPeer::ACCOUNT_NUMBER)) $criteria->add(SummerFunCenterPeer::ACCOUNT_NUMBER, $this->account_number);
		if ($this->isColumnModified(SummerFunCenterPeer::MAIL)) $criteria->add(SummerFunCenterPeer::MAIL, $this->mail);
		if ($this->isColumnModified(SummerFunCenterPeer::WEEKS_DISCOUNT)) $criteria->add(SummerFunCenterPeer::WEEKS_DISCOUNT, $this->weeks_discount);
		if ($this->isColumnModified(SummerFunCenterPeer::WEEKS_PERCENT_DISCOUNT)) $criteria->add(SummerFunCenterPeer::WEEKS_PERCENT_DISCOUNT, $this->weeks_percent_discount);
		if ($this->isColumnModified(SummerFunCenterPeer::BROTHERS_DISCOUNT)) $criteria->add(SummerFunCenterPeer::BROTHERS_DISCOUNT, $this->brothers_discount);
		if ($this->isColumnModified(SummerFunCenterPeer::BROTHERS_PERCENT_DISCOUNT)) $criteria->add(SummerFunCenterPeer::BROTHERS_PERCENT_DISCOUNT, $this->brothers_percent_discount);
		if ($this->isColumnModified(SummerFunCenterPeer::SHOW_EXCURSION_WIDGET)) $criteria->add(SummerFunCenterPeer::SHOW_EXCURSION_WIDGET, $this->show_excursion_widget);
		if ($this->isColumnModified(SummerFunCenterPeer::RECIBO_DOMICILIADO_PAYMENT)) $criteria->add(SummerFunCenterPeer::RECIBO_DOMICILIADO_PAYMENT, $this->recibo_domiciliado_payment);
		if ($this->isColumnModified(SummerFunCenterPeer::SHOW_BECA_WIDGET)) $criteria->add(SummerFunCenterPeer::SHOW_BECA_WIDGET, $this->show_beca_widget);
		if ($this->isColumnModified(SummerFunCenterPeer::MERCHANT_CODE)) $criteria->add(SummerFunCenterPeer::MERCHANT_CODE, $this->merchant_code);
		if ($this->isColumnModified(SummerFunCenterPeer::MERCHANT_KEY)) $criteria->add(SummerFunCenterPeer::MERCHANT_KEY, $this->merchant_key);
		if ($this->isColumnModified(SummerFunCenterPeer::URL_TPV)) $criteria->add(SummerFunCenterPeer::URL_TPV, $this->url_tpv);
		if ($this->isColumnModified(SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE)) $criteria->add(SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE, $this->second_payment_mailing_date);
		if ($this->isColumnModified(SummerFunCenterPeer::SECOND_PAYMENT_DATE)) $criteria->add(SummerFunCenterPeer::SECOND_PAYMENT_DATE, $this->second_payment_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SummerFunCenterPeer::DATABASE_NAME);

		$criteria->add(SummerFunCenterPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setSummerFunZoneId($this->summer_fun_zone_id);

		$copyObj->setMorningShelter($this->morning_shelter);

		$copyObj->setAfternoonShelter($this->afternoon_shelter);

		$copyObj->setTransferPayment($this->transfer_payment);

		$copyObj->setCashPayment($this->cash_payment);

		$copyObj->setTpvPayment($this->tpv_payment);

		$copyObj->setIsRegistrationOpen($this->is_registration_open);

		$copyObj->setAccountNumber($this->account_number);

		$copyObj->setMail($this->mail);

		$copyObj->setWeeksDiscount($this->weeks_discount);

		$copyObj->setWeeksPercentDiscount($this->weeks_percent_discount);

		$copyObj->setBrothersDiscount($this->brothers_discount);

		$copyObj->setBrothersPercentDiscount($this->brothers_percent_discount);

		$copyObj->setShowExcursionWidget($this->show_excursion_widget);

		$copyObj->setReciboDomiciliadoPayment($this->recibo_domiciliado_payment);

		$copyObj->setShowBecaWidget($this->show_beca_widget);

		$copyObj->setMerchantCode($this->merchant_code);

		$copyObj->setMerchantKey($this->merchant_key);

		$copyObj->setUrlTpv($this->url_tpv);

		$copyObj->setSecondPaymentMailingDate($this->second_payment_mailing_date);

		$copyObj->setSecondPaymentDate($this->second_payment_date);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getWeeks() as $relObj) {
				$copyObj->addWeek($relObj->copy($deepCopy));
			}

			foreach($this->getCourses() as $relObj) {
				$copyObj->addCourse($relObj->copy($deepCopy));
			}

			foreach($this->getGrupos() as $relObj) {
				$copyObj->addGrupo($relObj->copy($deepCopy));
			}

			foreach($this->getProfesors() as $relObj) {
				$copyObj->addProfesor($relObj->copy($deepCopy));
			}

			foreach($this->getExcursions() as $relObj) {
				$copyObj->addExcursion($relObj->copy($deepCopy));
			}

			foreach($this->getSummerFunCenterI18ns() as $relObj) {
				$copyObj->addSummerFunCenterI18n($relObj->copy($deepCopy));
			}

			foreach($this->getSummerFunCenterHasProfiles() as $relObj) {
				$copyObj->addSummerFunCenterHasProfile($relObj->copy($deepCopy));
			}

			foreach($this->getSummerFunCenterNewsItems() as $relObj) {
				$copyObj->addSummerFunCenterNewsItem($relObj->copy($deepCopy));
			}

			foreach($this->getServices() as $relObj) {
				$copyObj->addService($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SummerFunCenterPeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunZone($v)
	{


		if ($v === null) {
			$this->setSummerFunZoneId(NULL);
		} else {
			$this->setSummerFunZoneId($v->getId());
		}


		$this->aSummerFunZone = $v;
	}


	
	public function getSummerFunZone($con = null)
	{
		if ($this->aSummerFunZone === null && ($this->summer_fun_zone_id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunZonePeer.php';

			$this->aSummerFunZone = SummerFunZonePeer::retrieveByPK($this->summer_fun_zone_id, $con);

			
		}
		return $this->aSummerFunZone;
	}

	
	public function initWeeks()
	{
		if ($this->collWeeks === null) {
			$this->collWeeks = array();
		}
	}

	
	public function getWeeks($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseWeekPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWeeks === null) {
			if ($this->isNew()) {
			   $this->collWeeks = array();
			} else {

				$criteria->add(WeekPeer::CENTRO_ID, $this->getId());

				WeekPeer::addSelectColumns($criteria);
				$this->collWeeks = WeekPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WeekPeer::CENTRO_ID, $this->getId());

				WeekPeer::addSelectColumns($criteria);
				if (!isset($this->lastWeekCriteria) || !$this->lastWeekCriteria->equals($criteria)) {
					$this->collWeeks = WeekPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWeekCriteria = $criteria;
		return $this->collWeeks;
	}

	
	public function countWeeks($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseWeekPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WeekPeer::CENTRO_ID, $this->getId());

		return WeekPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWeek(Week $l)
	{
		$this->collWeeks[] = $l;
		$l->setSummerFunCenter($this);
	}

	
	public function initCourses()
	{
		if ($this->collCourses === null) {
			$this->collCourses = array();
		}
	}

	
	public function getCourses($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourses === null) {
			if ($this->isNew()) {
			   $this->collCourses = array();
			} else {

				$criteria->add(CoursePeer::SUMMER_FUN_CENTER_ID, $this->getId());

				CoursePeer::addSelectColumns($criteria);
				$this->collCourses = CoursePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CoursePeer::SUMMER_FUN_CENTER_ID, $this->getId());

				CoursePeer::addSelectColumns($criteria);
				if (!isset($this->lastCourseCriteria) || !$this->lastCourseCriteria->equals($criteria)) {
					$this->collCourses = CoursePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCourseCriteria = $criteria;
		return $this->collCourses;
	}

	
	public function countCourses($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CoursePeer::SUMMER_FUN_CENTER_ID, $this->getId());

		return CoursePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCourse(Course $l)
	{
		$this->collCourses[] = $l;
		$l->setSummerFunCenter($this);
	}


	
	public function getCoursesJoinExcursion($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseCoursePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCourses === null) {
			if ($this->isNew()) {
				$this->collCourses = array();
			} else {

				$criteria->add(CoursePeer::SUMMER_FUN_CENTER_ID, $this->getId());

				$this->collCourses = CoursePeer::doSelectJoinExcursion($criteria, $con);
			}
		} else {
									
			$criteria->add(CoursePeer::SUMMER_FUN_CENTER_ID, $this->getId());

			if (!isset($this->lastCourseCriteria) || !$this->lastCourseCriteria->equals($criteria)) {
				$this->collCourses = CoursePeer::doSelectJoinExcursion($criteria, $con);
			}
		}
		$this->lastCourseCriteria = $criteria;

		return $this->collCourses;
	}

	
	public function initGrupos()
	{
		if ($this->collGrupos === null) {
			$this->collGrupos = array();
		}
	}

	
	public function getGrupos($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupos === null) {
			if ($this->isNew()) {
			   $this->collGrupos = array();
			} else {

				$criteria->add(GrupoPeer::CENTRO_ID, $this->getId());

				GrupoPeer::addSelectColumns($criteria);
				$this->collGrupos = GrupoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GrupoPeer::CENTRO_ID, $this->getId());

				GrupoPeer::addSelectColumns($criteria);
				if (!isset($this->lastGrupoCriteria) || !$this->lastGrupoCriteria->equals($criteria)) {
					$this->collGrupos = GrupoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGrupoCriteria = $criteria;
		return $this->collGrupos;
	}

	
	public function countGrupos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GrupoPeer::CENTRO_ID, $this->getId());

		return GrupoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGrupo(Grupo $l)
	{
		$this->collGrupos[] = $l;
		$l->setSummerFunCenter($this);
	}

	
	public function initProfesors()
	{
		if ($this->collProfesors === null) {
			$this->collProfesors = array();
		}
	}

	
	public function getProfesors($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfesors === null) {
			if ($this->isNew()) {
			   $this->collProfesors = array();
			} else {

				$criteria->add(ProfesorPeer::CENTRO_ID, $this->getId());

				ProfesorPeer::addSelectColumns($criteria);
				$this->collProfesors = ProfesorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProfesorPeer::CENTRO_ID, $this->getId());

				ProfesorPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfesorCriteria) || !$this->lastProfesorCriteria->equals($criteria)) {
					$this->collProfesors = ProfesorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfesorCriteria = $criteria;
		return $this->collProfesors;
	}

	
	public function countProfesors($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseProfesorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfesorPeer::CENTRO_ID, $this->getId());

		return ProfesorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProfesor(Profesor $l)
	{
		$this->collProfesors[] = $l;
		$l->setSummerFunCenter($this);
	}

	
	public function initExcursions()
	{
		if ($this->collExcursions === null) {
			$this->collExcursions = array();
		}
	}

	
	public function getExcursions($criteria = null, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseExcursionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExcursions === null) {
			if ($this->isNew()) {
			   $this->collExcursions = array();
			} else {

				$criteria->add(ExcursionPeer::CENTRO_ID, $this->getId());

				ExcursionPeer::addSelectColumns($criteria);
				$this->collExcursions = ExcursionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ExcursionPeer::CENTRO_ID, $this->getId());

				ExcursionPeer::addSelectColumns($criteria);
				if (!isset($this->lastExcursionCriteria) || !$this->lastExcursionCriteria->equals($criteria)) {
					$this->collExcursions = ExcursionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExcursionCriteria = $criteria;
		return $this->collExcursions;
	}

	
	public function countExcursions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/inscriptions/om/BaseExcursionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExcursionPeer::CENTRO_ID, $this->getId());

		return ExcursionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addExcursion(Excursion $l)
	{
		$this->collExcursions[] = $l;
		$l->setSummerFunCenter($this);
	}

	
	public function initSummerFunCenterI18ns()
	{
		if ($this->collSummerFunCenterI18ns === null) {
			$this->collSummerFunCenterI18ns = array();
		}
	}

	
	public function getSummerFunCenterI18ns($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterI18ns === null) {
			if ($this->isNew()) {
			   $this->collSummerFunCenterI18ns = array();
			} else {

				$criteria->add(SummerFunCenterI18nPeer::ID, $this->getId());

				SummerFunCenterI18nPeer::addSelectColumns($criteria);
				$this->collSummerFunCenterI18ns = SummerFunCenterI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunCenterI18nPeer::ID, $this->getId());

				SummerFunCenterI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunCenterI18nCriteria) || !$this->lastSummerFunCenterI18nCriteria->equals($criteria)) {
					$this->collSummerFunCenterI18ns = SummerFunCenterI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunCenterI18nCriteria = $criteria;
		return $this->collSummerFunCenterI18ns;
	}

	
	public function countSummerFunCenterI18ns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunCenterI18nPeer::ID, $this->getId());

		return SummerFunCenterI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunCenterI18n(SummerFunCenterI18n $l)
	{
		$this->collSummerFunCenterI18ns[] = $l;
		$l->setSummerFunCenter($this);
	}

	
	public function initSummerFunCenterHasProfiles()
	{
		if ($this->collSummerFunCenterHasProfiles === null) {
			$this->collSummerFunCenterHasProfiles = array();
		}
	}

	
	public function getSummerFunCenterHasProfiles($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterHasProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterHasProfiles === null) {
			if ($this->isNew()) {
			   $this->collSummerFunCenterHasProfiles = array();
			} else {

				$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->getId());

				SummerFunCenterHasProfilePeer::addSelectColumns($criteria);
				$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->getId());

				SummerFunCenterHasProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunCenterHasProfileCriteria) || !$this->lastSummerFunCenterHasProfileCriteria->equals($criteria)) {
					$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunCenterHasProfileCriteria = $criteria;
		return $this->collSummerFunCenterHasProfiles;
	}

	
	public function countSummerFunCenterHasProfiles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterHasProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->getId());

		return SummerFunCenterHasProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunCenterHasProfile(SummerFunCenterHasProfile $l)
	{
		$this->collSummerFunCenterHasProfiles[] = $l;
		$l->setSummerFunCenter($this);
	}


	
	public function getSummerFunCenterHasProfilesJoinsfGuardUserProfile($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterHasProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterHasProfiles === null) {
			if ($this->isNew()) {
				$this->collSummerFunCenterHasProfiles = array();
			} else {

				$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->getId());

				$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelectJoinsfGuardUserProfile($criteria, $con);
			}
		} else {
									
			$criteria->add(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, $this->getId());

			if (!isset($this->lastSummerFunCenterHasProfileCriteria) || !$this->lastSummerFunCenterHasProfileCriteria->equals($criteria)) {
				$this->collSummerFunCenterHasProfiles = SummerFunCenterHasProfilePeer::doSelectJoinsfGuardUserProfile($criteria, $con);
			}
		}
		$this->lastSummerFunCenterHasProfileCriteria = $criteria;

		return $this->collSummerFunCenterHasProfiles;
	}

	
	public function initSummerFunCenterNewsItems()
	{
		if ($this->collSummerFunCenterNewsItems === null) {
			$this->collSummerFunCenterNewsItems = array();
		}
	}

	
	public function getSummerFunCenterNewsItems($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterNewsItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSummerFunCenterNewsItems === null) {
			if ($this->isNew()) {
			   $this->collSummerFunCenterNewsItems = array();
			} else {

				$criteria->add(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID, $this->getId());

				SummerFunCenterNewsItemPeer::addSelectColumns($criteria);
				$this->collSummerFunCenterNewsItems = SummerFunCenterNewsItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID, $this->getId());

				SummerFunCenterNewsItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastSummerFunCenterNewsItemCriteria) || !$this->lastSummerFunCenterNewsItemCriteria->equals($criteria)) {
					$this->collSummerFunCenterNewsItems = SummerFunCenterNewsItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSummerFunCenterNewsItemCriteria = $criteria;
		return $this->collSummerFunCenterNewsItems;
	}

	
	public function countSummerFunCenterNewsItems($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseSummerFunCenterNewsItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SummerFunCenterNewsItemPeer::SUMMER_FUN_CENTER_ID, $this->getId());

		return SummerFunCenterNewsItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSummerFunCenterNewsItem(SummerFunCenterNewsItem $l)
	{
		$this->collSummerFunCenterNewsItems[] = $l;
		$l->setSummerFunCenter($this);
	}

	
	public function initServices()
	{
		if ($this->collServices === null) {
			$this->collServices = array();
		}
	}

	
	public function getServices($criteria = null, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collServices === null) {
			if ($this->isNew()) {
			   $this->collServices = array();
			} else {

				$criteria->add(ServicePeer::CENTER_ID, $this->getId());

				ServicePeer::addSelectColumns($criteria);
				$this->collServices = ServicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ServicePeer::CENTER_ID, $this->getId());

				ServicePeer::addSelectColumns($criteria);
				if (!isset($this->lastServiceCriteria) || !$this->lastServiceCriteria->equals($criteria)) {
					$this->collServices = ServicePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastServiceCriteria = $criteria;
		return $this->collServices;
	}

	
	public function countServices($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/summerFun/om/BaseServicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ServicePeer::CENTER_ID, $this->getId());

		return ServicePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addService(Service $l)
	{
		$this->collServices[] = $l;
		$l->setSummerFunCenter($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getTitle()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setTitle($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setDescription($value);
  }

  public function getTextShelter()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getTextShelter() : null);
  }

  public function setTextShelter($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setTextShelter($value);
  }

  public function getInscriptionConfirmationMail()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getInscriptionConfirmationMail() : null);
  }

  public function setInscriptionConfirmationMail($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setInscriptionConfirmationMail($value);
  }

  public function getInscriptionConditionsTermsPdf()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getInscriptionConditionsTermsPdf() : null);
  }

  public function setInscriptionConditionsTermsPdf($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setInscriptionConditionsTermsPdf($value);
  }

  public function getCustomQuestion()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getCustomQuestion() : null);
  }

  public function setCustomQuestion($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setCustomQuestion($value);
  }

  public function getReciboDomiciliadoTxt()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getReciboDomiciliadoTxt() : null);
  }

  public function setReciboDomiciliadoTxt($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setReciboDomiciliadoTxt($value);
  }

  public function getSecondPaymentMailingBody()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getSecondPaymentMailingBody() : null);
  }

  public function setSecondPaymentMailingBody($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setSecondPaymentMailingBody($value);
  }

  public function getSecondPaymentMailingBodyNoTpv()
  {
    $obj = $this->getCurrentSummerFunCenterI18n();

    return ($obj ? $obj->getSecondPaymentMailingBodyNoTpv() : null);
  }

  public function setSecondPaymentMailingBodyNoTpv($value)
  {
    $this->getCurrentSummerFunCenterI18n()->setSecondPaymentMailingBodyNoTpv($value);
  }

  protected $current_i18n = array();

  public function getCurrentSummerFunCenterI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = SummerFunCenterI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setSummerFunCenterI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setSummerFunCenterI18nForCulture(new SummerFunCenterI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setSummerFunCenterI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addSummerFunCenterI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSummerFunCenter:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSummerFunCenter::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 