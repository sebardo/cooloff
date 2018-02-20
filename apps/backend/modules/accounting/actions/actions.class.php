<?php

/**
 * accounting actions.
 *
 * @package    kids
 * @subpackage accounting
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */

require_once "plugins/php_writeexcel/class.writeexcel_workbook.inc.php";
require_once "plugins/php_writeexcel/class.writeexcel_worksheet.inc.php";

class accountingActions extends sfActions
{
	
	/**
	 * Actualiza un registro (o varios en caso de modificar un padre) de inscripción.
	 * Recibe los siguiente parametros. Si el id contiene P es que se trata de un registro padre.
	 * Array
		(
		    [id] => 1P
		    [discount] => 21.00
		    [beca] => 0.00
		    [firstp] => 0.00
		    [secondp] => 0.00
		)
	 */
	
	public function executeUpdate()
	{
            try
            {
                $request = $this->getRequest();
                if (!$request->isXmlHttpRequest()) {
                        throw $this->createNotFoundException('Invalid request');
                }

                //error_log(print_r($_GET, 1));

                $response['status'] = 'OK';

                $inscription = InscriptionPeer::retrieveByPK($request->getParameter('id'));
                if ($inscription)
                {
                    if (!$request->getParameter('markPaid', null))
                    {

                        if ($request->getParameter('discount-percent') != $inscription->getDiscountPercent())
                        {
                            $course = CoursePeer::retrieveByPK($inscription->getStudentCourseInscription());
                            $totalPrice = $course->getPrice();
                            $totalDiscount = 0;

                            $inscription->setDiscountPercent($request->getParameter('discount-percent'));
                            $services = array();
                            foreach ($inscription->getInscriptionServiceSchedules() as $inscriptionServiceSchedule)
                            {
                                $serviceSchedule = $inscriptionServiceSchedule->getServiceSchedule();
                                $serviceSchedule->setCulture($inscription->getCulture());
                                $service = $serviceSchedule->getService();
                                $service->setCulture($inscription->getCulture());

                                if (!in_array($service->getId(), $services)) {
                                    $totalPrice += $service->getPrice();
                                    array_push($services, $service->getId());
                                }
                            }

                            $totalDiscount = 0;
                            if ($inscription->getDiscountPercent() > 0) {
                                $totalDiscount = $totalPrice * ($inscription->getDiscountPercent() / 100);
                                $totalPrice = $totalPrice - $totalDiscount;
                            }

                            $inscription->setPrice($totalPrice);
                            $inscription->setDiscount($totalDiscount);
                        }

                        $inscription->setDiscountPercent($request->getParameter('discount-percent'));
                        $inscription->setAmountBeca($request->getParameter('beca'));
                        $inscription->setAmountFirstPayment($request->getParameter('firstp'));
                        $inscription->setAmountSecondPayment($request->getParameter('secondp'));
                        $inscription->setMethodPayment($request->getParameter('payment'));

                        $paymentDate = $request->getParameter('paymentdate');
                        if ($paymentDate)
                        {
                            $paymentDate = DateTime::createFromFormat('d/m/Y', $paymentDate);
                            if ($paymentDate) {
                                $inscription->setPaymentDate($paymentDate->format('Y-m-d'));
                            }
                        }else{
                            $inscription->setPaymentDate(null);
                        }

                        $paymentDateSecond = $request->getParameter('paymentdatesecond');
                        if ($paymentDateSecond)
                        {
                            $paymentDateSecond = DateTime::createFromFormat('d/m/Y', $paymentDateSecond);
                            if ($paymentDateSecond) {
                                $inscription->setPaymentDateSecond($paymentDateSecond->format('Y-m-d'));
                            }
                        }else{
                            $inscription->setPaymentDateSecond(null);
                        }

                        if ($inscription->getPendingAmount() == 0)
                        {
                                $inscription->setIsPaid(2);
                        } else {
							
							if ($inscription->getAmountFirstPayment() != $inscription->getPrice()) {
								//send email 50%
								$mailsEnviar[1][1] = $inscription->getFatherMail();
								util::enviarAviso($inscription, $mailsEnviar, 'half');
							}
						}

                        $inscription->save();
						
                        //send email 100%
                        //$mailsEnviar[1][1] = $inscription->getFatherMail();
                        //util::enviarAviso($inscription, $mailsEnviar, 'all');
                    }
                    else {
                    // Recupermos todas las inscripciones que comparten inscription_num
                    $inscriptions = InscriptionPeer::retrieveByInscriptionNum($inscription->getInscriptionNum());
                    foreach ($inscriptions as $inscription)
                    {
                            if ($inscription->getState() === 0)
                            {
                                $pendingAmount = $inscription->getPendingAmount();
                                if ($pendingAmount > 0)
                                {
                                    $inscription->setAmountSecondPayment($inscription->getAmountSecondPayment() + $pendingAmount);
                                    $inscription->setPaymentDate(date('Y-m-d'));
                                }
                                $inscription->setIsPaid(2);
                                $inscription->save();
                                
                                
                            }
                        }
                    }
                }
			
                $con = sfContext::getInstance()->getDatabaseConnection('propel');
                $query = $this->getMainSql() . " AND i.inscription_num = " . $inscription->getInscriptionNum() . " GROUP BY i.inscription_num " . $this->getOrderSql();
                $rsGrouped = $con->prepareStatement($query)->executeQuery(ResultSet::FETCHMODE_ASSOC);		
                $array = array();

                if ($rsGrouped->getRecordCount() > 0) 
                {
                        foreach ($rsGrouped as $resultGrouped)
                        {
                                $array['group']['discount'] = $resultGrouped['IMPORTE_DESCUENTO'];
                                $array['group']['discountPercent'] = $resultGrouped['IMPORTE_DESCUENTO_PORCENTAJE'];
                                $array['group']['beca'] = $resultGrouped['IMPORTE_BECA'];
                                $array['group']['firstp'] = $resultGrouped['IMPORTE_PRIMER_PAGO'];
                                $array['group']['secondp'] = $resultGrouped['IMPORTE_SEGUNDO_PAGO'];
                                $array['group']['pamount'] = $resultGrouped['IMPORTE_TOTAL_PENDIENTE'];
                                $array['group']['amount'] = $resultGrouped['IMPORTE_TOTAL_A_PAGAR'];
                                $array['group']['num'] = $resultGrouped['inscription_num'];
                                $array['group']['payment'] = $resultGrouped['method_payment'];
                                $array['group']['paymentdate'] = $resultGrouped['payment_date_formatted'];
                                $array['group']['paymentdatesecond'] = $resultGrouped['payment_date_second_formatted'];

                                if ($resultGrouped['NUM_REG'] > 1)
                                {
                if (!isset($inscriptions)) {
                    $inscriptions[] = $inscription;
                }

                foreach ($inscriptions as $inscription)
                {
                    $query = $this->getMainSql() . " AND i.id = " . $inscription->getId() . " GROUP BY i.id " . $this->getOrderSql();
                    $rsRow = $con->prepareStatement($query)->executeQuery(ResultSet::FETCHMODE_ASSOC);

                    if ($rsRow->getRecordCount() > 0)
                    {
                        foreach ($rsRow as $resultRow) {
                            $data['id'] = $resultRow['id'];
                            $data['discount'] = $resultRow['IMPORTE_DESCUENTO'];
                            $data['discountPercent'] = $resultRow['IMPORTE_DESCUENTO_PORCENTAJE'];
                            $data['beca'] = $resultRow['IMPORTE_BECA'];
                            $data['firstp'] = $resultRow['IMPORTE_PRIMER_PAGO'];
                            $data['secondp'] = $resultRow['IMPORTE_SEGUNDO_PAGO'];
                            $data['pamount'] = $resultRow['IMPORTE_TOTAL_PENDIENTE'];
                            $data['amount'] = $resultRow['IMPORTE_TOTAL_A_PAGAR'];
                            $data['payment'] = $resultRow['method_payment'];
                            $data['paymentdate'] = $resultRow['payment_date_formatted'];
                            $data['paymentdatesecond'] = $resultRow['payment_date_second_formatted'];

                            $array['rows'][] = $data;
                            break;
                        }
                    }
                    else {
                        $response['status'] = 'KO';
                    }
                }
                                }

                                break;
                        }
                }
                else {
                        $response['status'] = 'KO';
                }

                $response['message'] = $array;

                return $this->renderText(json_encode($response));
            }
            catch (Exception $e) {
                $response['status'] = 'KO';
                $response['message'] = $e->getMessage();
                return $this->renderText(json_encode($response));
            }
	}
	
