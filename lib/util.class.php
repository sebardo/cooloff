<?php
/**
 * Created by JetBrains PhpStorm.
 * User: marc
 * Date: 26/03/13
 * Time: 18:48
 * To change this template use File | Settings | File Templates.
 */

class util extends sfActions
{
    public static function generarPdf($inscripciones)
    {
        $pdf = new sfTCPDF();

        $pdf->SetCreator('Kids&Us');
        $pdf->SetAuthor('Kids&Us');
        $pdf->SetTitle('Kids&Us');
        $pdf->SetSubject('Kids&Us');
        $pdf->SetKeywords('Kids&Us');

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(10);

        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
        $pdf->setLanguageArray('ca');
        $pdf->setFontSubsetting(true);
        $pdf->setPrintFooter(true);

// set font

        $pdf->SetFont(sfTCPDF::FONT, sfTCPDF::FONT_STYLE, sfTCPDF::FONT_SIZE);

        $pdf->setTypeFooter('');
    	
        list($pdf, $mailCentre) = Util::pdf($pdf, $inscripciones);

        return array($pdf, $mailCentre);
    }

    
    public static function pdf($pdf, $inscripciones)
    {
    	$discountAmount = 0;
    	$discountPercent = 0;
    	$aplicarDescento =  true;
        $lineBreakHeight = 6;
        for ($i = 1; $i <= count($inscripciones); $i++)
        {
            $pdf->SetFont(sfTCPDF::FONT, sfTCPDF::FONT_STYLE, sfTCPDF::FONT_SIZE);
            $preu[$i] = 0;
            $inscCode[$i] = 0;
            
            $insc = InscriptionPeer::retrieveByPK($inscripciones[$i][1]);
            
            $discountPercent = $insc->getDiscountPercent();
            
            if ($insc->getState() == 1) {
            	$aplicarDescento = false;
            }
            
            $pdf->setTypeHeader($insc->getInscriptionCode(), sfContext::getInstance()->getI18N()->__('registration.trans147'), sfContext::getInstance()->getI18N()->__('registration.trans148'));
            $pdf->AddPage();

            $inscCode[$i]=$insc->getInscriptionCode();

			// PRIMERA LINEA
            $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans13') . ":", 0, 0, 'L', 0, '', 0, false, 'M', 'M');
            
            if ($insc->getStudentPhoto()) {
            	$image =  sfConfig::get('app_inscripcion_imagen_directorio') . $insc->getStudentPhoto();

                if (file_exists($image))
                {
                    $pdf->SetXY(175, 35);
                    $pdf->Image($image, '', '', 0, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
                }
            }
           	else {
           	}
           	
           	$pdf->Ln(10);
            
            // SEGUNDA LINEA
            $text = sfContext::getInstance()->getI18N()->__('registration.trans52');
            $width = util::getTextWidth($pdf, $text);
            $pdf->Cell($width, sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell($insc->getStudentPhoto() ? 100 - $width : 100, sfTCPDF::FONT_HEIGHT, $insc->getFullStudentName(), array('B' => array('dash' => 1, 'width' => 0, 'cap' => 'butt', 'join' => 'miter')), 0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans53');
            $width = util::getTextWidth($pdf, $text);
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell($insc->getStudentPhoto() ? 50 - $width : 0, sfTCPDF::FONT_HEIGHT, date("d-m-Y", strtotime($insc->getStudentBirthDate())) , array('B' => array('dash' => 1, 'width' => 0)), 0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);

            // TERCERA LINEA
            $text = sfContext::getInstance()->getI18N()->__('registration.trans15');
            $width = util::getTextWidth($pdf, $text);
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell($insc->getStudentPhoto() ? 100 - $width : 100, sfTCPDF::FONT_HEIGHT, $insc->getStudentAddress() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans17');
            $width = util::getTextWidth($pdf, $text);
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell($insc->getStudentPhoto() ? 50 - $width : 0, sfTCPDF::FONT_HEIGHT, $insc->getStudentZip() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // CUARTA LINEA
            $text = sfContext::getInstance()->getI18N()->__('registration.trans16');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell($insc->getProvincia() ? 100 : 0, sfTCPDF::FONT_HEIGHT, $insc->getStudentCity() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            if ($insc->getProvincia()) {
            	$text = sfContext::getInstance()->getI18N()->__('registration.trans164') . ":";
            	$pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            	$pdf->Cell(0, sfTCPDF::FONT_HEIGHT, utf8_encode($insc->getProvincia()->getNombre()) , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            }
            $pdf->Ln($lineBreakHeight);
            
            // QUINTA LINEA        
            $text = sfContext::getInstance()->getI18N()->__('registration.trans149');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getFullFatherName() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // SEXTA LINEA
            $text = sfContext::getInstance()->getI18N()->__('registration.trans19');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(25, sfTCPDF::FONT_HEIGHT, $insc->getFatherDni() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans20');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(25, sfTCPDF::FONT_HEIGHT, $insc->getFatherPhone() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans21');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getFatherMail() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // SÉPTIMA LINEA
            $text = sfContext::getInstance()->getI18N()->__('registration.trans149');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getFullMotherName() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // OCATAVA LINEA
            $text = sfContext::getInstance()->getI18N()->__('registration.trans19');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(25, sfTCPDF::FONT_HEIGHT, $insc->getMotherDni() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans20');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(25, sfTCPDF::FONT_HEIGHT, $insc->getMotherPhone() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans21');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getMotherMail() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // SEPARADOR
            $pdf->Cell(0, 0, '', array('B'=>array('dash'=>0,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln(8);

            //$studentOriginSummerFunCenter = SummerFunCenterPeer::retrieveByPKWithI18n($insc->getStudentOriginSummerFunCenter());

            // LINEA 9
            $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans23') . ":", 0, 0, 'L', 0, '', 0, false, 'M', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // LINEA 10
            $text = sfContext::getInstance()->getI18N()->__('registration.trans24');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getKidsAndUsCenter()->getName() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            /*
            else {
                $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentOriginSummerFunCenterAltre() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            }
            */
            $pdf->Ln($lineBreakHeight);
            
			// LINEA 11    
            $text = sfContext::getInstance()->getI18N()->__('registration.trans168');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(50, sfTCPDF::FONT_HEIGHT, $insc->getStudentSchoolYear() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');

            /*
            $text = sfContext::getInstance()->getI18N()->__('registration.trans169') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getIsStudentKidAndUs() == 1 ? sfContext::getInstance()->getI18N()->__('registration.trans170') : sfContext::getInstance()->getI18N()->__('registration.trans60'), array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            */

            $text = sfContext::getInstance()->getI18N()->__('registration.trans229') . ':';
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getLastCooloffYear() != 0 ? $insc->getLastCooloffYear() : sfContext::getInstance()->getI18N()->__('registration.trans60'), array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln(8);
            
            // SEPARADOR
            $pdf->Cell(0, 0, '', array('B'=>array('dash'=>0,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln(8);
            
            // LINEA 12
            $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans26') . ":", 0, 0, 'L', 0, '', 0, false, 'M', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // LINEA 13 - Alergias
            $text = sfContext::getInstance()->getI18N()->__('registration.trans27') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('alergia_si' . $i, 5, $insc->getStudentAllergies() ? true : false);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('alergia_no' . $i, 5, $insc->getStudentAllergies() ? false : true);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans41');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentAllergiesDescription() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans190') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');

            $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('meds_si' . $i, 5, $insc->getStudentMeds() == 1);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('meds_no' . $i, 5, $insc->getStudentMeds() == 0);

            if ($insc->getStudentMeds() == 1)
            {
                $pdf->Ln($lineBreakHeight);
                $text = sfContext::getInstance()->getI18N()->__('registration.trans41');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentMedsDescription() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            }
            $pdf->Ln($lineBreakHeight);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans237') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');

            $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('vaccinated_si' . $i, 5, $insc->getIsVaccinated() == 1);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('vaccinated_no' . $i, 5, $insc->getIsVaccinated() == 0);
            $pdf->Ln($lineBreakHeight);

            
            // LINEA 14 - Discapacidad
            /*
            $text = sfContext::getInstance()->getI18N()->__('registration.trans172') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('discapacidad_si' . $i, 5, $insc->getStudentDisability() != null);
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('discapacidad_no' . $i, 5, $insc->getStudentDisability() == null);
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans173') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(20, sfTCPDF::FONT_HEIGHT, $insc->getStudentDisabilityLevel() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans174') . ":";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentDisability() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            */

            if (sfContext::getInstance()->getUser()->getCulture() != 'fr') {
                // LINEA 15 - Tarjeta Sanitaria
                $text = sfContext::getInstance()->getI18N()->__('registration.trans166') . ":";
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->Cell(50, sfTCPDF::FONT_HEIGHT, $insc->getStudentNumTarjetaSanitaria(), array('B' => array('dash' => 1, 'width' => 0)), 0, 'C', 0, '', 0, false, 'C', 'M');
                $text = sfContext::getInstance()->getI18N()->__('registration.trans167') . ":";
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentTarjetaSanitariaCompanyia() ? $insc->getStudentTarjetaSanitariaCompanyia() : 'CATSALUT', array('B' => array('dash' => 1, 'width' => 0)), 0, 'C', 0, '', 0, false, 'C', 'M');
                $pdf->Ln(8);
            }
            
            // LINEA 16
            $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans29'), 0, 0, 'L', 0, '', 0, false, 'M', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // LINEA 17
            $studentInscrCenter = SummerFunCenterPeer::doSelectOneByCourseId($insc->getStudentCourseInscription());
            $text = sfContext::getInstance()->getI18N()->__('registration.trans30');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $studentInscrCenter->getTitle() , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln($lineBreakHeight);
            
            // LINEA 18
            /*
            $text = sfContext::getInstance()->getI18N()->__('Servei d\'acollida:');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('acogida_si' . $i, 5, $insc->getShelter() == 1);
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('acogida_no' . $i, 5, $insc->getShelter() == 0);
            $pdf->Ln($lineBreakHeight);
            */

            $height = 9;

            if (sfContext::getInstance()->getUser()->getCulture() != 'fr')
            {
                // LINEA 19
                $text = sfContext::getInstance()->getI18N()->__("registration.trans226") . ":";
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');

                $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->CheckBox('amigos_si' . $i, 5, $insc->getStudentFriends());

                $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->CheckBox('amigos_no' . $i, 5, !$insc->getStudentFriends());
                $pdf->Ln($lineBreakHeight);
            
                // LINEA 20
                $text = sfContext::getInstance()->getI18N()->__('registration.trans34');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');

                if ($insc->getStudentFriends()) {
                    if (strlen($insc->getStudentFriends()) > 100) {
                        $pdf->MultiCell(0, 0, $insc->getStudentFriends(), 0, 'L', 0, 1, $pdf->getX(), $pdf->getY() - 1, true);
                        $height = 7;
                    }
                    else {
                        $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentFriends(), array('B'=>array('dash'=>1,'width'=>0)), 0, 'L', 0, '', 1, false, 'M', 'M');
                    }
                }
                else {
                    $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $insc->getStudentFriends(), array('B'=>array('dash'=>1,'width'=>0)), 0, 'L', 0, '', 1, false, 'M', 'M');
                }
            }

            if ($insc->getStudentComments()) {
                $pdf->Ln(isset($isMultiCell) ? $lineBreakHeight - 2 : $lineBreakHeight);
                $text = sfContext::getInstance()->getI18N()->__("registration.trans175") . ":";
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->MultiCell(0, 0, $insc->getStudentComments(), 0, 'L', 0, 1, $pdf->getX(), $pdf->getY() - 1, true);
                $height = 7;
            }

            if ($insc->getCustomQuestion() && ($insc->getCustomQuestionAnswer() == 1 || $insc->getCustomQuestionAnswer() == 0))
            {
                $pdf->Ln(isset($isMultiCell) ? 1 : $lineBreakHeight - 2);
                $text = $insc->getCustomQuestion() . ":";

                $pdf->MultiCell(0, 0, $text, 0, '', 0, 1, '', '', true);
                $pdf->Ln(2);

                $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->CheckBox('custom_si' . $i, 5, $insc->getCustomQuestionAnswer() == 1);

                $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->CheckBox('custom_no' . $i, 5, $insc->getCustomQuestionAnswer() == 0);

                $height = 10;
            }


            $pdf->Ln($height);

            // LINEA 20 - Semanas
            $widthColumnWeeks = 100;
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, sfContext::getInstance()->getI18N()->__('registration.trans35'), array('LTRB' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
            //$pdf->Cell(0, sfTCPDF::FONT_HEIGHT, sfContext::getInstance()->getI18N()->__("Serveis"), array('LTRB' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
            $missatgeEspera = 0;
            $hayExcursiones = false;
            for ($j = 1; $j <= count($inscripciones[$i]); $j++) 
            {
                $weekInscription = InscriptionPeer::retrieveByPK($inscripciones[$i][$j]);
                $discountAmount += $weekInscription->getDiscount();
                $curs = CoursePeer::getCourseByInscrptionId($inscripciones[$i][$j]);
                if ($curs->getExcursion()) {
                	$hayExcursiones = true;
                }
                $espera = '';
                
                if ($weekInscription->getState() == 0) {
                    $preu[$i] = $curs->getPrice() + $preu[$i];
                }
                else {
                    $espera = '* ';
                    $missatgeEspera = 1;
                }

                $week = $curs->getWeek();
                $pdf->setCellPadding(0);

                $pdf->Ln(5);

                if ($curs->getSchedule() != '') {
                    //$pdf->MultiCell($widthColumnWeeks, sfTCPDF::FONT_HEIGHT, sfContext::getInstance()->getI18N()->__( '%espera% %week% (%curs%)', array('%espera%'=>$espera, '%week%'=>$week, '%curs%'=>$curs->getSchedule())), array('LR'=>array('dash'=>0,'width'=>0)), '', 0, 1, '', '', true);
                    //$pdf->Ln(3);
                    $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, sfContext::getInstance()->getI18N()->__( '%espera% %week% (%curs%)', array('%espera%'=>$espera, '%week%'=>$week, '%curs%'=>$curs->getSchedule())), array('LR'=>array('dash'=>0,'width'=>0)), 0, 'C', 0, '', 1, false, 'M', 'T');
                } 
                else {
                    $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $espera . $week, array('LR' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 1, false, 'M', 'T');
                }

                /*
                if (count($weekInscription->getInscriptionServiceSchedules()))
                {
                    $isFirst = true;
                    foreach ($weekInscription->getInscriptionServiceSchedules() as $inscriptionServiceSchedule)
                    {
                        $schedule = $inscriptionServiceSchedule->getServiceSchedule();
                        $schedule->setCulture(sfContext::getInstance()->getUser()->getCulture());

                        $service = $schedule->getService();
                        $service->setCulture(sfContext::getInstance()->getUser()->getCulture());

                        $label = $service->getName() . ' (' . $schedule->getName() . ')';

                        if ($isFirst) {
                            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $label, array('LR' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
                            $isFirst = false;
                        }
                        else {
                            $pdf->Ln(5);
                            $pdf->Cell($widthColumnWeeks, sfTCPDF::FONT_HEIGHT, '', array('LR' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
                            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $label, array('LR' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
                        }
                    }
                }
                else {
                    $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, '-', array('LR' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
                }
                */

                $pdf->Ln(0);
                $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, '', array('B' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');

                /*
                if ($label == '') {
                    $label = sfContext::getInstance()->getI18N()->__("registration.trans60");
                }
                else {
                    $label = substr($label, 0, -3);
                }
                */
                //$pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $label, array('LTRB' => array('dash' => 0, 'width' => 0)), 0, 'C', 0, '', 0, false, 'M', 'T');
            }
            
            if ($missatgeEspera)
            {
                $pdf->Ln(5);
                $text = '* '. sfContext::getInstance()->getI18N()->__('Llista d\'espera') . '. ' . sfContext::getInstance()->getI18N()->__('registration.trans188');
                $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'C', 0, '', 0, false, 'M', 'C');
            }

            if ($studentInscrCenter->getShowExcursionWidget() && $hayExcursiones)
            {
                $pdf->Ln($lineBreakHeight);
                if ($insc->getStudentExcursion() == 1) {
                    $text = sfContext::getInstance()->getI18N()->__("registration.trans177");
                }
                else {
                    $text = sfContext::getInstance()->getI18N()->__("registration.trans192");
                }
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            }

            $pdf->SetY(245);
            $pdf->Cell(0, 0, '', array('B'=>array('dash'=>0,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');

            $pdf->setCellPaddings(0,0,0,0);
            $pdf->Ln(5);

            $pdf->MultiCell(0, 5, sfContext::getInstance()->getI18N()->__('registration.trans146'), 0, 'L', 0, 0, '', '', true);
            $pdf->Ln(11);
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans36');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(0, sfTCPDF::FONT_HEIGHT, '' , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            $pdf->Ln(6);
            
            $text = sfContext::getInstance()->getI18N()->__('registration.trans19');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(20, sfTCPDF::FONT_HEIGHT, '' , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
            
            $pdf->setX(60);
            $text = sfContext::getInstance()->getI18N()->__('registration.trans37');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->Cell(25, sfTCPDF::FONT_HEIGHT, '   /      /   ' , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');

            $pdf->setX(120);
            $pdf->Cell(40, sfTCPDF::FONT_HEIGHT, sfContext::getInstance()->getI18N()->__('registration.trans38'), 0, 0, 'C', 0, '', 0, false, 'M', 'B');
        }

        $pdf->setTypeHeader(null,sfContext::getInstance()->getI18N()->__('registration.trans147'),sfContext::getInstance()->getI18N()->__('registration.trans148'));        
        $pdf->AddPage();
        $pdf->Cell(28, 0, sfContext::getInstance()->getI18N()->__('registration.trans39'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
        $studentInscrCenter = SummerFunCenterPeer::doSelectOneByCourseId($insc->getStudentCourseInscription());
        $pdf->Ln($lineBreakHeight);
        
        $text = sfContext::getInstance()->getI18N()->__('registration.trans30');
        $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
        $pdf->Cell(90, sfTCPDF::FONT_HEIGHT, $studentInscrCenter->getTitle() , array('B'=>array('dash' => 1,'width' => 0)),0, 'C', 0, '', 0, false, 'C', 'M');
        $pdf->Ln($lineBreakHeight);
        
        $text = sfContext::getInstance()->getI18N()->__('registration.trans40');
        $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
        $pdf->Cell(10, sfTCPDF::FONT_HEIGHT, count($inscripciones), array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
       
        if ($studentInscrCenter->getShowBecaWidget())
        {
        	$pdf->Ln($lineBreakHeight);
        
	        $text = sfContext::getInstance()->getI18N()->__("Sol·licita ajut econòmic, beca?") . ":";
	        $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
	        
	        $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
	        $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
	        $pdf->CheckBox('beca_si' . $i, 5, $insc->getBeca() == 1);
	        
	        $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
	        $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
	        $pdf->CheckBox('beca_no' . $i, 5, $insc->getBeca() == 0);
        }

        $altura = 40;

        $pdf->setXY(130, $altura);
        $pdf->setCellPadding(5);
        $pdf->Cell(64, 80, '', array('LTRB'=>array('dash'=>0,'width'=>0)), 0, 'C', 0, '', 0, false, 'T', 'T');
        $total = 0;
        for ($j = 1; $j <= count($inscripciones); $j++)
        {
            $total += $preu[$j];

            $pdf->setXY(135, $altura);
            $pdf->SetFont(sfTCPDF::FONT, 'N', sfTCPDF::FONT_SIZE);
            $pdf->setCellPadding(2);
            $pdf->Cell(24, 0,  sfContext::getInstance()->getI18N()->__('registration.trans86').' '.$inscCode[$j],array('B'=>array('dash'=>1,'width'=>0)), 0, 'L', 0, '', 0, false, 'T', 'T');
            $pdf->SetFont('arial', 'B', sfTCPDF::FONT_SIZE);
            $pdf->Cell(30, 0, $preu[$j]. ' €',array('B'=>array('dash'=>1,'width'=>0)), 0, 'R', 0, '', 0, false, 'T', 'T');
            $pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);
            $altura += 7;

            foreach ($inscripciones[$j] as $inscNum)
            {
                $weekInscription = InscriptionPeer::retrieveByPK($inscNum);
                $services = array();
                foreach ($weekInscription->getInscriptionServiceSchedules() as $inscriptionServiceSchedule)
                {
                    $service = $inscriptionServiceSchedule->getServiceSchedule()->getService();

                    if (!in_array($service->getId(), $services)) {

                        $service->setCulture(sfContext::getInstance()->getUser()->getCulture());

                        $pdf->setXY(135, $altura);
                        $pdf->SetFont(sfTCPDF::FONT, 'N', sfTCPDF::FONT_SIZE);
                        $pdf->setCellPadding(2);
                        $pdf->Cell(24, 0, '   ' . $service->getName(), array('B' => array('dash' => 1, 'width' => 0)), 0, 'L', 0, '', 0, false, 'T', 'T');
                        $pdf->SetFont('arial', 'B', sfTCPDF::FONT_SIZE);
                        $pdf->Cell(30, 0, $service->getPrice() . ' €', array('B' => array('dash' => 1, 'width' => 0)), 0, 'R', 0, '', 0, false, 'T', 'T');
                        $pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);
                        $altura += 7;

                        array_push($services, $service->getId());

                        $total += $service->getPrice();
                    }
                }
            }

            /*
            if ($importeAcogida[$j] > 0) 
            {
            	$pdf->setXY(135, $altura);
            	$pdf->SetFont(sfTCPDF::FONT, 'N', sfTCPDF::FONT_SIZE);
            	$pdf->setCellPadding(2);
            	$pdf->Cell(24, 0, sfContext::getInstance()->getI18N()->__('Servei d\'acollida'), array('B' => array('dash' => 1, 'width' => 0)), 0, 'L', 0, '', 0, false, 'T', 'T');
            	$pdf->SetFont('arial', 'B', sfTCPDF::FONT_SIZE);
            	$pdf->Cell(30, 0, $importeAcogida[$j] . ' €', array('B' => array('dash' => 1, 'width' => 0)), 0, 'R', 0, '', 0, false, 'T', 'T');
            	$pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);
            	$altura += 10;
            }
            */
        }
        
        $pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);

        if ($discountAmount > 0 && $aplicarDescento)
        {
        	$pdf->setXY(135, 100);
        	$pdf->Cell(24, 0, sfContext::getInstance()->getI18N()->__('registration.trans197') . " (" . $discountPercent . "%)", array('T'=>array('dash'=>0,'width'=>0)), 0, 'L', 0, '', 0, false, 'T', 'T');
        	$pdf->SetFont('arial', 'B', sfTCPDF::FONT_SIZE);
        	$pdf->Cell(30, 0, $discountAmount . ' €',array('T'=>array('dash'=>0,'width'=>0)), 0, 'R', 0, '', 0, false, 'T', 'T');
        	$pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);
        	
        	$pdf->setXY(135, 105);
        	$pdf->Cell(24, 0, sfContext::getInstance()->getI18N()->__('TOTAL'), '', 0, 'L', 0, '', 0, false, 'T', 'T');
        	$pdf->SetFont('arial', 'B', sfTCPDF::FONT_SIZE);
        	$pdf->Cell(30, 0, number_format($total - $discountAmount, 2) . ' €', '', 0, 'R', 0, '', 0, false, 'T', 'T');
        	$pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);
        }
        else {
        	$pdf->setXY(135, 110);
        	$pdf->Cell(24, 0, sfContext::getInstance()->getI18N()->__('TOTAL'), array('T'=>array('dash'=>0,'width'=>0)), 0, 'L', 0, '', 0, false, 'T', 'T');
        	$pdf->SetFont('arial', 'B', sfTCPDF::FONT_SIZE);
        	$pdf->Cell(30, 0, $total . ' €',array('T'=>array('dash'=>0,'width'=>0)), 0, 'R', 0, '', 0, false, 'T', 'T');
        	$pdf->SetFont(sfTCPDF::FONT, 'B', sfTCPDF::FONT_SIZE);
        }
        
        $pdf->SetFont(sfTCPDF::FONT, 'N', sfTCPDF::FONT_SIZE);



        $pdf->SetY(120);
        $pdf->Cell(0, 0, '', array('B'=>array('dash'=>0,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');

        $pdf->Ln(11);

        if (sfContext::getInstance()->getUser()->getCulture() != 'fr') {

            $paymentMode = sfContext::getInstance()->getI18N()->__('registration.trans42');

            if ($insc->getMethodPayment() != InscriptionPeer::METHOD_PAYMENT_TPV && $insc->getMethodPayment() != InscriptionPeer::METHOD_PAYMENT_RECIBO) {
                $paymentMode .= '*';
            }

            $pdf->Cell(0, 0, $paymentMode, 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            $pdf->Ln($lineBreakHeight);

            if ($insc->getMethodPayment() == InscriptionPeer::METHOD_PAYMENT_TRANSFER)
            {
                $text = sfContext::getInstance()->getI18N()->__('registration.trans43');
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
                $pdf->Cell(0, 0, $studentInscrCenter->getAccountNumber(), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }
            elseif ($insc->getMethodPayment() == InscriptionPeer::METHOD_PAYMENT_CASH) {
                $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans2'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
                $pdf->Ln($lineBreakHeight);
                $pdf->Cell(0, 0, 'Kids&Us Poblenou - C/Llacuna 104, Barcelona', 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }
            elseif ($insc->getMethodPayment() == InscriptionPeer::METHOD_PAYMENT_RECIBO) {
                $text = sfContext::getInstance()->getI18N()->__('registration.trans198');
                $pdf->Cell(util::getTextWidth($pdf, $text), 0, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'C');

                if ($studentInscrCenter->getReciboDomiciliadoTxt())
                {
                    $pdf->Ln($lineBreakHeight);
                    $pdf->MultiCell(0, 0, $studentInscrCenter->getReciboDomiciliadoTxt(), 0, 'L');
                }
            }
            else {
                $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans222'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }

            $pdf->Ln($lineBreakHeight);

            if ($insc->getSplitPayment()) {
                if ($studentInscrCenter->getSecondPaymentDate()) {

                    $date = DateTime::createFromFormat('Y-m-d', $studentInscrCenter->getSecondPaymentDate());
                    $importe = number_format(($total/2), 2).' euros';
                    $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans230', array('%importe%' => $importe , '%date%' => $date->format('d/m/Y'))), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
                }
            }
            else {
                $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans44'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }

            /*
            $pdf->Ln($lineBreakHeight);
            if ($insc->getSplitPayment() == 0)
            {
                $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans44'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }
            else {
                $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans45'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }
            */

            if ($insc->getMethodPayment() != InscriptionPeer::METHOD_PAYMENT_TPV && $insc->getMethodPayment() != InscriptionPeer::METHOD_PAYMENT_RECIBO) {
                $pdf->Ln($lineBreakHeight);
                $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans46'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            }
        }
        else {
            //$pdf->Cell(0, 0, strtoupper(sfContext::getInstance()->getI18N()->__('payment')), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
            //$pdf->Ln($lineBreakHeight);

            $pdf->Cell(0, 0, sfContext::getInstance()->getI18N()->__('payment_fr'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');

            $pdf->Ln($lineBreakHeight);

            $text = "Désirez recevoir une attestation fiscale pour frais de garde à la fin de la semaine?";
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');

            $text = sfContext::getInstance()->getI18N()->__('registration.trans170');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('certificated1', 5, $insc->getCertificated() == 1);

            $text = sfContext::getInstance()->getI18N()->__('registration.trans60');
            $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $pdf->CheckBox('certificated2', 5, $insc->getCertificated() == 0);

            if ($insc->getCertificated()) {
                $pdf->Ln($lineBreakHeight);
                $text = "À quel nom?";
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');

                $text = $insc->getCertificatedName();
                $pdf->Cell(util::getTextWidth($pdf, $text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            }
        }



        $pdf->SetY(200);
        $pdf->Cell(0, 0, '', array('B'=>array('dash'=>0,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');


        $pdf->Ln($lineBreakHeight);
        $pdf->setCellPadding(0);

        $pdf->MultiCell(0, 5, sfContext::getInstance()->getI18N()->__('registration.trans146'), 0, 'L', 0, 0, '', '', true);


        $pdf->Ln(17);
        $pdf->Cell(80, 0, sfContext::getInstance()->getI18N()->__('registration.trans36'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
        $pdf->Cell(0, 0, '' , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
        $pdf->Ln(9);
        $pdf->Cell(8, 0, sfContext::getInstance()->getI18N()->__('registration.trans19'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
        $pdf->Cell(20, 0, '' , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');
        $pdf->setX(60);
        $pdf->Cell(11, 0, sfContext::getInstance()->getI18N()->__('registration.trans37'), 0, 0, 'L', 0, '', 0, false, 'M', 'C');
        $pdf->Cell(25, 0, '   /      /   ' , array('B'=>array('dash'=>1,'width'=>0)),0, 'C', 0, '', 0, false, 'C', 'M');


        $pdf->setX(120);
        $pdf->Cell(40, 0, sfContext::getInstance()->getI18N()->__('registration.trans38'), 0, 0, 'C', 0, '', 0, false, 'M', 'L');

        return array($pdf,$studentInscrCenter->getId());
    }
    
    public static function getTextWidth($pdf, $text) 
    {
    	return $pdf->GetStringWidth($text, sfTCPDF::FONT, sfTCPDF::FONT_STYLE, sfTCPDF::FONT_SIZE) + sfTCPDF::SANGRADO;
    }

     public static function enviarAviso(Inscription $insc, $llistaCorreus, $type)
    {
        require_once('lib/phpMailer/phpmailer.class.php');
        $centre = $insc->getStudentCourseInscription()->getSummerFunCenterId();
        sfLoader::loadHelpers('Partial');
        
        if($type == 'all'){
            $missatge = get_partial('Inscription/all_payment_mail', array('centre' => $centre, 'inscription' => $insc));
        }else{
            $missatge = get_partial('Inscription/half_payment_mail', array('centre' => $centre, 'inscription' => $insc));
        }
        
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = sfConfig::get('app_email_user');
        $mail->Password = sfConfig::get('app_email_password');
        $mail->FromName = 'Kids&Us';
        $mail->From = 'admin.cooloff@kidsandus.es';
        $mail->AddReplyTo($mail->From, 'Kids&Us');
        $mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        $mail->Helo = "www.kidsandus.es.mx";
        $mail->Subject = sfContext::getInstance()->getI18N()->__('Pagament Cooloff');
        $mail->Body = $missatge;
        $mail->AltBody = $missatge;
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        for ($i = 1; $i <= count($llistaCorreus); $i++) {
            for ($j = 1; $j <= 2; $j++) {
                if (isset($llistaCorreus[$i][$j])) {
                    $mail->AddAddress($llistaCorreus[$i][$j]);
                }
            }
        }

        $mail->Send();
    }
    
    public static function enviarPdf($pdf, $llistaCorreus, $idCentre)
    {
        require_once('lib/phpMailer/phpmailer.class.php');
        $centre = SummerFunCenterPeer::retrieveByPK($idCentre);
        sfLoader::loadHelpers('Partial');
        $attachment = $pdf->Output('', 'S');
        $missatge = get_partial('inscription/confirmation_mail_message', array('centre' => $centre));

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port
        $mail->Username = sfConfig::get('app_email_user');  // GMAIL username
        $mail->Password = sfConfig::get('app_email_password'); // GMAIL password
        $mail->From = strlen($centre->getMail()) != 0 ? $centre->getMail() : 'info@kidsandus.es';
        $mail->AddReplyTo($mail->From, 'Kids&Us');
        $mail->Helo = "www.kidsandus.es.mx";
        $mail->FromName = 'Kids&Us';
        $mail->Subject = sfContext::getInstance()->getI18N()->__('registration.trans47');
        $mail->Body = $missatge;
        $mail->AltBody = $missatge;
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        for ($i = 1; $i <= count($llistaCorreus); $i++) {
            for ($j = 1; $j <= 2; $j++) {
                if (isset($llistaCorreus[$i][$j])) {
                    $mail->AddAddress($llistaCorreus[$i][$j]);
                }
            }
        }

        if (sfContext::getInstance()->getUser()->getCulture() == 'ca') {

            $nomFitxer = "inscripcio-cooloff.pdf";
            $fitxerCondicions = "pdf/condicions-generals-cooloff.pdf";

            if ($centre->getInscriptionConditionsTermsPdfCa() != null) {

                $fitxerCondicions = "uploads/summer-fun/center/pdf-conditions/ca/" . $centre->getInscriptionConditionsTermsPdfCa();

            }
            $fitxerCondicionsNom = "condicions-generals-cooloff.pdf";

        } else if (sfContext::getInstance()->getUser()->getCulture() == 'es') {

            $nomFitxer = "inscripcion-cooloff.pdf";
            $fitxerCondicions = "pdf/condiciones-generales-cooloff.pdf";

            if ($centre->getInscriptionConditionsTermsPdfEs() != null) {

                $fitxerCondicions = "uploads/summer-fun/center/pdf-conditions/es/" . $centre->getInscriptionConditionsTermsPdfEs();

            }
            $fitxerCondicionsNom = "condiciones-generales-cooloff.pdf";


        } else if (sfContext::getInstance()->getUser()->getCulture() == 'it') {

            $nomFitxer = "registrazione-cooloff.pdf";
            $fitxerCondicions = "pdf/condizioni-generali-cooloff.pdf";


            if ($centre->getInscriptionConditionsTermsPdfIt() != null) {

                $fitxerCondicions = "uploads/summer-fun/center/pdf-conditions/it/" . $centre->getInscriptionConditionsTermsPdfIt();

            }
            $fitxerCondicionsNom = "condizioni-generali-cooloff.pdf";


        } else if (sfContext::getInstance()->getUser()->getCulture() == 'fr') {
            $nomFitxer = "inscription-cooloff.pdf";
            $fitxerCondicions = "pdf/termes-et-conditions-cooloff.pdf";

            if ($centre->getInscriptionConditionsTermsPdfFr() != null) {
                $fitxerCondicions = "uploads/summer-fun/center/pdf-conditions/fr/" . $centre->getInscriptionConditionsTermsPdfFr();
            }

            $fitxerCondicionsNom = "termes-et-conditions-cooloff.pdf";
        } else {
            $nomFitxer = "inscripcion-cooloff.pdf";
            $fitxerCondicions = "pdf/condiciones-generales-cooloff.pdf";
            $fitxerCondicionsNom = "condiciones-generales-cooloff.pdf";
        }

        $mail->AddStringAttachment($attachment, $nomFitxer);
        $mail->AddAttachment($fitxerCondicions, $fitxerCondicionsNom);
        $mail->Send();
    }
}