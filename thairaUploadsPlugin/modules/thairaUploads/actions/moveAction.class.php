<?php

class moveAction extends sfAction {
	public function execute() {
		$res = array('result' => true);
		$i18n = new ThairaUploadsI18nWrap();

		try {
			$uid = $this->getRequestParameter('uid');
			$srcId = $this->getRequestParameter('srcId');
			$dstId = $this->getRequestParameter('dstId');

			$session = ThairaUploadsSession::getSessionByUid($uid);

			if (! $srcId || ! $dstId) {
				throw new Exception($i18n->__('Incorrect IDs'));
			}

			$c = new Criteria();
			$c->add(ThairaUploadsFilePeer::ID, $srcId);
			$c->addOr(ThairaUploadsFilePeer::ID, $dstId);
			$files = ThairaUploadsFilePeer::doSelect($c);

			if (count($files) != 2) {
				throw new Exception($i18n->__('Incorrect IDs (count)'));
			}
			foreach ($files as $file) {
				if ($file->getObjectId() !== null
						&& ($file->getObjectId() != $session->getObjectId()
							|| $file->getObjectClass() != $session->getObjectClass())) {
					throw new Exception($i18n->__('Incorrect IDs (objectId)'));
				} elseif ($file->getObjectId() === null
						&& $file->getPendingUid() != $uid) {
					throw new Exception($i18n->__('Incorrect IDs (pendingUid)'));
				}
			}

			$rank = $files[0]->getRank();
			$files[0]->setRank($files[1]->getRank());
			$files[1]->setRank($rank);
			$files[0]->save();
			$files[1]->save();
		} catch (ThairaUploadsException $e) {
			$res = array('result' => false, 'message' => $e->getMessage());
		} catch (Exception $e) {
			if (! SF_DEBUG) {
				$error = $i18n->__('Unexpected move error');
			} else {
				$error = $e->getMessage();
			}
			$res = array('result' => false, 'message' => $error);
		}

		$this->getResponse()->setHttpHeader("X-JSON", ThairaProjectTools::toJson($res));
		return sfView::HEADER_ONLY;
	}
}