	public function executeList()
	{
		$this->processFilters();
		$this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/accounting/filters');
		$page = $this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/accounting'));
		$this->pager = $this->getPager($page, 10);
		
		// save page
		if ($this->getRequestParameter('page')) {
			$this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/accounting');
		}
		
		// Obtenemos los registros sin agrupar
		$this->inscriptions = $this->getRecordsNotGrouped($this->pager);
		
		$this->totals = $this->getTotals();
	}
	
	private function getPager($offset = 0, $max = 15)
	{
		$con = sfContext::getInstance()->getDatabaseConnection('propel');
		
		$query = $this->getSqlGrouped();
		
		// prepare the statement
		$stmt = $con->prepareStatement($query);

		// time to call our shiny new pager!
		$pager = new sfAdvancedPropelPager('Inscription', $max);
		$pager->setPage($offset);
  		$pager->setStatement($stmt);
		
		$pager->init();
		
		return $pager;
	}
	
	private function getRecordsNotGrouped($pager)
	{
		$inscriptions = $pager->getResultsAsRowset();
		
		$ids = '';
		foreach ($inscriptions as $inscription) {
			$ids .= $inscription['ids'] . ",";
		}
		
		if ($ids)
		{
			$ids = substr($ids, 0, -1);
			$con = sfContext::getInstance()->getDatabaseConnection('propel');
			
			$query = $this->getSqlNotGrouped($ids);
			
			// prepare the statement
			$stmt = $con->prepareStatement($query);
			
			return $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);
		}
		
