<?php

class removeAction extends sfAction {
	public function execute() {
		$res = array('result' => true);
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
				throw new Exception($i18n->__('Incorrect IDs (objectId)'));
			}

			$file->delete();
		} catch (ThairaUploadsException $e) {
			$res = array('result' => false, 'message' => $e->getMessage());
		} catch (Exception $e) {
			if (! SF_DEBUG) {
				$error = $i18n->__('Unexpected remove error');
			} else {
				$error = $e->getMessage();
			}
			$res = array('result' => false, 'message' => $error);
		}

		$this->getResponse()->setHttpHeader("X-JSON", ThairaProjectTools::toJson($res));
		return sfView::HEADER_ONLY;
	}
}