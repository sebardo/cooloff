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

class sfTCPDF extends TCPDF
{
    const SANGRADO = 2;
    const FONT = "din";
    const FONT_SIZE = 8;
    const FONT_HEIGHT = 5;
    const FONT_STYLE = '';

    /**
     * Instantiate TCPDF lib
     *
     * @param string $orientation
     * @param string $unit
     * @param string $format
     * @param boolean $unicode
     * @param string $encoding
     */

    protected $codiInscripcio;

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = "UTF-8")
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding);
    }

    public function __destruct()
    {
    }

    public function Header()
    {
        $headerdata = $this->getHeaderData();

        // Logo
        $image_file = K_PATH_IMAGES . 'logo_pdf.jpg';
        $this->SetXY(15, 15);
        $this->SetFont(sfTCPDF::FONT, 'n', 15);
        $this->Cell(0, 0, sfContext::getInstance()->getI18N()->__('registration.trans236'), 0, false, 'L', 0, '', 0, false, 'M', 'M');

        $this->SetXY(15, 23);

        $this->SetFont(sfTCPDF::FONT, sfTCPDF::FONT_STYLE, sfTCPDF::FONT_SIZE);

        If ($this->codiInscripcio) {
            $text = $this->tradPag1;
            $this->Cell($this->getTextWidth($text), sfTCPDF::FONT_HEIGHT, $text, 0, 0, 'L', 0, '', 0, false, 'M', 'B');
            $this->Cell(25, sfTCPDF::FONT_HEIGHT, $this->codiInscripcio, array('B' => array('dash' => 1, 'width' => 0)), 0, 'C', 0, '', 0, false, 'C', 'M');
        } else {
            $this->Cell(0, 0, $this->tradPag2, 0, false, 'L', 0, '', 0, false, 'M', 'M');
        }

        $this->SetXY(170, 7);
        $this->Image($image_file, '', '', '', 20, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font

        // Title
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
// print an ending header line
        $this->SetLineStyle(array('width' => 0.01, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
        $this->SetY((2.835 / $this->k) + max(30, $this->y));

        $this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
        $this->endTemplate();
    }

    public function setTypeHeader($codi = null, $tradPag1, $tradPag2)
    {
        $this->codiInscripcio = $codi;
        $this->tradPag1 = $tradPag1;
        $this->tradPag2 = $tradPag2;
    }

    public function setTypeFooter($footer)
    {
        $this->footer = $footer;
    }

    public function Footer()
    {
        $this->SetFont(sfTCPDF::FONT, sfTCPDF::FONT_STYLE, sfTCPDF::FONT_SIZE);
        $this->Cell(0, 0, $this->footer, 0, false, 'L', 0, '', 0, false, 'M', 'M');
    }

    public function getTextWidth($text)
    {
        return $this->GetStringWidth($text, sfTCPDF::FONT, sfTCPDF::FONT_STYLE, sfTCPDF::FONT_SIZE) + sfTCPDF::SANGRADO;
    }
}