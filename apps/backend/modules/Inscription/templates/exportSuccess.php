<?php
	use_helper('Debug');
	use_helper('Date', 'Number');
	
	$tmpDir = sfConfig::get('sf_upload_dir') . '/tmp';
	if (!is_dir($tmpDir)) {
	    mkdir($tmpDir, 0777);
	    chmod($tmpDir, 0777);
	}
	$fname = tempnam($tmpDir, 'export');
	
	$workbook = &new writeexcel_workbook($fname);
	$workbook->set_tempdir($tmpDir);
	$worksheet = &$workbook->addworksheet();
	
	// Set the columns width
	
	$worksheet->set_column(0, 0, 13);
	$worksheet->set_column(1, 1, 24);
	$worksheet->set_column(2, 2, 24);
	$worksheet->set_column(3, 3, 13);
	$worksheet->set_column(4, 4, 30);
	$worksheet->set_column(5, 5, 10);
	$worksheet->set_column(6, 6, 40);
	$worksheet->set_column(7, 7, 12);
	$worksheet->set_column(8, 8, 20);
	$worksheet->set_column(9, 9, 25);
	$worksheet->set_column(10, 11, 25);
	$worksheet->set_column(39, 40, 25);
	
	// Create formats
	
	$border1 =& $workbook->addformat();
	$border1->set_color('black');
	$border1->set_bold();
	$border1->set_size(15);
	$border1->set_pattern(0x1);
	$border1->set_fg_color('white');
	$border1->set_top(6);
	$border1->set_bottom(6);
	$border1->set_left(6);
	$border1->set_align('center');
	$border1->set_align('vcenter');
	$border1->set_merge(); # This is the key feature
	
	$border2 =& $workbook->addformat();
	$border2->set_color('black');
	$border2->set_bold();
	$border2->set_size(15);
	$border2->set_pattern(0x1);
	$border2->set_fg_color('white');
	$border2->set_top(6);
	$border2->set_bottom(6);
	$border2->set_right(6);
	$border2->set_align('center');
	$border2->set_align('vcenter');
	$border2->set_merge(); # This is the key feature
	
	$border3 =& $workbook->addformat();
	$border3->set_color('black');
	$border3->set_bold();
	$border3->set_size(12);
	$border3->set_pattern(0x1);
	$border3->set_fg_color('white');
	$border3->set_top(6);
	$border3->set_bottom(6);
	$border3->set_right(0);
	$border3->set_align('center');
	$border3->set_align('vcenter');
	$border3->set_merge(); # This is the key feature
	
	$center =& $workbook->addformat();
	$center->set_align('center');
	$center->set_size(10);
	
	$header =& $workbook->addformat();
	$header->set_color('black');
	$header->set_align('left');
	$header->set_align('vcenter');
	$header->set_size(10);
	$header->set_pattern();
	$header->set_fg_color('white');
	$header->set_border_color('black');
	$header->set_top(0);
	$header->set_bottom(2);
	$header->set_left(1);
	$header->set_pattern(0x1);
	$header->set_text_wrap(1);
	$header->set_merge(); # This is the key feature
	
	$esquerra =& $workbook->addformat();
	$esquerra->set_align('left');
	$esquerra->set_size(10);
	
	$dreta =& $workbook->addformat();
	$dreta->set_align('right');
	$dreta->set_size(10);

	// CABECERA
	$col = 0;
	foreach ($columns as $key => $value)
	{
		if (in_array($key, $selectedColumns)) {
			$worksheet->write(0, $col, utf8_decode($value), $header);
			$col++;
		}
	}
	
	$row = 2;
	// FILAS
	/** @var  $insc Inscription.php */
	foreach ($inscripcions as $insc)
    {
		$col = 0;
		$visibleCols = 0;
		if (in_array($visibleCols, $selectedColumns)) {
        	$worksheet->write($row, $col, date("d-m-Y H:i", strtotime($insc->getCreatedAt())), $center);
        	$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
        	$worksheet->write($row, $col, $insc->getInscriptionCode(), $center);
        	$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
        	$worksheet->write($row, $col, utf8_decode(CoursePeer::getCourseByInscrptionId($insc->getId())), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, iconv('UTF-8', 'Windows-1252', format_currency(CoursePeer::getPriceCourseByInscrptionId($insc->getId()),'EUR')), $center);
        	$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
        	$worksheet->write($row, $col, utf8_decode(InscriptionPeer::getStateName($insc->getState())), $center);
        	$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
        	$worksheet->write($row, $col, utf8_decode(InscriptionPeer::getIsPaidName($insc->getIsPaid())), $center);
        	$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
        	$worksheet->write($row, $col, utf8_decode(InscriptionPeer::getMethodPaymentName($insc->getMethodPayment())), $center);
        	$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode(InscriptionPeer::getSplitPaymentName($insc->getSplitPayment())), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentName()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentPrimerApellido()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentSegundoApellido()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getStudentBirthDate(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentAddress()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getStudentZip() , $center);
	        $col++;
		}
		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentCity()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, utf8_decode($insc->getProvincia()), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, $insc->getKidsAndUsCenter() ? utf8_decode($insc->getKidsAndUsCenter()->getName()) : '', $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentSchoolYear()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, $insc->getLastCooloffYear() != 0 ? utf8_decode($insc->getLastCooloffYear()) : __('No'), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentFriends()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col,  $insc->getStudentNumTarjetaSanitaria(), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, utf8_decode($insc->getStudentTarjetaSanitariaCompanyia()), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getStudentAllergies() ? utf8_decode(__('Sí')) : __('No'), $center);
	        $col++;
		}
		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getStudentAllergiesDescription()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, utf8_decode($insc->getStudentMedsDescription()), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, $insc->getIsVaccinated() == 1 ? utf8_decode(__('Sí')) : __('No'), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
			$worksheet->write($row, $col, utf8_decode($insc->getStudentComments()), $center);
			$col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getFatherName()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getFatherPrimerApellido()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getFatherSegundoApellido()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getFatherPhone(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getFatherDni(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getFatherMail(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col,  $insc->getIsFatherMailMain() ? utf8_decode(__('Sí')) : __('No') , $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getMotherName()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getMotherPrimerApellido()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, utf8_decode($insc->getMotherSegundoApellido()), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getMotherPhone(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getMotherDni(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col, $insc->getMotherMail(), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) {
	        $worksheet->write($row, $col,  $insc->getIsMotherMailMain() ? utf8_decode(__('Sí')) : __('No'), $center);
	        $col++;
		}

		$visibleCols++;
		if (in_array($visibleCols, $selectedColumns)) { // Grupo
	        if ($insc->getGrupo()) {
	        	$worksheet->write($row, $col,  $insc->getGrupo(), $center);
	        	$visibleCols++;
	        	if (in_array($visibleCols, $selectedColumns)) {
		        	$grupoProfesores = $insc->getGrupo()->getGrupoHasProfesors();
		        	$profesores = '';
		        	foreach ($grupoProfesores as $grupoProfesor) {
		        		$profesores .= $grupoProfesor->getProfesor()->getNombre() . ', ';
		        	}
		        	
		        	if ($profesores != '') {
                        $profesores = substr($profesores, 0, -2);
                    }
                    $col++;
                    $worksheet->write($row, $col, utf8_decode($profesores), $center);
	        	}
                else {
                    $worksheet->write($row, $col, '-', $center);
                }
	        }
            else {
                $worksheet->write($row, $col, '-', $center);
                $visibleCols++;
                if (in_array($visibleCols, $selectedColumns)) {
                    $col++;
                    $worksheet->write($row, $col, '-', $center);
                }
            }
            $col++;
		}
        else { // Profesores
            $visibleCols++;
            if (in_array($visibleCols, $selectedColumns)) {
                $worksheet->write($row, $col, '-', $center);
                $col++;
            }
        }

        $visibleCols++;
        if (in_array($visibleCols, $selectedColumns)) {
            $worksheet->write($row, $col, utf8_decode($insc->getTextServices()), $center);
            $col++;
        }

        $row++;
    }

	$workbook->close();
	$fh = fopen($fname, "rb");
	fpassthru($fh);
	unlink($fname);