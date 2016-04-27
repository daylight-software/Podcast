<?php

namespace Educo\Podcast\Utilities\Backend;
use Input;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Adds the Plugin Wizard to the Backend
 *
 * @author Noël Bossart
 */
class PluginWizard
{

	/**
	 * Adds the podcast wizard icon
	 *
	 * @param    array        Input array with wizard items for plugins
	 * @return    array        Modified input array, having the item for Podcast Plugin added.
	 */
	function proc($wizardItems)
	{
		$wizardItems['plugins_tx_podcast_display'] = array(
			'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('podcast') . 'Resources/Public/Icons/be_wizard.gif',
			'title' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("backend.wizard", "podcast", NULL),
			'description' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("backend.wizard.description", "podcast", NULL),
			'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=podcast_display'
		);
		return $wizardItems;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/podcast/Classes/Utilities/Backend/wizicon.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/podcast/Classes/Utilities/Backend/wizicon.php']);
}
?>