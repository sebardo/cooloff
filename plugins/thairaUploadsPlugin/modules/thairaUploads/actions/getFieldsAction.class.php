<?php

class getFieldsAction extends sfAction {
	public function execute() {
		$res = array('result' => true, 'data' => array());
		$i18n = new ThairaUploadsI18nWrap();

		try {
			$uid = $this->getRequestParameter('uid');
			$id = $this->getRequestParameter('id');

			$session = ThairaUploadsSession::getSessionByUid($uid);

			if (! $id) {
				throw new Exception($i18n->__('Incorrect ID'));
			}

			$c = new Criteria();
			$c->add(ThairaUploadsFilePeer::ID, $id);
			$file = ThairaUploadsFilePeer::doSelectOne($c);
			if (! $file) {
				throw new Exception($i18n->__('Incorrect ID'));
			}
			if ($file->getObjectId() !== null
					&& ($file->getObjectId() != $session->getObjectId()
						|| $file->getObjectClass() != $session->getObjectClass())) {
				throw new Exception($i18n->__('Incorrect IDs (objectId)'));
			} elseif ($file->getObjectId() === null
					&& $file->getPendingUid() != $uid) {
				throw new Exception($i18n->__('Incorrect IDs (pendingUid)'));
			}

			$tags = '';
			if ($session->hasField('tags')) {
				$tags = implode(', ', $file->getTags());
			}

			// Fills data
			$res['data'] = array(
				'filename' => $file->getFilename(),
				'is_protected'=>$file->getIsProtected(),
				'password'=>$file->getPassword(),
				'tags' => $tags
			);

			// Initialize with blank values i18n data
			$cultures = sfConfig::get('app_thaira_uploads_cultures');
			foreach ($cultures as $culture) {
				$res['data']['i18n'][$culture] = array(
					'title' => '',
					'is_protected' => '',
					'password' => '',
					'description' => ''
				);
			}

			// Fills with i18n data
			$i18ns = $file->getThairaUploadsFileI18ns();
			foreach ($i18ns as $i18n) {
				$res['data']['i18n'][$i18n->getCulture()] = array(
					'title' => $i18n->getTitle(),
					'is_protected'=>$file->getIsProtected(),
      				'password'=>$file->getPassword(),
					'description' => $i18n->getDescription()
				);
			}
		} catch (ThairaUploadsException $e) {
			$res = array('result' => false, 'message' => $e->getMessage());
		} catch (Exception $e) {
			if (! SF_DEBUG) {
				$error = $i18n->__('Unexpected getFields error');
			} else {
				$error = $e->getMessage();
			}
			$res = array('result' => false, 'message' => $error);
		}

		$this->getResponse()->setContentType('application/json');
		return $this->renderText(ThairaProjectTools::toJson($res));
	}
}