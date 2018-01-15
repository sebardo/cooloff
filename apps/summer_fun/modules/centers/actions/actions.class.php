<?php

/**
 * centers actions.
 *
 * @package    kids
 * @subpackage centers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class centersActions extends sfActions
{
    public function executeZones()
    {
        $zones = SummerFunZonePeer::doSelectWithI18nOrderedByTitle();
		$zoneFR = SummerFunZonePeer::retrieveByPKWithI18n(30);

        $this->setVar('zones', $zones);
		$this->setVar('zoneFR', $zoneFR);
    }

    public function executeZone() {
        $id = $this->getRequestParameter('id');
        $center = SummerFunCenterPeer::retrieveByPKWithI18n($id);
      //  $center = SummerFunCenterPeer::
        $this->forward404Unless($center);

        $this->setVar('center', $center);
    }

    public function executeZoneNewsItem() {
        $id = $this->getRequestParameter('id');
        $newsItem = SummerFunCenterNewsItemPeer::retrieveByPKWithI18n($id);
        $this->forward404Unless($newsItem);

        $this->setVar('newsItem', $newsItem);
    }
    
    public function executePassword() {
        $id = $this->getRequestParameter('id');
        $stripped_center = $this->getRequestParameter('stripped_center');
        $file = ThairaUploadsFilePeer::retrieveByPK($id);
        $this->forward404Unless($file);
        
        $this->forward404Unless($file->getIsProtected()==true);

        $this->setVar('protectedFile', $file);
        $this->setVar('stripped_center', $stripped_center);
    }
    
    public function executePasswordcheck() {
    
        $id = $this->getRequestParameter('id');
        $stripped_center = $this->getRequestParameter('stripped_center');
        $password = $this->getRequestParameter('password');
        $file = ThairaUploadsFilePeer::retrieveByPK($id);
        $this->forward404Unless($file);
        $this->forward404Unless($file->getIsProtected()==true);
        
        if ($file->getPassword() != $password)
          $this->redirect('@center_password_' . $this->getUser()->getCulture().'?stripped_center='.$stripped_center.'&id='.$id);
        
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        
        $pdfpath = '/var/www/vhosts/englishsummerfun.com/httpdocs/symfony/web/uploads'.DIRECTORY_SEPARATOR.$file->getPath().DIRECTORY_SEPARATOR.$file->getFilename();
        
        $filepath = 'http://www.englishsummerfun.com/uploads' .DIRECTORY_SEPARATOR. $file->getPath().DIRECTORY_SEPARATOR.$file->getFilename();
        
        /*echo $filepath;
   
        $this->forward404Unless(file_exists($pdfpath));
        
        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        
        switch ($file->getExtension()) {
          case 'pdf':
            $this->getResponse()->setContentType('application/pdf');
            break;
          case 'png':
            $this->getResponse()->setContentType('image/png');
            break;
          case 'jpg':
            $this->getResponse()->setContentType('image/jpeg');
            break;
          case 'mp3':
            $this->getResponse()->setContentType('audio/mpeg3');
            break;
          case 'gif':
            $this->getResponse()->setContentType('image/gif');
            break;
          case 'doc':
            $this->getResponse()->setContentType('application/msword');
            break;
          case 'docx':
            $this->getResponse()->setContentType('application/vnd.ms-word.document');
            break;
          case 'wav':
            $this->getResponse()->setContentType('audio/wav');
            break;
          case 'xls':
            $this->getResponse()->setContentType('application/vnd.ms-excel');
            break;
          case 'sxls':
            $this->getResponse()->setContentType('application/vnd.ms-excel');
            break;
          default:
            $this->getResponse()->setContentType('application/octet-stream');
            break;
        }
          
        $this->getResponse()->setHttpHeader('Content-Disposition','attachment; filename="'.$file->getFilename().'"');
        $this->getResponse()->sendHttpHeaders();
        $this->getResponse()->setContent(readfile($pdfpath));
      
        return sfView::NONE;

        $this->setVar('protectedFile', $file);*/
        
        $this->redirect($filepath);
    }

}