		return array();
	}
	
	/**
	 * Obtiene array con los totales sin paginacion ni agrupación
	 */
	
	private function getTotals()
	{
		$con = sfContext::getInstance()->getDatabaseConnection('propel');
		
		$query = $this->getMainSql();
		
		if (isset($this->filters['pagament']) && $this->filters['pagament'] == 1) {
			$query .= " HAVING IMPORTE_TOTAL_PENDIENTE > 0 ";
		}
		
		$stmt = $con->prepareStatement($query);
		
		return $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);
	}
	
	private function getMainSql()
	{
		$user = $this->getUser();
		$user->getCulture();
		
		$query = "SELECT i.father_dni,
						 CONCAT_WS(' ', i.father_name, i.father_primer_apellido, i.father_segundo_apellido) AS father_name, i.father_mail AS father_mail, 
						 CONCAT(IF(i.father_phone IS NOT NULL, i.father_phone, ''), IF(i.mother_phone IS NOT NULL AND i.mother_phone != '', CONCAT(' / ', i.mother_phone), '')) AS phones,
						 CONCAT_WS(' ', i.student_name, i.student_primer_apellido, i.student_segundo_apellido) AS student_name,
				  		 i.inscription_code,
						 CONCAT(sfct.title, ' - Del ', DATE_FORMAT(c.starts_at, '%d/%m/%Y'), ' al ', DATE_FORMAT(c.ends_at, '%d/%m/%Y'), ' - ', ct.schedule) AS week_title,
						 CONCAT('Del ', DATE_FORMAT(c.starts_at, '%d/%m/%Y'), ' al ', DATE_FORMAT(c.ends_at, '%d/%m/%Y')) AS week_title_short,
						 i.method_payment,
						 SUM(i.price) AS IMPORTE_TOTAL_A_PAGAR,
						 SUM(i.discount) AS IMPORTE_DESCUENTO,
						 SUM(i.discountPercent) AS IMPORTE_DESCUENTO_PORCENTAJE,
						 SUM(i.amount_beca) AS IMPORTE_BECA,
						 SUM(IF(i.amount_beca > 0, 1, 0)) AS CANTIDAD_BECAS,
						 SUM(i.amount_first_payment) AS IMPORTE_PRIMER_PAGO,
						 SUM(i.amount_second_payment) AS IMPORTE_SEGUNDO_PAGO,
						 SUM(i.price - i.amount_beca - i.amount_first_payment - i.amount_second_payment) AS IMPORTE_TOTAL_PENDIENTE,
						 GROUP_CONCAT(i.id) AS ids,
						 i.inscription_num,
						 i.id,
						 COUNT(i.id) AS NUM_REG,
						 i.student_photo,
                         IF(i.payment_date IS NOT NULL, DATE_FORMAT(i.payment_date, '%d/%m/%Y'), NULL) AS payment_date_formatted,
                         IF(i.payment_date_second IS NOT NULL, DATE_FORMAT(i.payment_date_second, '%d/%m/%Y'), NULL) AS payment_date_second_formatted,
                         i.payment_date,
                         i.payment_date_second
				  FROM inscription AS i
				  INNER JOIN course AS c ON c.id = i.student_course_inscription
				  INNER JOIN course_i18n AS ct ON (c.id = ct.id AND ct.culture = '{$user->getCulture()}')
				  INNER JOIN summer_fun_center AS sfc ON c.summer_fun_center_id = sfc.id
				  INNER JOIN summer_fun_center_i18n AS sfct ON (sfc.id = sfct.id AND sfct.culture = '{$user->getCulture()}')
				  ##TABLES##
				  WHERE i.inscription_num IS NOT NULL
				  AND i.state = 0 AND i.is_paid != 3";
		
		if (isset($this->filters['inscription_code']) && $this->filters['inscription_code'] !== '') {
			$query .= " AND i.inscription_code = '" . addslashes($this->filters['inscription_code']) . "'";
		}
        if (isset($this->filters['student_course_inscription']) && $this->filters['student_course_inscription'] !== '') {
            $query .= " AND i.student_course_inscription = " . $this->filters['student_course_inscription'];
        }
		if (isset($this->filters['father_dni']) && $this->filters['father_dni'] !== '') {
			$query .= " AND i.father_dni = '" . addslashes($this->filters['father_dni']) . "'";
		}
		if (isset($this->filters['father_name']) && $this->filters['father_name'] !== '') {
			$query .= " AND i.father_name = '" . addslashes($this->filters['father_name']) . "'";
		}
		if (isset($this->filters['father_primer_apellido']) && $this->filters['father_primer_apellido'] !== '') {
			$query .= " AND i.father_primer_apellido = '" . addslashes($this->filters['father_primer_apellido']) . "'";
		}
		if (isset($this->filters['father_segundo_apellido']) && $this->filters['father_segundo_apellido'] !== '') {
			$query .= " AND i.father_segundo_apellido = '" . addslashes($this->filters['father_segundo_apellido']) . "'";
		}
		if (isset($this->filters['student_segundo_apellido']) && $this->filters['student_segundo_apellido'] !== '') {
			$query .= " AND i.student_segundo_apellido = '" . addslashes($this->filters['student_segundo_apellido']) . "'";
		}
		if (isset($this->filters['student_name']) && $this->filters['student_name'] !== '') {
			$query .= " AND i.student_name = '" . addslashes($this->filters['student_name']) . "'";
		}
		if (isset($this->filters['student_primer_apellido']) && $this->filters['student_primer_apellido'] !== '') {
			$query .= " AND i.student_primer_apellido = '" . addslashes($this->filters['student_primer_apellido']) . "'";
		}
		if (isset($this->filters['student_segundo_apellido']) && $this->filters['student_segundo_apellido'] !== '') {
			$query .= " AND i.student_segundo_apellido = '" . addslashes($this->filters['student_segundo_apellido']) . "'";
		}
		if (isset($this->filters['center']) && $this->filters['center'] !== '') {
			$query .= " AND sfc.id = '" . addslashes($this->filters['center']) . "'";
		}
        if (isset($this->filters['payment_method']) && $this->filters['payment_method'] != '') {
			$query .= " AND i.method_payment = " . $this->filters['payment_method'];
		}
        if (isset($this->filters['payment_date']) && is_array($this->filters['payment_date'])) {

            $dates = $this->filters['payment_date'];
            if (isset($dates['from'])) {
                $date = DateTime::createFromFormat('Y/m/d', $dates['from']);
                if (!$date) {
                    $date = DateTime::createFromFormat('d/m/Y', $dates['from']);
                }

                if ($date) {
                    $query .= " AND i.payment_date >= '" . $date->format('Y-m-d') . "'";
                }
            }

            if (isset($dates['to'])) {
                $date = DateTime::createFromFormat('Y/m/d', $dates['to']);
                if (!$date) {
                    $date = DateTime::createFromFormat('d/m/Y', $dates['to']);
                }

                if ($date) {
                    $query .= " AND i.payment_date <= '" . $date->format('Y-m-d') . "'";
                }
            }
        }

		$user = sfContext::getInstance()->getUser();
		if (!$user->hasCredential('administrador'))
		{
            $query = str_replace('##TABLES##', 'INNER JOIN summer_fun_center_has_profile AS sfcp ON sfcp.summer_fun_center_id = sfc.id', $query);
			$query .= " AND sfcp.profile_id = {$user->getProfile()->getId()}";
		}
        else {
            $query = str_replace('##TABLES##', '', $query);
        }

		return $query;
	}
	
	private function getOrderSql()
	{
		$sort = $this->getRequestParameter('sort', $this->getUser()->getAttribute('sort', 'i.created_at', 'sf_admin/accounting/sort'));
		$type = $this->getRequestParameter('type', $this->getUser()->getAttribute('type', 'desc', 'sf_admin/accounting/sort'));
		
		// save page
		if ($this->getRequestParameter('sort')) {
			$this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/accounting/sort');
		}
		
		if ($this->getRequestParameter('type')) {
			$this->getUser()->setAttribute('type', $this->getRequestParameter('type'), 'sf_admin/accounting/sort');
		}
		
		return "ORDER BY $sort $type";
	}
	
	protected function processFilters()
	{
		if ($this->getRequest()->hasParameter('filter'))
		{
			$filters = $this->getRequestParameter('filters');
	
			$this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/accounting');
			$this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/accounting/filters');
			$this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/accounting/filters');
		}
	}
	
	/**
	 * Deveulve la consulta con los datos agrupados por número de inscripción
	 * @return string
	 */
	
	private function getSqlGrouped()
	{
		$query = $this->getMainSql() . " GROUP BY i.inscription_num ";
		
		if (isset($this->filters['pagament']) && $this->filters['pagament'] == 1) {
			$query .= "HAVING IMPORTE_TOTAL_PENDIENTE > 0 ";
		}
		
		$query .=  $this->getOrderSql();
		
		return $query;
	}
	
	/**
	 * Deveulve la consulta con los datos sin agrupar (usando los ids involucrados en la agrupación)
	 * @return string
	 */
	
	private function getSqlNotGrouped($ids)
	{
		$query = $this->getMainSql() . " AND i.id IN ($ids) GROUP BY i.id ";
		
		if (isset($this->filters['pagament']) && $this->filters['pagament'] == 1) {
			$query .= "HAVING IMPORTE_TOTAL_PENDIENTE > 0 ";
		}
			
		$query .= $this->getOrderSql();
		
		return $query;
	}
	
	/**
	 * Realiza el export a excel
	 */
	
	public function executeExport()
	{
		$this->processFilters();
		$this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/accounting/filters');
		
		$con = sfContext::getInstance()->getDatabaseConnection('propel');
		$query = $this->getSqlGrouped();
		$this->inscriptionsGrouped = $con->prepareStatement($query)->executeQuery(ResultSet::FETCHMODE_ASSOC);
		
		$ids = '';
		foreach ($this->inscriptionsGrouped as $inscription) {
			$ids .= $inscription['ids'] . ",";
		}
		
		if ($ids)
		{
			$ids = substr($ids, 0, -1);
			$query = $this->getSqlNotGrouped($ids);
			
			// prepare the statement
			$stmt = $con->prepareStatement($query);
				
			$this->inscriptionsNotGrouped = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);
		}
		
		error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
		set_time_limit(10000);
		
		$this->getResponse()->setContentType('application/x-msexcel; name="export.xls"');
		$this->getResponse()->setHttpHeader('Content-Disposition', 'inline; filename="export.xls"');
		$this->setLayout(false);
	}
}
