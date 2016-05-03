<?php

namespace Educo\Podcast\Utilities\Backend;
use \TYPO3\CMS\Backend\Utility\BackendUtility;

class EpisodePostProcessor
{
	function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$reference)
	{

		if ($status == 'update' && $table == 'tx_podcast_domain_model_episode') {
			$row = BackendUtility::getRecord($table, $id);

			// reset data, will be set anew when frontend is called
			if (is_array($row)) {
				$fieldArray['mime'] = '';
				$fieldArray['duration'] = '0';
				$fieldArray['altfiles'] = '';
			}
		}
	}
}

?>