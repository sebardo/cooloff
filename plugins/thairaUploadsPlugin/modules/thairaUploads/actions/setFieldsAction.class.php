<?php

class setFieldsAction extends sfAction {
	public function execute() {
		$res = array('result' => true);
		$i18n = new ThairaUploadsI18nWrap();

		try {
			$uid = $this->getRequestParameter('uid');
			$id = $this->getRequestParameter('id');

			$tags = $this->getRequestParameter('tags');
			$is_protected = $this->getRequestParameter('is_protected');
			$password = $this->getRequestParameter('password');
			$i18ns = $this->getRequestParameter('i18n');

			$session = ThairaUploadsSession::getSessionByUid($uid);

			if (! $id) {
				throw new Exception($i18n->__('Incorrect ID'));
			}
			if (! $i18ns) {
				throw new Exception($i18n->__('Invalid params'));
			}

			$c = new Criteria();
			$c->add(ThairaUploadsFilePeer::ID, $id);
			$file = ThairaUploadsFilePeer::doSelectOne($c);

			// Validate file
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

			// Set tags
			if ($session->hasField('tags')) {
				$file->setTags($tags);
			}
			
			
			if (!$is_protected) {
				$file->setIsProtected(false);
			} else {
				$file->setIsProtected(true);
			}
				
			if (isset($password)) {
				$file->setPassword($password);
			}

			// Set culture related fields
			$cultures = sfConfig::get('app_thaira_uploads_cultures');
			foreach ($cultures as $culture) {
				$file->setCulture($culture);
				if (isset($i18ns[$culture]['title'])) {
					$file->setTitle($i18ns[$culture]['title']);
				}
				if (isset($i18ns[$culture]['description'])) {
					$file->setDescription($i18ns[$culture]['description']);
				}
			}

			$file->save();
		} catch (ThairaUploadsException $e) {
			$res = array('result' => false, 'message' => $e->getMessage());
		} catch (Exception $e) {
			if (! SF_DEBUG) {
				$error = $i18n->__('Unexpected setFields error');
			} else {
				$error = $e->getMessage();
			}
			$res = array('result' => false, 'message' => $error);
		}

		$this->getResponse()->setContentType('application/json');
		return $this->renderText(ThairaProjectTools::toJson($res));
	}
}