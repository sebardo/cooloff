<?php

/**
 * sfTCPDF class.
 *
 * This class provides an abstraction layer to the PHP TCPDF library
 * witch provides creation/modification of pdf files with UTF8 support
 * (it's an extension of the FPDF )
 *
 * @package    sfTCPDFPlugin
 * @author     Vernet Loïc aka COil <qrf_coil@yahoo.fr>
 * @link       http://sourceforge.net/projects/tcpdf/
 */

/**
 * Plugin
 */
require_once(dirname(__FILE__) . '/tcpdf/tcpdf.php');

class TCPDFFicha extends TCPDF
{
	const SANGRADO = 2;
	const FONT = "din";
	const FONT_SIZE = 10;
	const FONT_HEIGHT = 6;
	const FONT_STYLE = '';

    public function Header() 
    {
        $headerdata = $this->getHeaderData();

        $this->SetXY(10, 17);
        $this->SetFont(self::FONT, 'n', 15);
        $this->Cell(0, 0, sfContext::getInstance()->getI18N()->__('Ficha alumno') , 0, false, 'L', 0, '', 0, false, 'M', 'M');
        
        $this->SetFont(self::FONT, self::FONT_STYLE, self::FONT_SIZE);
        
        $this->Image(K_PATH_IMAGES . 'logo-kids.jpg', 165, 5, 35);

        $this->SetLineStyle(array('width' => 0.01, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
        $this->SetY(27);

        $this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
		$this->endTemplate();
    }

    public function Footer()
    {
    	$this->SetFont(self::FONT, self::FONT_STYLE, self::FONT_SIZE);
        $this->Cell(0, 0, $this->footer , 0, false, 'L', 0, '', 0, false, 'M', 'M');
    }
    
    public function getTextWidth($text)
    {
    	return $this->GetStringWidth($text, self::FONT, self::FONT_STYLE, self::FONT_SIZE) + self::SANGRADO;
    }
}