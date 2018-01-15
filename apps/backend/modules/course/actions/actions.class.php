<?php

/**
 * course actions.
 *
 * @package    kids
 * @subpackage course
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class courseActions extends autocourseActions
{
    protected function addFiltersCriteria($c)
    {
        $user = $this->getUser();

        if (!$user->hasCredential('administrador')) {
            $c->addJoin(CoursePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // JOIN
            $c->addJoin(SummerFunCenterHasProfilePeer::SUMMER_FUN_CENTER_ID, SummerFunCenterPeer::ID);
            // WHERE
            $c->add(SummerFunCenterHasProfilePeer::PROFILE_ID, $user->getProfile()->getId());
        }

        parent::addFiltersCriteria($c);
    }

    /**
     * Ajax. Devuelve ids de los servicios de un centro. Ej. 1|2
     * @return sfView
     */

    public function executeServicesCentre()
    {
        $services = ServicePeer::getServicesByCenter($this->getRequestParameter('id'));
        $type = $this->getRequestParameter('type');

        $result = '';
        foreach ($services as $service) {
            if ($type == 1) {
                $result .= $service->getId() . '|';
            }
            else {
                $result .= '<option value="' . $service->getId() . '">' . $service . '</option>';
            }
        }

        if ($result != '' && $type == 1) {
            $result = substr($result, 0, -1);
        }

        return $this->renderText($result);
    }

    /**
     * Acción migración entorno 02/04/15.
     * @return sfView
     */

    public function executeUpdateCourses()
    {
        if ($this->getRequestParameter('pass') != 'XbSd45') {
            $this->forward404();
        }

        // Actualizamos las fecha inicio/fin de las semanas.

        $con = sfContext::getInstance()->getDatabaseConnection('propel');
        $query = 'SELECT id, week_id FROM course';
        $stmt = $con->prepareStatement($query);
        $courses = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);

        foreach ($courses as $course)
        {
            $week = WeekPeer::retrieveByPK($course['week_id']);
            if ($week) {
                $course = CoursePeer::retrieveByPK($course['id']);
                $course->setStartsAt($week->getStartsAt());
                $course->setEndsAt($week->getEndsAt());
                $course->save();
            }
        }

        $weeks = WeekPeer::doSelectOrderByCenter();
        foreach ($weeks as $week)
        {
            $week->setCulture('ca');
            $serv = null;
            if ($week->getIsMorningShelter() && $week->getIsAfternoonShelter())
            {
                // Hay que buscar que haya un servicio que coincidan los dos horarios

                $criteria = new Criteria();
                $criteria->add(ServicePeer::CENTER_ID, $week->getCentroId());
                $services = ServicePeer::doSelect($criteria);

                foreach ($services as $service)
                {
                    if (!isset($serv) && count($service->getServiceSchedules()) == 2) {
                        $i = 0;
                        foreach ($service->getServiceSchedules() as $schedule)
                        {
                            $schedule->setCulture('ca');

                            if ($i == 0) {
                                if ($schedule->getName() == $week->getMorningShelterSchedule()) {
                                    $serv = $service;
                                } else {
                                    $serv = null;
                                }
                            } else {
                                if ($schedule->getName() == $week->getAfternoonShelterSchedule()) {
                                    $serv = $service;
                                } else {
                                    $serv = null;
                                }
                            }

                            $i++;
                        }
                    }
                }
            }
            else {
                if ($week->getIsMorningShelter())
                {
                    // Hay que buscar que haya un servicio que tenga un único horario y coincida con el de la mañana

                    $criteria = new Criteria();
                    $criteria->add(ServicePeer::CENTER_ID, $week->getCentroId());
                    $services = ServicePeer::doSelect($criteria);

                    foreach ($services as $service)
                    {
                        if (!isset($serv) && count($service->getServiceSchedules()) == 1) {
                            foreach ($service->getServiceSchedules() as $schedule) {
                                $schedule->setCulture('ca');

                                if ($schedule->getName() == $week->getMorningShelterSchedule()) {
                                    $serv = $service;
                                }
                            }
                        }
                    }
                }
                elseif ($week->getIsAfternoonShelter()) {
                    // Hay que buscar que haya un servicio que tenga un unico horario y coincida con el de la tarde

                    $criteria = new Criteria();
                    $criteria->add(ServicePeer::CENTER_ID, $week->getCentroId());
                    $services = ServicePeer::doSelect($criteria);

                    foreach ($services as $service)
                    {
                        if (!isset($serv) && count($service->getServiceSchedules()) == 1) {
                            foreach ($service->getServiceSchedules() as $schedule) {
                                $schedule->setCulture('ca');

                                if ($schedule->getName() == $week->getAfternoonShelterSchedule()) {
                                    $serv = $service;
                                }
                            }
                        }
                    }
                }
            }

            if (!isset($serv) && ($week->getIsMorningShelter() || $week->getIsAfternoonShelter())) {

                // Hay que crear el servicio con los horarios
                $query = "SELECT count(*) AS NUM_SERVICES FROM service WHERE center_id = {$week->getCentroId()}";
                $stmt = $con->prepareStatement($query);
                $records = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);
                $numRecords = 0;
                foreach ($records as $record)
                {
                    $numRecords = $record['NUM_SERVICES'] + 1;
                }

                $serv = new Service();
                $serv->setCenterId($week->getCentroId());
                $week->setCulture('es');
                $serv->setCulture('es');
                if ($numRecords == 1) {
                    $serv->setName("Servico de acogida");
                    $serv->setDescription($week->getShelterDescription());
                }
                else {
                    $serv->setName("Servei d'acollida $numRecords");
                }
                $week->setCulture('ca');
                $serv->setCulture('ca');
                if ($numRecords == 1) {
                    $serv->setName("Servei d'acollida");
                    $serv->setDescription($week->getShelterDescription());
                }
                else {
                    $serv->setName("Servico de acogida $numRecords");
                }

                $query = "SELECT shelter_price FROM summer_fun_center WHERE id = {$week->getCentroId()}";
                $stmt = $con->prepareStatement($query);
                $results = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);
                foreach ($results as $result) {
                    $serv->setPrice($result['shelter_price']);
                }


                if ($week->getIsMorningShelter()) {
                    $morningSchedule = new ServiceSchedule();
                    $morningSchedule->setOrden(1);
                    $week->setCulture('es');
                    $morningSchedule->setCulture('es');
                    $morningSchedule->setName($week->getMorningShelterSchedule());
                    $morningSchedule->setCulture('ca');
                    $week->setCulture('ca');
                    $morningSchedule->setName($week->getMorningShelterSchedule());

                    $serv->addServiceSchedule($morningSchedule);
                }

                if ($week->getIsAfternoonShelter()) {
                    $morningSchedule = new ServiceSchedule();
                    $morningSchedule->setOrden(2);
                    $week->setCulture('es');
                    $morningSchedule->setCulture('es');
                    $morningSchedule->setName($week->getAfternoonShelterSchedule());
                    $morningSchedule->setCulture('ca');
                    $week->setCulture('ca');
                    $morningSchedule->setName($week->getAfternoonShelterSchedule());

                    $serv->addServiceSchedule($morningSchedule);
                }

                $serv->save();
            }


            if (isset($serv)) {
                $query = "SELECT id FROM course WHERE week_id = {$week->getId()}";
                $stmt = $con->prepareStatement($query);
                $courses = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);

                foreach ($courses as $course) {
                    $query = "INSERT INTO course_has_services VALUES ({$course['id']}, {$serv->getId()})";
                    $stmt = $con->prepareStatement($query);
                    $stmt->executeQuery();

                    // Actualizamos las inscripciones

                    $query = "SELECT id, shelter FROM inscription WHERE student_course_inscription = {$course['id']}";
                    $stmt = $con->prepareStatement($query);
                    $inscriptions = $stmt->executeQuery(ResultSet::FETCHMODE_ASSOC);

                    foreach ($inscriptions as $inscription) {
                        if ($inscription['shelter'] == 1) { // Mañana
                            foreach ($serv->getServiceSchedules() as $schedule) {
                                $query = "INSERT INTO inscription_service_schedule VALUES ({$inscription['id']}, {$schedule->getId()})";
                                $stmt = $con->prepareStatement($query);
                                $stmt->executeQuery();
                            }
                        } elseif ($inscription['shelter'] == 2) { // Tarde
                            $i = 0;
                            foreach ($serv->getServiceSchedules() as $schedule) {
                                if ($i > 0) {
                                    $query = "INSERT INTO inscription_service_schedule VALUES ({$inscription['id']}, {$schedule->getId()})";
                                    $stmt = $con->prepareStatement($query);
                                    $stmt->executeQuery();
                                }
                                $i++;
                            }
                        } elseif ($inscription['shelter'] == 3) { // Mañana y tarde
                            foreach ($serv->getServiceSchedules() as $schedule) {
                                $query = "INSERT INTO inscription_service_schedule VALUES ({$inscription['id']}, {$schedule->getId()})";
                                $stmt = $con->prepareStatement($query);
                                $stmt->executeQuery();
                            }
                        }
                    }
                }
            }
        }

        return sfView::NONE;
    }
}
