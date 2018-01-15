<?php

/**
 * Subclass for performing query and update operations on the 'inscription' table.
 *
 *
 *
 * @package lib.model.inscriptions
 */
class InscriptionPeer extends BaseInscriptionPeer
{
    const NO_SHELTER = 0;
    const MORNING_SHELTER = 1;
    const AFTERNOON_SHELTER = 2;
    const MORNING_AND_AFTERNOON_SHELTER = 3;

    const STATE_ACCEPTED = 0;
    const STATE_WAITING = 1;

    const IS_PAID_0 = 0;
    const IS_PAID_50 = 1;
    const IS_PAID_100 = 2;
    const IS_PAID_TPV = 3;

    const METHOD_PAYMENT_TRANSFER = 0;
    const METHOD_PAYMENT_CASH = 1;
    const METHOD_PAYMENT_RECIBO = 2;
    const METHOD_PAYMENT_TPV = 3;

    const SPLIT_PAYMENT_FALSE = 0;
    const SPLIT_PAYMENT_TRUE = 1;

    public static function getStateFilterArray()
    {
        $statusNamesFilter = array(
            self::STATUS_IMPORTED => 'Importat2',
            self::STATUS_PENDING => 'Pendent',
            self::STATUS_ACCEPTED => 'Acceptat',
            self::STATUS_REJECTED => 'No acceptat',
        );

        return $statusNamesFilter;
    }

    public static function getPaymentMethodFilterArray()
    {
        return self::$methodPaymentMap;
    }

    private static $splitShelterMap = array(
        self::NO_SHELTER => 'No',
        self::MORNING_SHELTER => 'Matí',
        self::AFTERNOON_SHELTER => 'Tarda',
        self::MORNING_AND_AFTERNOON_SHELTER => 'Matí i tarda',
    );

    private static $splitPaymentMap = array(
        self::SPLIT_PAYMENT_TRUE => 'registration.trans74',
        self::SPLIT_PAYMENT_FALSE => 'registration.trans75',

    );

    private static $methodPaymentMap = array(
        self::METHOD_PAYMENT_TRANSFER => 'registration.trans123',
        self::METHOD_PAYMENT_CASH => 'registration.trans0',
        self::METHOD_PAYMENT_RECIBO => 'registration.trans198',
        self::METHOD_PAYMENT_TPV => 'registration.trans205',
    );

    private static $stateNamesMap = array(
        self::STATE_ACCEPTED => 'registration.trans251',
        self::STATE_WAITING => 'registration.trans252',
    );

    private static $isPaidNamesMap = array(
        self::IS_PAID_0 => 'registration.trans247',
        self::IS_PAID_50 => 'registration.trans248',
        self::IS_PAID_100 => 'registration.trans249',
        self::IS_PAID_TPV => 'registration.trans250',

    );

    public static function getShelterNames()
    {
        return self::$splitShelterMap;
    }

    public static function getShelterName($id)
    {
        if (!isset(self::$splitShelterMap[$id])) {

            throw new Exception();

        }
        return self::$splitShelterMap[$id];
    }

    public static function getMethodPaymentNames()
    {
        return self::$methodPaymentMap;
    }

    public static function getMethodPaymentName($id)
    {

        if (!isset(self::$methodPaymentMap[$id])) {
            throw new Exception();
        }
        return __(self::$methodPaymentMap[$id]);

    }

    public static function getIsPaidNames()
    {
        return array(
            self::IS_PAID_0 => 'registration.trans247',
            self::IS_PAID_50 => 'registration.trans248',
            self::IS_PAID_100 => 'registration.trans249'
        );
    }

    public static function getIsPaidName($id)
    {
        if (!isset(self::$isPaidNamesMap[$id])) {
            throw new Exception();
        }
        return self::$isPaidNamesMap[$id];

    }

    public static function getStatesNames()
    {
        return self::$stateNamesMap;
    }


    public static function getStateName($id)
    {
        if (!isset(self::$stateNamesMap[$id])) {
            throw new Exception();
        }
        return self::$stateNamesMap[$id];
    }

    public static function getSplitPaymentName($id)
    {

        if (!isset(self::$splitPaymentMap[$id])) {
            throw new Exception();
        }
        return __(self::$splitPaymentMap[$id]);

    }

    public static function doSelectInscriptionsByCourse($id)
    {
        $c = new Criteria();
        $c->add(self::STUDENT_COURSE_INSCRIPTION, $id);
        $c->add(self::STATE, self::STATE_ACCEPTED);
        $inscriptions = self::doSelect($c);
        return $inscriptions;
    }

