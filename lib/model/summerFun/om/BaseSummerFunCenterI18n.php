<?php


abstract class BaseSummerFunCenterI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $title;


	
	protected $description;


	
	protected $text_shelter;


	
	protected $inscription_confirmation_mail;


	
	protected $inscription_conditions_terms_pdf;


	
	protected $custom_question;


	
	protected $recibo_domiciliado_txt;


	
	protected $second_payment_mailing_body;


	
	protected $second_payment_mailing_body_no_tpv;


	
	protected $id;


	
	protected $culture;

	
	protected $aSummerFunCenter;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getTextShelter()
	{

		return $this->text_shelter;
	}

	
	public function getInscriptionConfirmationMail()
	{

		return $this->inscription_confirmation_mail;
	}

	
	public function getInscriptionConditionsTermsPdf()
	{

		return $this->inscription_conditions_terms_pdf;
	}

	
	public function getCustomQuestion()
	{

		return $this->custom_question;
	}

	
	public function getReciboDomiciliadoTxt()
	{

		return $this->recibo_domiciliado_txt;
	}

	
	public function getSecondPaymentMailingBody()
	{

		return $this->second_payment_mailing_body;
	}

	
	public function getSecondPaymentMailingBodyNoTpv()
	{

		return $this->second_payment_mailing_body_no_tpv;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::TITLE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::DESCRIPTION;
		}

	} 
	
	public function setTextShelter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text_shelter !== $v) {
			$this->text_shelter = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::TEXT_SHELTER;
		}

	} 
	
	public function setInscriptionConfirmationMail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->inscription_confirmation_mail !== $v) {
			$this->inscription_confirmation_mail = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::INSCRIPTION_CONFIRMATION_MAIL;
		}

	} 
	
	public function setInscriptionConditionsTermsPdf($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->inscription_conditions_terms_pdf !== $v) {
			$this->inscription_conditions_terms_pdf = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::INSCRIPTION_CONDITIONS_TERMS_PDF;
		}

	} 
	
	public function setCustomQuestion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->custom_question !== $v) {
			$this->custom_question = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::CUSTOM_QUESTION;
		}

	} 
	
	public function setReciboDomiciliadoTxt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->recibo_domiciliado_txt !== $v) {
			$this->recibo_domiciliado_txt = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::RECIBO_DOMICILIADO_TXT;
		}

	} 
	
	public function setSecondPaymentMailingBody($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->second_payment_mailing_body !== $v) {
			$this->second_payment_mailing_body = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY;
		}

	} 
	
	public function setSecondPaymentMailingBodyNoTpv($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->second_payment_mailing_body_no_tpv !== $v) {
			$this->second_payment_mailing_body_no_tpv = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY_NO_TPV;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::ID;
		}

		if ($this->aSummerFunCenter !== null && $this->aSummerFunCenter->getId() !== $v) {
			$this->aSummerFunCenter = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = SummerFunCenterI18nPeer::CULTURE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->title = $rs->getString($startcol + 0);

			$this->description = $rs->getString($startcol + 1);

			$this->text_shelter = $rs->getString($startcol + 2);

			$this->inscription_confirmation_mail = $rs->getString($startcol + 3);

			$this->inscription_conditions_terms_pdf = $rs->getString($startcol + 4);

			$this->custom_question = $rs->getString($startcol + 5);

			$this->recibo_domiciliado_txt = $rs->getString($startcol + 6);

			$this->second_payment_mailing_body = $rs->getString($startcol + 7);

			$this->second_payment_mailing_body_no_tpv = $rs->getString($startcol + 8);

			$this->id = $rs->getInt($startcol + 9);

			$this->culture = $rs->getString($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SummerFunCenterI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(SummerFunCenterI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SummerFunCenterI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSummerFunCenterI18n:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SummerFunCenterI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSummerFunCenterI18n:save:post') as $callable)
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


												
			if ($this->aSummerFunCenter !== null) {
				if ($this->aSummerFunCenter->isModified() || $this->aSummerFunCenter->getCurrentSummerFunCenterI18n()->isModified()) {
					$affectedRows += $this->aSummerFunCenter->save($con);
				}
				$this->setSummerFunCenter($this->aSummerFunCenter);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SummerFunCenterI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SummerFunCenterI18nPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aSummerFunCenter !== null) {
				if (!$this->aSummerFunCenter->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSummerFunCenter->getValidationFailures());
				}
			}


			if (($retval = SummerFunCenterI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getTitle();
				break;
			case 1:
				return $this->getDescription();
				break;
			case 2:
				return $this->getTextShelter();
				break;
			case 3:
				return $this->getInscriptionConfirmationMail();
				break;
			case 4:
				return $this->getInscriptionConditionsTermsPdf();
				break;
			case 5:
				return $this->getCustomQuestion();
				break;
			case 6:
				return $this->getReciboDomiciliadoTxt();
				break;
			case 7:
				return $this->getSecondPaymentMailingBody();
				break;
			case 8:
				return $this->getSecondPaymentMailingBodyNoTpv();
				break;
			case 9:
				return $this->getId();
				break;
			case 10:
				return $this->getCulture();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTitle(),
			$keys[1] => $this->getDescription(),
			$keys[2] => $this->getTextShelter(),
			$keys[3] => $this->getInscriptionConfirmationMail(),
			$keys[4] => $this->getInscriptionConditionsTermsPdf(),
			$keys[5] => $this->getCustomQuestion(),
			$keys[6] => $this->getReciboDomiciliadoTxt(),
			$keys[7] => $this->getSecondPaymentMailingBody(),
			$keys[8] => $this->getSecondPaymentMailingBodyNoTpv(),
			$keys[9] => $this->getId(),
			$keys[10] => $this->getCulture(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SummerFunCenterI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setTitle($value);
				break;
			case 1:
				$this->setDescription($value);
				break;
			case 2:
				$this->setTextShelter($value);
				break;
			case 3:
				$this->setInscriptionConfirmationMail($value);
				break;
			case 4:
				$this->setInscriptionConditionsTermsPdf($value);
				break;
			case 5:
				$this->setCustomQuestion($value);
				break;
			case 6:
				$this->setReciboDomiciliadoTxt($value);
				break;
			case 7:
				$this->setSecondPaymentMailingBody($value);
				break;
			case 8:
				$this->setSecondPaymentMailingBodyNoTpv($value);
				break;
			case 9:
				$this->setId($value);
				break;
			case 10:
				$this->setCulture($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SummerFunCenterI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTitle($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTextShelter($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInscriptionConfirmationMail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setInscriptionConditionsTermsPdf($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCustomQuestion($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setReciboDomiciliadoTxt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSecondPaymentMailingBody($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSecondPaymentMailingBodyNoTpv($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCulture($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SummerFunCenterI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(SummerFunCenterI18nPeer::TITLE)) $criteria->add(SummerFunCenterI18nPeer::TITLE, $this->title);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::DESCRIPTION)) $criteria->add(SummerFunCenterI18nPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::TEXT_SHELTER)) $criteria->add(SummerFunCenterI18nPeer::TEXT_SHELTER, $this->text_shelter);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::INSCRIPTION_CONFIRMATION_MAIL)) $criteria->add(SummerFunCenterI18nPeer::INSCRIPTION_CONFIRMATION_MAIL, $this->inscription_confirmation_mail);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::INSCRIPTION_CONDITIONS_TERMS_PDF)) $criteria->add(SummerFunCenterI18nPeer::INSCRIPTION_CONDITIONS_TERMS_PDF, $this->inscription_conditions_terms_pdf);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::CUSTOM_QUESTION)) $criteria->add(SummerFunCenterI18nPeer::CUSTOM_QUESTION, $this->custom_question);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::RECIBO_DOMICILIADO_TXT)) $criteria->add(SummerFunCenterI18nPeer::RECIBO_DOMICILIADO_TXT, $this->recibo_domiciliado_txt);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY)) $criteria->add(SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY, $this->second_payment_mailing_body);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY_NO_TPV)) $criteria->add(SummerFunCenterI18nPeer::SECOND_PAYMENT_MAILING_BODY_NO_TPV, $this->second_payment_mailing_body_no_tpv);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::ID)) $criteria->add(SummerFunCenterI18nPeer::ID, $this->id);
		if ($this->isColumnModified(SummerFunCenterI18nPeer::CULTURE)) $criteria->add(SummerFunCenterI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SummerFunCenterI18nPeer::DATABASE_NAME);

		$criteria->add(SummerFunCenterI18nPeer::ID, $this->id);
		$criteria->add(SummerFunCenterI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setTextShelter($this->text_shelter);

		$copyObj->setInscriptionConfirmationMail($this->inscription_confirmation_mail);

		$copyObj->setInscriptionConditionsTermsPdf($this->inscription_conditions_terms_pdf);

		$copyObj->setCustomQuestion($this->custom_question);

		$copyObj->setReciboDomiciliadoTxt($this->recibo_domiciliado_txt);

		$copyObj->setSecondPaymentMailingBody($this->second_payment_mailing_body);

		$copyObj->setSecondPaymentMailingBodyNoTpv($this->second_payment_mailing_body_no_tpv);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setCulture(NULL); 
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
			self::$peer = new SummerFunCenterI18nPeer();
		}
		return self::$peer;
	}

	
	public function setSummerFunCenter($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aSummerFunCenter = $v;
	}


	
	public function getSummerFunCenter($con = null)
	{
		if ($this->aSummerFunCenter === null && ($this->id !== null)) {
						include_once 'lib/model/summerFun/om/BaseSummerFunCenterPeer.php';

			$this->aSummerFunCenter = SummerFunCenterPeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aSummerFunCenter;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSummerFunCenterI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSummerFunCenterI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 