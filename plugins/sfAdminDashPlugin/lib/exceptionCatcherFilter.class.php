<?php
class ExceptionCatcherFilter extends sfFilter
{
	public function execute($filterChain)
	{
		if (sfConfig::get('app_exceptionCatcherFilter')) {
			try {
				$filterChain->execute();
			} catch (sfStopException $e) {
				// This is an internally used symfony exception and shouldn't be blocked
				throw $e;
			} catch (sfError404Exception $e) {
				$error404 = array(
					'name' => $e->getName(),
					'message' => $e->getMessage(),
					'file' => $e->getFile(),
					'line' => $e->getLine(),
					'traces' => $e->getTraces($e),
				);
				
				$this->getContext()->getInstance()->getUser()->setAttribute('error404', $error404);
				
				throw $e;
			} catch (Exception $e) {
				//echo 'Caught exception: ',  $e->getMessage(), "\n";
				// Do something with the exception, other than just throwing it
			}
		} else {
			$filterChain->execute();
		}
	}
}