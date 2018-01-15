<?php

class uploadAction extends sfAction {
	public function execute() {
		$i18n = new ThairaUploadsI18nWrap();
		$res = array('result' => false, 'message' =>$i18n->__(
				'Unexpected upload error'));
		$this->setLayout(false);

		try {
			$this->index = $this->getRequestParameter('index');
			$this->uid = $this->getRequestParameter('uid');

			if ($this->index === null || $this->uid === null) {
				throw new Exception($i18n->__('Invalid params'));
			}
			$request = $this->getRequest();
			if ($request->hasFileError('file') || $request->getFileSize('file') == 0) {
				if ($this->getRequest()->getFileError('file') == UPLOAD_ERR_NO_FILE) {
					throw new ThairaUploadsException($i18n->__(
							'You must select a file'));
				}
				if ($this->getRequest()->getFileError('file') == UPLOAD_ERR_INI_SIZE
						|| $this->getRequest()->getFileError('file') == UPLOAD_ERR_FORM_SIZE) {
					throw new ThairaUploadsException($i18n->__(
							'Max file size limit exceeded'));
				}
				throw new Exception($this->getRequest()->getFileError('file'));
			}

			// Process the upload
			$session = ThairaUploadsSession::getSessionByUid($this->uid);

			$session->validateSize($request->getFileSize('file'));
			$session->validateType($request->getFileName('file'));
			$session->validateDimensions($request->getFilePath('file'));

			$session->doImageAutoScale($request->getFilePath('file'));

			// Create ThairaUploadsFile object
			$file = new ThairaUploadsFile();
			$file->setIsPending(true);
			$file->setPendingUid($this->uid);
			$filename = basename($request->getFileName('file'));
			if (get_magic_quotes_gpc()) { $filename = stripslashes($filename); }
			$file->setFilename($filename);
			$file->setPath($session->getSavePath());

			$cultures = sfConfig::get('app_thaira_uploads_cultures');
			foreach ($cultures as $culture) {
				$fileI18n = new ThairaUploadsFileI18n();
				$fileI18n->setCulture($culture);
				$fileI18n->setTitle($file->getFilename());
	
				$file->setThairaUploadsFileI18nForCulture($fileI18n, $culture);
			}

			// Generate unique filename
			$path = '';
			do {
				$path = sfConfig::get('app_thaira_uploads_pending_dir');
				$path .= '/' . md5(time() + rand(0, getrandmax()) + '1')
						. '.' . $file->getExtension();
			} while (is_file($path));

			// Move file to temp dir
			try {
				$request->moveFile('file', $path);
			} catch (sfFileException $e) {
				throw new Exception($i18n->__('Failed when moving the file'));
			}

			// Save the object
			$file->setPendingFilePath($path);
			$file->save();

			$res = array('result' => true, 'title' => $file->getFilename(),
					'id' => $file->getId(), 'url' => $file->getWebPath(),
					'imgSrc' => $file->getThumbWebPath(80,70));

			$this->file = $file;
			$this->path = $path;
		} catch (ThairaUploadsException $e) {
			$res = array('result' => false, 'message' => $e->getMessage());
		} catch (Exception $e) {
			if (! SF_DEBUG) {
				$error = $i18n->__('Unexpected upload error');
			} else {
				$error = $e->getMessage() . $e->getFile() . $e->getLine();
			}
			$res = array('result' => false, 'message' => $error);
		}

		$this->json = ThairaProjectTools::toJson($res);
	}
}