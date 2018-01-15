<?php

class ThairaUploadsValidator {
	public static function checkSavePath($savePath) {
		if (! is_dir($savePath)) {
			// Try to create
			ThairaUploadsTools::mkdir($savePath, 0777);
		}
		if (! is_dir($savePath) || ! is_writable($savePath)) {
			throw new ThairaUploadsException(sprintf('%s is not writable',
					$savePath));
		}
	}

	public static function validate() {
		// Do all validations
		$log = sfLogger::getInstance();

		$uids = sfContext::getInstance()->getRequest()->getParameter('thairaUploadsUids');

		if ($uids) {
			// Get all sessions and validate them
			$hasErrors = false;
			$sessions = array();
			foreach ($uids as $uid) {
				$fieldName = 'thairaUploads';
				try {
					$session = ThairaUploadsSession::getSessionByUid($uid);
					$fieldName = $session->getValidationFieldName();

					$session->initialize();
					$files = $session->getFiles();

					$savePath = $session->getSystemSavePath();
					self::checkSavePath($savePath);

					// General validation
					$session->validateMin();
					$session->validateMax();

					// Validation per file
					foreach ($files as $file) {
						$filename = $file->getFilename();
						$path = $savePath . DIRECTORY_SEPARATOR . $filename;
						if (is_file($filename)) {
							// Error?
						}
					}

					$sessions[] = $session;
				} catch (ThairaUploadsException $e) {
					sfContext::getInstance()->getRequest()->setError(
							$fieldName, $e->getMessage());
					$hasErrors = true;
				}
			}

			if ($hasErrors) {
				return false;
			}

			sfContext::getInstance()->getRequest()->setAttribute(
					'thairaUploadsSessions', $sessions);
		}

		return true;
	}
}