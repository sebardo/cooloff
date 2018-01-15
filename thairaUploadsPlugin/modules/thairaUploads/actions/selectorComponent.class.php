<?php

class selectorComponent extends sfComponent {
	/**
	 * Component parameters:
	 *   - object:
	 *   - groupName:
	 *   - savePath:
	 *   - minRows:
	 *   - maxRows: (Not implemented)
	 *   - fields: Array with this possible values = title, description, tags
	 *   - imageAutoScale:
	 *     - min:
	 *     - max:
	 *   - stripFilenames: Boolean
	 *   - validation:
	 *     - min:
	 *     - min_msg:
	 *     - max:
	 *     - max_msg:
	 *     - max_size:
	 *     - max_size_msg:
	 *     - types:
	 *     - types_msg:
	 *     - dimensions:
	 *       - min:
	 *       - max:
	 *       - aspect:
	 *     - dimensions_msg:
	 */
	public function execute() {
		// Add css and js

		$url = sfConfig::get('sf_prototype_web_dir');
		$this->getResponse()->addJavascript($url . '/js/prototype.js');

		$url = sfConfig::get('sf_relative_url_root');
		$this->getResponse()->addStylesheet($url . '/thairaUploadsPlugin/css/main.css');
		$this->getResponse()->addJavascript($url . '/thairaUploadsPlugin/js/all.php');

		// Check the parameters

		if (! isset($this->object) || ! $this->object) {
			throw new ThairaUploadsException('Bad object param!');
		}
		if (! isset($this->groupName) || ! $this->groupName) {
			throw new ThairaUploadsException('Bad groupName param!');
		}
		$this->savePath = isset($this->savePath) ? $this->savePath : null;
		$this->validation = isset($this->validation) ? $this->validation : null;
		$this->minRows = isset($this->minRows) ? $this->minRows : 1;
		$this->fields = isset($this->fields) ? $this->fields : array('title', 'description', 'is_protected', 'password');
		$this->imageAutoScale = isset($this->imageAutoScale) ? $this->imageAutoScale : null;
		$this->stripFilenames = isset($this->stripFilenames) ? $this->stripFilenames : false;
		$uids = $this->getRequestParameter('thairaUploadsUids', array());

		// Get the session object
		if (count($uids) == 0) {
			$uid = ThairaUploadsSession::genUid();
			$session = ThairaUploadsSession::createSession($uid, $this->object,
					$this->groupName);
		} else {
			$uid = array_shift($uids);
			$this->getRequest()->setParameter('thairaUploadsUids', $uids);
			$session = ThairaUploadsSession::getSessionByUid($uid);
		}
		$session->initialize();

		$this->fields = $session->filterFields($this->fields);

		// Set the parameters
		$session->setSavePath($this->savePath);
		$session->setValidation($this->validation);
		$session->setFields($this->fields);
		$session->setImageAutoScale($this->imageAutoScale);
		$session->setStripFilenames($this->stripFilenames);

		// Save the session
		$session->save();

		// FieldName for validator
		$this->uid = $uid;
		$this->session = $session;
		$this->selectorMinHeight = $this->minRows * 134;
	}
}