    public static function getNumberInscriptionAccepted($id)
    {
        $c = new Criteria();
        $c->add(CoursePeer::ID, $id);
        $c->add(InscriptionPeer::STATE, InscriptionPeer::STATE_ACCEPTED);
        $c->addJoin(self::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);
        $inscriptions = self::doSelect($c);

        return $inscriptions;
    }

    public static function getNumberInscriptionWaiting($id)
    {
        $c = new Criteria();
        $c->add(CoursePeer::ID, $id);
        $c->add(InscriptionPeer::STATE, InscriptionPeer::STATE_WAITING);
        $c->addJoin(self::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);
        $inscriptions = self::doSelect($c);

        return $inscriptions;
    }

    public static function getCourseByCenter($id)
    {
        $c = new Criteria();
        $c->add(self::SUMMER_FUN_CENTER_ID, $id);
        $c->addJoin(self::WEEK_ID, WeekPeer::ID);

        $c->addAscendingOrderByColumn(WeekPeer::STARTS_AT);
        $courses = self::doSelect($c);

        return $courses;
    }

    public static function getLastCodeInscription()
    {
        $conexion = Propel::getConnection();
        $consulta = 'SELECT MAX(%s) AS max FROM %s';
        $consulta = sprintf($consulta, InscriptionPeer::INSCRIPTION_CODE, InscriptionPeer::TABLE_NAME);
        $sentencia = $conexion->prepareStatement($consulta);
        $resultset = $sentencia->executeQuery();
        $resultset->next();
        $max = $resultset->getInt('max');

        return $max;
    }

    public static function getLastNumInscription()
    {
        $conexion = Propel::getConnection();
        $consulta = 'SELECT MAX(%s) AS max FROM %s';
        $consulta = sprintf($consulta, InscriptionPeer::INSCRIPTION_NUM, InscriptionPeer::TABLE_NAME);
        $sentencia = $conexion->prepareStatement($consulta);
        $resultset = $sentencia->executeQuery();
        $resultset->next();
        $max = $resultset->getInt('max');

        return $max;
    }

    public static function doSelectInsciptionsByInscriptionCode($inscriptionCode)
    {
        $c = new Criteria();
        $c->add(self::INSCRIPTION_CODE, $inscriptionCode);
        $inscriptions = self::doSelect($c);

        return $inscriptions;
    }

    public static function addCriteriaSearchByWeek($c, $weeks)
    {
        $c->addJoin(self::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);
        $c->add(CoursePeer::ID, $weeks, Criteria::IN);

        return $c;
    }

    public static function retrieveByInscriptionNum($inscriptionNum)
    {
        $con = Propel::getConnection(self::DATABASE_NAME);
        $criteria = new Criteria();
        $criteria->add(InscriptionPeer::INSCRIPTION_NUM, $inscriptionNum);
        $criteria->addAscendingOrderByColumn(InscriptionPeer::INSCRIPTION_CODE);

        return InscriptionPeer::doSelect($criteria, $con);
    }

    public static function findByIdAndTpvSuffix($number)
    {
        $query = "SELECT id FROM inscription WHERE CONCAT(id, '-', tpv_suffix) = '$number'";
        $con = sfContext::getInstance()->getDatabaseConnection('propel');
        $stmt = $con->prepareStatement($query);

        $resultSet = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);
        if ($resultSet->next()) {
            $inscription['id'] = $resultSet->getInt('id');
            return $inscription;
        }

        return null;
    }

    public static function retrieveForSecondPaymentMailing()
    {
        $con = Propel::getConnection(self::DATABASE_NAME);
        $criteria = new Criteria();
        //$criteria->add(InscriptionPeer::METHOD_PAYMENT, self::METHOD_PAYMENT_TPV);
        $criteria->add(InscriptionPeer::SPLIT_PAYMENT, self::SPLIT_PAYMENT_TRUE);
        $criteria->addJoin(self::STUDENT_COURSE_INSCRIPTION, CoursePeer::ID);
        $criteria->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);

        $c2 = $criteria->getNewCriterion(SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE, date('Y-m-d'));
        $c2->addOr($criteria->getNewCriterion(SummerFunCenterPeer::SECOND_PAYMENT_DATE, date('Y-m-d')));

        $criteria->add($c2);

        //$criteria->add(SummerFunCenterPeer::SECOND_PAYMENT_MAILING_DATE, date('Y-m-d'));
        //$criteria->add(SummerFunCenterPeer::SECOND_PAYMENT_DATE, date('Y-m-d'));

        return InscriptionPeer::doSelect($criteria, $con);
    }
}
